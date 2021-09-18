@extends('custom-layouts.auth')
@section('title','Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-pattern shadow-none">
            <div class="card-body">
                <div class="text-center mt-4">
                    <div class="mb-3">
                        <a href="{{url('/')}}" class="logo"><img src="{{asset('veltrix/assets/images/bill.png')}}" height="100" alt="logo"></a>
                    </div>
                </div>
                <div class="p-3">
                    <h4 class="font-18 text-center">Welcome Back !</h4>
                    <p class="text-muted text-center mb-4">Sign in to continue to Invoice.</p>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form class="form-horizontal" action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="email" name="email" :value="old('email')" required autofocus class="form-control" id="username" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="userpassword">Password</label>
                            <input type="password"
                                   name="password"
                                   required autocomplete="current-password"  class="form-control" id="userpassword" placeholder="Enter password">
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
        <div class="mt-5 text-center text-white-50">
            <p>Don't have an account ? <a href="{{url('register')}}" class="font-500 text-white"> Signup now </a> </p>
            <p>© 2019 Veltrix. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
        </div>

    </div>
</div>
@endsection
