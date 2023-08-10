@extends('layouts.auth')

@section('content')
<div class="page-content page-auth">
    <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center row-login">
                <div class="col-lg-6 text-center">
                    <img src="/images/login-placeholder.png" alt="" class="w-50 mb-4 mb-lg-none" />
                </div>
                <div class="col-lg-5">
                    <h2>
                        Belanja kebutuhan utama,<br />
                        menjadi lebih mudah
                    </h2>
                    <form method="POST" action="{{ route('login') }}" class="mt-3">
                        @csrf
                        <x-Widgets.CustomAlert :messages="$errors->get('eandp')" class="mt-2 text-danger" />
                        <x-Widgets.CustomAlert :messages="$errors->get('email')" class="mt-2 text-danger" />
                        <x-Widgets.CustomAlert :messages="$errors->get('password')" class="mt-2 text-danger" />
                        <div class="form-group mb-3">
                            <label class="form-label" for="email">Email Address</label>
                            <input type="email" class="form-control w-75" id="email" name="email" required autofocus />

                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" class="form-control w-75" id="password" name="password" required autocomplete="current-password" />

                        </div>
                        <div class="form-group mt-3">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                        <div class="form-group flex items-center justify-end mt-3">
                            @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success btn-block w-75 mt-4">Sign In to My Account
                        </button>
                        <a href="{{ __('register') }}" class="btn btn-signup btn-block w-75 mt-2">Sign Up</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection