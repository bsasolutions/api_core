<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
</head>

<body>
    <p>{{ __('core/base.welcome_to_app', ['appName' => env('APP_NAME')]) }}</p>

    <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} PHP v{{ PHP_VERSION }} API v{{ env('APP_VERSION') }}
        Locale {{ config('app.locale') }}
    </p>

    {{ phpinfo() }}
</body>

</html>
