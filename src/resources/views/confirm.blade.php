@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>お問い合わせ内容確認</h2>
    </div>
    <form class="form" action="/contacts/thanks" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <input type="name" name="first_name" value="{{$contact['first_name']}}" readonly />
                        <input type="name" name="last_name" value="{{$contact['last_name']}}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <input type="text" name="gender" value="{{$contact['gender']}}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="email" name="email" value="{{$contact['email']}}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <input type="tel" name="tel1" value="{{$contact['tel1']}}" readonly />
                        <input type="tel" name="tel2" value="{{$contact['tel2']}}" readonly />
                        <input type="tel" name="tel3" value="{{$contact['tel3']}}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        {{-- 1. 表示用：これなら文字数に合わせて自動で改行もされます --}}
                        <span>{{ $contact['address1'] }}</span>

                        {{-- 2. データ送信用：裏側で値を保持 --}}
                        <input type="hidden" name="address1" value="{{ $contact['address1'] }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address2" value="{{$contact['address2']}}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        {{-- 1. ユーザーに見せるための表示（inputではなくテキストとして出す） --}}
                        <span>{{ $contact['select_content'] }}</span>
                        {{-- 2. コントローラーに送るためのデータ（hiddenで隠して送る） --}}
                        <input type="hidden" name="select_content" value="{{$contact['select_content']}}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        {{-- 表示用：改行を反映させるためのクラスを追加 --}}
                        <span class="confirm-item__textarea">{{ $contact['content'] }}</span>

                        {{-- 送信用 --}}
                        <input type="hidden" name="content" value="{{ $contact['content'] }}">
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__button-container">
            <button class="form__button form__button--submit" type="submit" name="action" value="submit">
                送信
            </button>
            <button class="form__button form__button--back" type="submit" name="action" value="back">
                修正
            </button>
        </div>
    </form>
</div>
@endsection