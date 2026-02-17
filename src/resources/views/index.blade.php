@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="/contacts/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="name" name="first_name" value="{{old('first_name')}}" placeholder="例:山田" />
                    <input type="name" name="last_name" value="{{old('last_name')}}" placeholder="例:太郎" />
                </div>
                <div class="form__error">
                    @error('first_name')
                    {{$message}}
                    @enderror
                    @error('last_name')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="radio" name="gender" value="男性"
                        @checked(old('gender')=='男性' || !old('gender')) />男性

                    <input type="radio" name="gender" value="女性"
                        @checked(old('gender')=='女性' ) />女性

                    <input type="radio" name="gender" value="その他"
                        @checked(old('gender')=='その他' ) />その他
                </div>
                <div class="form__error">
                    @error('gender')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email"
                        name="email"
                        value="{{old('email')}}"
                        placeholder="test@example.com" />
                </div>
                <div class="form__error">
                    @error('email')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="tel"
                        name="tel1"
                        value="{{old('tel1')}}"
                        placeholder="080" />
                    <span>-</span>
                    <input type="tel"
                        name="tel2"
                        value="{{old('tel2')}}"
                        placeholder="1234" />
                    <span>-</span>
                    <input type="tel"
                        name="tel3"
                        value="{{old('tel3')}}"
                        placeholder="5678" />
                </div>
                <div class="form__error">
                    @error('tel1')
                    {{$message}}
                    @enderror
                    @error('tel2')
                    {{$message}}
                    @enderror
                    @error('tel3')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text"
                        name="address1"
                        value="{{old('address1')}}"
                        placeholder="例:東京都渋谷区千駄ヶ谷123" />
                </div>
                <div class="form__error">
                    @error('address1')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form_group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text"
                        name="address2"
                        value="{{old('address2')}}"
                        placeholder="例:千駄ヶ谷マンション101" />
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ種類</span>
                <span class="form__label--item">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--select">
                    <select name="select_content">
                        <option value="" hidden>選択してください</option>

                        <option value="商品のお届けについて" @selected(old('select_content')=='商品のお届けについて' )>商品のお届けについて</option>
                        <option value="商品の交換について" @selected(old('select_content')=='商品の交換について' )>商品の交換について</option>
                        <option value="商品トラブル" @selected(old('select_content')=='商品トラブル' )>商品トラブル</option>
                        <option value="ショップへのお問い合わせ" @selected(old('select_content')=='ショップへのお問い合わせ' )>ショップへのお問い合わせ</option>
                        <option value="その他" @selected(old('select_content')=='その他' )>その他</option>
                    </select>
                    <div class="form__error">
                        @error('select_content')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--item">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="content" placeholder="お問い合わせ内容をご記載ください">{{ old('content')}}</textarea>
                </div>
                <div class="form__error">
                    @error('content')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button--submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection