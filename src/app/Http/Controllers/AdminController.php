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

    public function destroy(Request $request)
    {
        // 送信されたIDに該当するデータを削除
        \App\Models\Contact::find($request->id)->delete();

        return redirect('/admin');
    }

    private function getSearchQuery(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('keyword')) {
            $key = $request->keyword;
            $query->where(function ($q) use ($key) {
                $q->where('first_name', 'like', "%{$key}%")
                    ->orWhere('last_name', 'like', "%{$key}%")
                    ->orWhere('email', 'like', "%{$key}%")
                    ->orWhereRaw('CONCAT(first_name, last_name) LIKE ?', ["%{$key}%"]);
            });
        }

        if ($request->filled('gender') && $request->gender !== '全て') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('select_content')) {
            $query->where('select_content', $request->select_content);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        return $query;
    }

    public function export(Request $request)
    {
        $query = $this->getSearchQuery($request);
        $contacts = $query->get(); // 検索結果を全件取得

        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            // CSVのヘッダー（要件に合わせて調整）
            fputcsv($handle, ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせ内容']);

            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->first_name . ' ' . $contact->last_name,
                    $contact->gender,
                    $contact->email,
                    $contact->select_content,
                    $contact->content,
                ]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts_' . now()->format('YmdHis') . '.csv"',
        ]);

        return $response;
    }
}



