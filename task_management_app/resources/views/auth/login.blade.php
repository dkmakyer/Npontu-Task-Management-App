@extends('layout.base')
@section('pageTitle')
    <title>Sign In</title>
@endsection

@section('stylesheet')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endsection

@section('script')
    <script src="{{ asset('assets/js/login.js') }}" defer></script>
@endsection

@section('body')

    <body>
        <div class="container">
            <div class="form-wrapper">
                <div class="content">
                    <!-- Left Section -->
                    <div class="left-section">
                        @session('error')
                            <p style="color: red; font-size: large; text-align: center;">{{ session('error') }}</p>
                        @endsession
                        <h1>Sign In</h1>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <!-- Username Input -->
                            <div class="input-group">
                                <img src="https://dashboard.codeparrot.ai/api/image/Z8jW1LwkNXOiaV83/mdi-user.png"
                                    class="input-icon">
                                <input type="text" id="username" placeholder="Enter Username" name="username">
                                @error('username')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="input-group">
                                <img src="https://dashboard.codeparrot.ai/api/image/Z8jW1LwkNXOiaV83/mdi-pass.png"
                                    class="input-icon">
                                <input type="password" id="password" placeholder="Enter Password" name="password">
                                @error('password')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="remember-me">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Remember Me</label>
                            </div>

                            <!-- Login Button -->
                            <button class="login-btn" id="loginBtn" type="submit">Login</button>
                        </form>

                        <!-- Social Login -->
                        <div class="social-login">
                            <p>Or, Login with</p>
                            <div class="social-icons">
                                {{-- <a href="{{ route('social.login', 'facebook') }}">
                                    <img src="https://static.xx.fbcdn.net/rsrc.php/v3/yG/r/pENh3y_2Pnw.png" alt="Facebook">
                                </a> --}}
                                <a href="{{ route('social.login', 'google') }}">
                                    <img src="https://banner2.cleanpng.com/20190228/qby/kisspng-google-logo-google-account-g-suite-google-images-g-icon-archives-search-png-1713904157115.webp"
                                        alt="Google">
                                </a>
                                {{-- <a href="{{ route('social.login', 'x') }}">
                                    <img src="https://img.freepik.com/premium-vector/new-twitter-logo-x-2023-twitter-x-logo-vector-download_691560-10808.jpg?semt=ais_hybrid"
                                        alt="Twitter">
                                </a> --}}
                            </div>
                        </div>

                        <!-- Create Account Link -->
                        <p class="signup-text">
                            Don't have an account? <a href="{{ route('register') }}">Create One</a>
                        </p>
                    </div>

                    <!-- Right Section - Image -->
                    <div class="right-section">
                        <img src="https://dashboard.codeparrot.ai/api/image/Z8jW1LwkNXOiaV83/ach-3-1.png">
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
