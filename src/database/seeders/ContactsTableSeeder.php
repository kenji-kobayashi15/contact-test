<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact; // ★この1行を必ず追加してください

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacts = [
            [
                'first_name' => 'テスト',
                'last_name' => '太郎',
                'gender' => 1,
                'email' => 'test1@example.com',
                'tel1' => '090',
                'tel2' => '1111',
                'tel3' => '1111',
                'address1' => '東京都渋谷区',
                'address2' => '千駄ヶ谷1-1-1',
                'select_content' => '商品のお届けについて',
                'content' => '1件目のテスト投稿です。',
            ],
            [
                'first_name' => 'サンプル',
                'last_name' => '花子',
                'gender' => 2,
                'email' => 'test2@example.com',
                'tel1' => '080',
                'tel2' => '2222',
                'tel3' => '2222',
                'address1' => '大阪府大阪市',
                'address2' => '中央区2-2-2',
                'select_content' => '商品の交換について',
                'content' => '2件目のテスト投稿です。改行を入れてみます。
正しく表示されるでしょうか。',
            ],
            [
                'first_name' => '佐藤',
                'last_name' => '一郎',
                'gender' => 1,
                'email' => 'test3@example.com',
                'tel1' => '070',
                'tel2' => '3333',
                'tel3' => '3333',
                'address1' => '愛知県名古屋市',
                'address2' => '中区3-3-3',
                'select_content' => '商品トラブル',
                'content' => '3件目のテスト投稿です。',
            ],
            [
                'first_name' => '鈴木',
                'last_name' => '二郎',
                'gender' => 1,
                'email' => 'test4@example.com',
                'tel1' => '050',
                'tel2' => '4444',
                'tel3' => '4444',
                'address1' => '福岡県福岡市',
                'address2' => '博多区4-4-4',
                'select_content' => 'ショップへのお問い合わせ',
                'content' => '4件目のテスト投稿です。',
            ],
            [
                'first_name' => '田中',
                'last_name' => '三郎',
                'gender' => 1,
                'email' => 'test5@example.com',
                'tel1' => '03',
                'tel2' => '5555',
                'tel3' => '5555',
                'address1' => '北海道札幌市',
                'address2' => '中央区5-5-5',
                'select_content' => 'その他',
                'content' => '5件目のテスト投稿です。',
            ],
        ];

        // ループで1件ずつ登録します
        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
