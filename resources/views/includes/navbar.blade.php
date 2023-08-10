<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="/images/logo.svg" alt="logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories') }}" class="nav-link">Categories</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Rewards</a>
                </li>
                @guest
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="btn btn-success nav-link px-4 text-white">Sign In</a>
                </li>
                @endguest
            </ul>
            @auth
            <ul class="navbar-nav d-none d-lg-flex">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <img src="{{ Auth::user()->photo_profile == 0 ? '/images/user.png' : Auth::user()->photo_profile }}" alt="" class="rounded-circle mr-2 profile-picture mb-2" style="max-height: 30px;" />
                        <span class="name-user d-inline-block mt-2 pt-1">Hi, {{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu">
                        <a href="@if (Auth::user()->roles == 'ADMIN')
                        {{ route('admin-dashboard')}}
                        @else
                        {{ route('dashboard')}}
                        @endif" class="dropdown-item">{{ Auth::user()->roles == 'ADMIN' ? 'Dashboard Admin' : 'Dashboard'}}</a>
                        @if (Auth::user()->roles == 'ADMIN')
                        <a href="{{ route('user.index')}}" class="dropdown-item">User Setting</a>
                        <a href="" class="dropdown-item">Setting Profile</a>
                        @else
                        <a href="{{ route('dashboard-settings-account') }}" class="dropdown-item">Setting Profile</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                        @php
                        $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                        @endphp
                        @if ($carts > 0)
                        <img src="/images/icon-cart-filled.svg" alt="">
                        <div class="card-badge">{{ $carts }}</div>
                        @else
                        <img src="/images/icon-cart-empty.svg" alt="">
                        @endif
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav d-block d-lg-none">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        Hi, Angga
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link d-inline-block">Cart</a>
                </li>
            </ul>
            @endauth
        </div>
    </div>
</nav>