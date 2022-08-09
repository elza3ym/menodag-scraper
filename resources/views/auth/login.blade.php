<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} | Signin</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="/assets/css/themes/lite-purple.min.css" rel="stylesheet">
</head>
<div class="auth-layout-wrap" style="background-image: url(/assets/images/photo-wide-4.jpg)">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-4 pt-5 pb-5">
                        <div class="auth-logo text-center mb-4"><img src="/assets/images/logo.png" alt=""></div>
                        <h1 class="mb-3 text-18">Sign In</h1>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control form-control-rounded @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control form-control-rounded @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn btn-rounded btn-primary btn-block mt-5">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
