<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>Crud</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="{{url('/js/jquery.populate.js')}}"></script>


        <script>
baseUrl = '';
appendHTML = false;
id = 0;
        </script>

        <style type="text/css">
            .formError{
                border: 1px solid #ec0e0e;
            }
        </style>
    </head>

    <body>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

        <!-- Fixed navbar -->
        <nav class="navbar navbar-defaul">
            <div class="container">
                <div class="navbar-header">
                    <!-- The mobile navbar-toggle button can be safely removed since you do not need it in a non-responsive implementation -->
                    <a class="navbar-brand" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                                        href="{{url('logout')}}">Sair
                    </a>
                    <a class="navbar-brand" href="{{url('estado')}}">Cadastro Estados</a>
                </div>

            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>


    </body>
</html>