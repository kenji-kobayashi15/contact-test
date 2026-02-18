<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Admin</title>
    {{-- 共通のCSS（ロゴやヘッダー用） --}}
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    {{-- ページごとのCSSを読み込む場所 --}}
    @yield('css')
</head>

<body>
    <header class="header">
        {{-- 画像に合わせてロゴを配置 --}}
        <div class="header__inner">
            <a href="/admin" class="header__logo">FashionablyLate</a>
            <a href="/logout" class="logout-btn">logout</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>