<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin | Forget Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/libs/toastr/build/toastr.min.css') }}">
</head>

<body class="auth-body-bg">
    <div class="bg-overlay"></div>
    <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mt-4">
                        <div class="mb-3">
                            <a href="javascript:;" class="auth-logo">
                                <img src="{{ asset('admin/assets/images/logo-dark.png') }}" height="30"
                                    class="logo-dark mx-auto" alt="">
                                <img src="{{ asset('admin/assets/images/logo-light.png') }}" height="30"
                                    class="logo-light mx-auto" alt="">
                            </a>
                        </div>
                    </div>

                    <p class="text-center font-size-16 mb-0">Forgot your password? No problem. Just let us know your
                        email address and we will email you a password reset link that will allow you to choose a new
                        one.</p>

                    <div class="p-3">
                        <form method="POST" action="{{ route('admin.password.email') }}" class="form-horizontal mt-3">
                            @csrf
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group text-center row mt-3 pt-1">
                                <div class="col-12">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Email
                                        Password Reset Link</button>
                                </div>
                            </div>

                            <div class="form-group mt-2 mb-0 row">
                                <div class="col-12 mt-3 text-center">
                                    <a href="{{ route('admin.login') }}" class="text-muted">Already have account?</a>
                                </div>
                            </div>
                        </form>
                        <!-- end form -->
                    </div>
                </div>
                <!-- end cardbody -->
            </div>
            <!-- end card -->
        </div>
        <!-- end container -->
    </div>
    <!-- end -->


    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    <!-- toastr plugin -->
    <script src="{{ asset('admin/assets/libs/toastr/build/toastr.min.js') }}"></script>
    <!-- toastr init -->
    <script src="{{ asset('admin/assets/js/pages/toastr.init.js') }}"></script>
    <script>
        // Display toast messages from session with nullable titles
        @if (Session::has('toast'))
            @php
                $toast = Session::get('toast');
            @endphp
            @if (!empty($toast['title']))
                toastr.{{ $toast['type'] }}('{{ $toast['message'] }}', '{{ $toast['title'] }}');
            @else
                toastr.{{ $toast['type'] }}('{{ $toast['message'] }}');
            @endif
        @endif
    </script>
</body>

</html>
