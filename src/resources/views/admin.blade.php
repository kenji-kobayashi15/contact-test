@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-title">Admin</div>

<form action="{{ route('admin.search') }}" method="get" class="search-form">
    <input type="text" name="keyword" class="search-input" placeholder="名前やメールアドレス" value="{{ request('keyword') }}">

    <select name="gender" class="search-select">
        <option value="全て">性別</option>
        <option value="全て" @selected(request('gender')=='全て' )>全て</option>
        <option value="男性" @selected(request('gender')=='男性' )>男性</option>
        <option value="女性" @selected(request('gender')=='女性' )>女性</option>
        <option value="その他" @selected(request('gender')=='その他' )>その他</option>
    </select>

    <select name="select_content" class="search-select">
        <option value="">お問い合わせの種類</option>
        @foreach(['商品のお届けについて', '商品の交換について', '商品トラブル', 'ショップへのお問い合わせ', 'その他'] as $type)
        <option value="{{ $type }}" @selected(request('select_content')==$type)>{{ $type }}</option>
        @endforeach
    </select>

    <input type="date" name="date" class="search-input" value="{{ request('date') }}">

    <button type="submit" class="search-btn">検索</button>
    <a href="{{ route('admin.reset') }}" class="reset-btn">リセット</a>

    {{-- エクスポートボタン --}}
    <a href="{{ route('admin.export', request()->query()) }}" class="export-btn">
        エクスポート
    </a>
</form>

{{-- テーブル部分 --}}
<div class="pagination">
    {{ $contacts->links() }}
</div>
<table class="admin-table">

    <thead>
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
        <tr>
            <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
            <td>{{ $contact->gender }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->select_content }}</td>
            <td>
                <button class="detail-btn" onclick='openModal(@json($contact))'>詳細</button>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

{{-- 詳細表示モーダル --}}
<div id="detailModal" class="modal">
    <div class="modal-content">
        <div class="modal-close">
            <span class="close-btn" onclick="closeModal()">&times;</span>
        </div>

        <div class="modal-inner">
            <table class="modal-table">
                <tr>
                    <th>お名前</th>
                    <td><span id="modal-first-name"></span> <span id="modal-last-name"></span></td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td><span id="modal-gender"></span></td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td><span id="modal-email"></span></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td><span id="modal-tel"></span></td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td><span id="modal-address"></span></td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td><span id="modal-building"></span></td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td><span id="modal-content-type"></span></td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td><span id="modal-detail-content"></span></td>
                </tr>
            </table>

            <form action="{{ route('admin.delete') }}" method="POST" class="delete-form">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="modal-id">
                <button type="submit" class="delete-btn">削除</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(contact) {
        document.getElementById('detailModal').style.display = 'block';
        document.getElementById('modal-id').value = contact.id;
        document.getElementById('modal-first-name').innerText = contact.first_name;
        document.getElementById('modal-last-name').innerText = contact.last_name;
        document.getElementById('modal-gender').innerText = contact.gender;
        document.getElementById('modal-email').innerText = contact.email;
        document.getElementById('modal-tel').innerText = `${contact.tel1}${contact.tel2}${contact.tel3}`;
        document.getElementById('modal-address').innerText = contact.address1;
        document.getElementById('modal-building').innerText = contact.address2 || '';
        document.getElementById('modal-content-type').innerText = contact.select_content;
        document.getElementById('modal-detail-content').innerText = contact.content;
    }

    function closeModal() {
        document.getElementById('detailModal').style.display = 'none';
    }
</script>
@endsection