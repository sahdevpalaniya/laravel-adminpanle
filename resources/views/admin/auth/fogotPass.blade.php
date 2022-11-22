<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $page_title }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/images/favicon.jpg') }}">
    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="h-100" style="background-image:url({{ url('assets/images/profile/Galaxy.jpg') }})">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h3 class="text-center mb-4">{{$form_heading}}</h3>
                                    @if (Session::has('error'))
                                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                    @endif
                                    @if (Session::has('success'))
                                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                                    @endif
                                    <form action="{{ route('send.email') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control" placeholder="Enter Your E-mail"
                                                name="email" value="{{ old('email') }}">
                                            <span class="text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-block btn-primary" type="submit">Send Me Mail</button>
                                        </div>
                                        <br>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="{{route('login')}}">Sign up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ url('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ url('assets/js/quixnav-init.js') }}"></script>
    <script src="{{ url('assets/js/custom.min.js') }}"></script>

</body>

</html>
