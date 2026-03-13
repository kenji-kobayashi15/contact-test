@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h1>Contact</h1>
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
                    <input type="text" name="first_name" class="form__input" value="{{ old('first_name') }}" placeholder="例:山田" />
                    <input type="text" name="last_name" class="form__input" value="{{ old('last_name') }}" placeholder="例:太郎" />
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
                    <input type="radio" name="gender" class="form__input" value="男性"
                        {{ old('gender', '男性') == '男性' ? 'checked' : '' }} />男性

                    <input type="radio" name="gender" class="form__input" value="女性"
                        {{ old('gender') == '女性' ? 'checked' : '' }} />女性

                    <input type="radio" name="gender" class="form__input" value="その他"
                        {{ old('gender') == 'その他' ? 'checked' : '' }} />その他
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
                        class="form__input"
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
                        class="form__input"
                        value="{{old('tel1')}}"
                        placeholder="080" />
                    <span>-</span>
                    <input type="tel"
                        name="tel2"
                        class="form__input"
                        value="{{old('tel2')}}"
                        placeholder="1234" />
                    <span>-</span>
                    <input type="tel"
                        name="tel3"
                        class="form__input"
                        value="{{old('tel3')}}"
                        placeholder="5678" />
                </div>
                {{-- 電話番号バリデーション --}}
                <div class="form__error">
                    @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                    {{ $errors->first('tel1') ?: ($errors->first('tel2') ?: $errors->first('tel3')) }}
                    @endif
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
                        class="form__input"
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
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text"
                        name="address2"
                        class="form__input"
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
                        <option value="商品のお届けについて" {{ old('select_content') == '商品のお届けについて' ? 'selected' : '' }}>商品のお届けについて</option>
                        <option value="商品の交換について" {{ old('select_content') == '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
                        <option value="商品トラブル" {{ old('select_content') == '商品トラブル' ? 'selected' : '' }}>商品トラブル</option>
                        <option value="ショップへのお問い合わせ" {{ old('select_content') == 'ショップへのお問い合わせ' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                        <option value="その他" {{ old('select_content') == 'その他' ? 'selected' : '' }}>その他</option>
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
                    <textarea name="content" class="form__input" placeholder="お問い合わせ内容をご記載ください">{{ old('content') }}</textarea>
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