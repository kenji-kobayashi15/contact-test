<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サンクスページ</title>
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
</head>

<body>
    <div class="thanks__content">
        <div class="thanks__heading">
            <h1>お問い合わせありがとうございます</h1>
        </div>

        <div class="thanks__button">
            <a class="thanks__button-link" href="{{ route('contact.index') }}">HOME</a>
        </div>
    </div>
</body>

</html>