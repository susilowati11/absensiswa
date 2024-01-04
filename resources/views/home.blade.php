@extends('layouts.sidebar')

@section('content')
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">Profile updated</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">New user added</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">Password changed</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item text-center">See all notifications</a>
                    </div>
                </div>
                <!-- Tambahkan formulir logout di dalam dropdown-menu -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger text-center" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">
                        <i class="fas fa-sign-out-alt me-1" style="font-size: 0.8rem;"></i> Logout
                    </button>
                </form>                
            </div>
        </nav>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dashboard</title>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #201a1a;
                }

                header {
                    background-color: lightblue;
                    color: #120e0e;
                    text-align: center;
                    padding: 1em;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 1.5);
                    margin-bottom: 20px;
                }

                section {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 80vh;
                }

                .dashboard-item {
                    text-align: center;
                    margin: 20px;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                    transition: transform 0.3s ease-in-out;
                }

                .dashboard-item img {
                    max-width: 100%;
                    height: auto;
                    border-radius: 8px;
                    margin-bottom: 10px;
                }

                .dashboard-item:hover {
                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
                    transform: scale(1.05);
                }

                @media (max-width: 600px) {
                    .dashboard-item {
                        margin: 10px;
                        padding: 10px;
                    }
                }
            </style>
        </head>


        <body>
            <header>
                @if (auth()->user()->hasRole('user'))
                <p style="font-size: 40px;">Selamat datang, {{ auth()->user()->name }}!</p>
                @elseif(auth()->user()->hasRole('admin'))
                    <h1>Selamat Datang, Admin!</h1>
                @else
                    <h1>Selamat Datang!</h1>
                @endif
            </header>
            <section>
                <div class="dashboard-item">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/logosmk.jpg" alt="" style="width: 60px; height: 50px;">
                        <div>
                            <h2>SMK NEGERI TAMBAKBOYO</h2>
                            <p>SMK BISA, HEBAT </p>
                            <p> "Jangan takut salah ketika menuntut ilmu karena banyak orang sukses belajar dari sebuah kesalahan."</p>
                        </div>
                    </div>
                </div>
            </section>
        </body>


    </div>
@endsection
