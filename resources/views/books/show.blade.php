<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Book Shop')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.bunny.net/css?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Vite Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">📚 Book Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}">🏠 Trang chủ</a></li>
                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="btn btn-warning position-relative text-dark fw-bold">
                            🛍 Giỏ Hàng
                            <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ session('cart') ? count(session('cart')) : 0 }}
                            </span>
                        </a>                        
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                                👤 {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">📊 Dashboard</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">🚪 Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">🔐 Đăng nhập</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}">📝 Đăng ký</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>   
    
    <!-- Main Content -->
    <main class="container mt-4 flex-grow-1">
        @yield('content')

        @isset($book)
        <div class="row align-items-center mt-5">
            <div class="col-md-5 text-center">
                <img src="{{ asset($book->image ? 'storage/' . $book->image : 'images/default-book.jpg') }}" 
                     alt="{{ $book->title }}" class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-md-7">
                <h2 class="fw-bold text-primary">{{ $book->title }}</h2>
                <p class="text-muted fs-5">✍️ Tác giả: <strong>{{ $book->author }}</strong></p>
                <p class="lead">{{ $book->description }}</p>
                <h4 class="text-danger fw-bold">{{ number_format($book->price, 0, ',', '.') }} VNĐ</h4>

                <div class="d-flex gap-3 mt-4">
                    
                    <a href="{{ route('home') }}" class="btn btn-lg btn-secondary">🏠 Quay lại trang chủ</a>
                </div>
            </div>
        </div>
        @endisset
    </main>
    
    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3 mt-4 shadow">
        &copy; {{ date('Y') }} Book Shop. All rights reserved.
    </footer>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
