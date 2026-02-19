<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                <h1>FashionablyLate</h1>
            </div>
                <nav>
                    <ul class="header-nav">
                        @if (Request::is('register'))
                        <li class="header-nav__item">
                            <a class="header-btn" href="/login">login</a>
                        </li>
                        @elseif (Request::is('login'))
                        <li class="header-nav__item">
                            <a class="header-btn" href="/register">register</a>
                        </li>
                        @endif

                        {{-- ログイン後の管理画面などでログアウトを表示する場合 --}}
                        @auth
                        <li class="header-nav__item">
                            <form action="/logout" method="post" class="header-nav__form">
                                @csrf
                                <button type="submit" class="header-btn" id="logout-button">logout</button>
                            </form>
                        </li>
                        @endauth
                    </ul>
                </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>