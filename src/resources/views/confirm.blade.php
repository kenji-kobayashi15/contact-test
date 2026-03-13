@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h1>Confirm</h1>
    </div>
    <form class="form" action="/contacts/thanks" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <span>{{ $contact['first_name'] }} {{ $contact['last_name'] }}</span>
                        <input type="hidden" name="first_name" class="form__input" value="{{ $contact['first_name'] }}" />
                        <input type="hidden" name="last_name" class="form__input" value="{{ $contact['last_name'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <span>{{ $contact['gender'] }}</span>
                        <input type="hidden" name="gender" class="form__input" value="{{ $contact['gender'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <span>{{ $contact['email'] }}</span>
                        <input type="hidden" name="email" class="form__input" value="{{ $contact['email'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <span>{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}</span>
                        <input type="hidden" name="tel1" class="form__input" value="{{ $contact['tel1'] }}" readonly />
                        <input type="hidden" name="tel2" class="form__input" value="{{ $contact['tel2'] }}" readonly />
                        <input type="hidden" name="tel3" class="form__input" value="{{ $contact['tel3'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        {{-- 1. 表示用：これなら文字数に合わせて自動で改行もされます --}}
                        <span>{{ $contact['address1'] }}</span>

                        {{-- 2. データ送信用：裏側で値を保持 --}}
                        <input type="hidden" name="address1" class="form__input" value="{{ $contact['address1'] }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <span>{{ $contact['address2'] }}</span>
                        <input type="hidden" name="address2" class="form__input" value="{{ $contact['address2'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        {{-- 1. ユーザーに見せるための表示（inputではなくテキストとして出す） --}}
                        <span>{{ $contact['select_content'] }}</span>
                        {{-- 2. コントローラーに送るためのデータ（hiddenで隠して送る） --}}
                        <input type="hidden" name="select_content" class="form__input" value="{{ $contact['select_content'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        {{-- 表示用：改行を反映させるためのクラスを追加 --}}
                        <span class="confirm-item__textarea">{{ $contact['content'] }}</span>

                        {{-- 送信用 --}}
                        <input type="hidden" name="content" class="form__input" value="{{ $contact['content'] }}">
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