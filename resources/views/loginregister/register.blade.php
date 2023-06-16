@extends('loginregister.layout.main')

@section('container')
    <div class="limiter">
        <div class="container-regis100">
            <div class="wrap-regis100">
                <form class="regis100-form validate-form" action="/register" method="post">
                    @csrf
                    <span class="regis100-form-title p-b-43">
                        Sign up
                    </span>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="nama" id="nama"
                        value="{{ old('nama') }}">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Name</span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="username" id="username"
                        value="{{ old('username') }}">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Username</span>
                    </div>
                    
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="email" id="email"
                        value="{{ old('email') }}">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Email</span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="password" name="pass" id="pass">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>

                    {{-- <div class="flex-sb-m w-full p-t-3 p-b-32">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div>
                            <a href="#" class="txt1">
                                Forgot Password?
                            </a>
                        </div>
                    </div> --}}

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Register
                        </button>
                    </div>
                    
                    {{-- <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
                            or sign up using
                        </span>
                    </div> --}}

                    {{-- <div class="login100-form-social flex-c-m">
                        <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
                            <i class="fa fa-facebook-f" aria-hidden="true"></i>
                        </a>

                        <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                    </div> --}}
                </form>

                <div class="login100-more" style="background-image: url('../loginForm/images/bg-01.jpg');">
                </div>
            </div>
        </div>
    </div>    
@endsection

