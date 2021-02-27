<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sài Gòn coffee</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('assets/logo.ico') }}" />

        <!-- Styles -->
        <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            width: 100vw;
            height: 100vh;
            background: yellow;;
        }
        </style>
    </head>
    <body>

        <div class="content">
            <h1> RESTful API </h1>
            <div class="title m-b-md">
                Sài Gòn coffee
            </div>
        </div>
        <div class="footer">
            Source by <a href="https://www.facebook.com/tandangfit">Đặng Minh Tân</a> & <a href="https://www.facebook.com/LeNgoc2408">Nguyễn Ngọc Lễ</a>
        </div>
    </body>
</html>