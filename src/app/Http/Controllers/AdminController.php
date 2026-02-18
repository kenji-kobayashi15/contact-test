<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        // 【名前・メールアドレス】キーワード検索
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')

                    ->orWhereRaw('CONCAT(first_name, last_name) LIKE ?', ["%{$keyword}%"])
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        // 2. 性別検索 (「全て」の場合は条件を加えない)
        if ($request->filled('gender') && $request->input('gender') !== '全て') {
            $query->where('gender', $request->input('gender'));
        }

        // 3. お問い合わせの種類
        if ($request->filled('select_content')) {
            $query->where('select_content', $request->input('select_content'));
        }

        // 4. 日付検索 (カレンダー)
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        // CSVエクスポートボタンが押された場合
        if ($request->has('export')) {
            return $this->exportCsv($query);
        }

        // 5. 7件ずつページネーション
        $contacts = $query->paginate(7)->appends($request->all());

        return view('admin', compact('contacts'));
    }

    // FN024: CSVエクスポート機能
    private function exportCsv($query)
    {
        $response = new StreamedResponse(function () use ($query) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'お名前', '性別', 'メールアドレス', 'お問い合わせの種類', '内容', '作成日']);

            $query->chunk(100, function ($contacts) use ($handle) {
                foreach ($contacts as $contact) {
                    fputcsv($handle, [
                        $contact->id,
                        $contact->first_name . $contact->last_name,
                        $contact->gender,
                        $contact->email,
                        $contact->select_content,
                        $contact->content,
                        $contact->created_at,
                    ]);
                }
            });
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts_' . date('Ymd') . '.csv"',
        ]);

        return $response;
    }
}
