<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Sign In</title>
    <meta charset="UTF-8">
    <meta name="description" content="Dashboard">
    <meta name="keywords" content="Dashboard">
    <meta name="author" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="apple-touch-icon" href="{{asset('assets/icons/apple-touch-icon-152x152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/icons/favicon-32x32.png')}}">

    <link href="{{asset('assets/css/theme.css')}}" rel="stylesheet" type="text/css" media="all">
</head>

<body class="signup-template bg-gray-100">

    <div class="row g-0 align-items-center">
        <div class="col-lg-7">
            <img src="{{asset('assets/img/signin-cover.jpg')}}" class="cover-fit" alt="Sign in Cover">
        </div>
        <div class="col-lg-5 px-md-3 px-xl-5">
            <div class="px-3 py-4 p-md-5 p-xxl-5 mx-xxl-4">
                <div class="login-form py-2 py-md-0 mx-auto mx-lg-0">
                    <h2 class="h1 mb-3">Sign in</h2>
                    <!-- <div class="pt-sm-1 pt-md-3 pb-1">
                        <a href="#" class="text-gray-700 font-weight-semibold border rounded px-sm-4 py-2 d-flex align-items-center justify-content-center bg-white">
                            <img src="https://fabrx.co/preview/muse-dashboard/assets/svg/icons/google-icon.svg" alt="Google">
                            <span class="ps-2 py-1 my-1 lh-sm">Sign in with Google</span>
                        </a>
                    </div>
                    <div class="position-relative">
                        <hr class="bg-gray-200 border-gray-200 opacity-100">
                        <span class="position-absolute top-0 start-50 translate-middle text-gray-600 small bg-gray-100 px-2 px-xxl-4 text-nowrap">Or sign up with email</span>
                    </div>-->
                    <form class="login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4 pb-md-2">
                            <label class="form-label form-label-lg" for="Username">Username</label>
                            <input type="email" name="email" class="form-control form-control-xl" id="Username" placeholder="Username">
                            @error('email')
                            <small class="red-text ml-7" >
                              {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="mb-4 pb-md-2">
                            <label class="form-label form-label-lg" for="Password">Password</label>
                            <input type="password" name="password" class="form-control form-control-xl" id="Password" placeholder="••••••••••••••••">
                            @error('password')
                            <small class="red-text ml-7" >
                              {{ $message }}
                            </small>
                            @enderror
                        </div>
                        {{-- <div class="mb-4 pb-md-2 {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <div class="" style="display: inline-block">
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                      <small class="red-text ml-7" >{{ $errors->first('g-recaptcha-response') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div> --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-xl btn-primary">Sign In</button>
                        </div>
                        <div class="my-4 d-flex pb-3">
                            <div class="form-check form-check-sm mb-0">
                                <input type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }} id="gridCheck">
                                <label class="form-check-label small text-gray-600" for="gridCheck">
Remember me
</label>
                            </div>
                            <a href="reset-password.html" class="small text-gray-600 ms-auto mt-1">Forgot password?</a>
                        </div>
                        <div class="border-top border-gray-200 pt-4">
                            <span class="text-gray-700">Don't have an account? <a href="signup.html" class="link-primary">Sign Up</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}" type="20920645ea1608fcf132a9e6-text/javascript"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="20920645ea1608fcf132a9e6-|49" defer=""></script>
    <script defer src="../../../../static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"64e1bebb5ee3d9dc","r":1,"version":"2021.4.0","si":10}'></script>
    {!! NoCaptcha::renderJs() !!}
</body>

<!-- signin-cover.html 06:57:15 GMT -->

</html>