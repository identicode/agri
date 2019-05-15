
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>System for Agricultural Local Entrepreneur</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                    <img src="{{ asset('img/logo.png') }}" width="300px" height="200px">
               
            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" method="POST" action="/change-password">
                            @csrf
                            <input type="hidden" name="uid" value="{{ $user }}">
                        
                        <div class="form-group">
                            <input type="text" name="pass" class="form-control" placeholder="New Password" autofocus required="">
                        </div>
                        
                        <button type="submit" class="btn btn-primary block full-width m-b">Submit</button>

                        <a href="/login">
                            <small>Return Login</small>
                        </a>
                    </form>
                    
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                System for Agricultural Local Entrepreneur
            </div>
            <div class="col-md-6 text-right">
               <small>© {{ date('Y', time()) }}</small>
            </div>
        </div>
    </div>

    @if(session('error'))
          <script>
            alert('{{ session('error') }}');
          </script>
        @endif


</body>

</html>
