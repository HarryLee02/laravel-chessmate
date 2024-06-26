<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('includes.header')
        <title>@yield('title')</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #2D3748;
                color: #636b6f;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 36px;
                padding: 20px;
            }
        </style>
    </head>
    <body>
        @include('includes.navbar')
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    @yield('code')
                    @yield('message')
                </div>
                <div>
                @yield('gif')
                </div>
            </div>
        </div>
    </body>
</html>
