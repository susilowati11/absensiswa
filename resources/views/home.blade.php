@extends('layouts.sidebar')
@section('content')
    <div class="content">
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            {{-- <form class="d-none d-md-flex ms-4">
                <input class="form-control border-0" type="search" placeholder="Search">
            </form> --}}
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                    {{-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-envelope me-lg-2"></i>
                    <span class="d-none d-lg-inline-flex">Message</span>
                </a> --}}
                    {{-- <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <div class="ms-2">
                                <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                <small>15 minutes ago</small>
                            </div>
                        </div>
                    </a>
                    <hr class="dropdown-divider">
                    <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <div class="ms-2">
                                <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                <small>15 minutes ago</small>
                            </div>
                        </div>
                    </a>
                    <hr class="dropdown-divider">
                    <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <div class="ms-2">
                                <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                <small>15 minutes ago</small>
                            </div>
                        </div>
                    </a>
                    <hr class="dropdown-divider">
                    <a href="#" class="dropdown-item text-center">See all message</a>
                </div>
            </div>
            <div class="nav-item dropdown"> --}}
                    {{-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-bell me-lg-2"></i>
                    <span class="d-none d-lg-inline-flex">Notificatin</span>
                </a> --}}
                    {{-- <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
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
                    </div> --}}
                </div>
                <div class="nav-item dropdown">
                    {{-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> --}}
                    {{-- <img class="rounded-circle me-lg-2" src="img/user.jpg" alt=""
                            style="width: 40px; height: 40px;"> --}}
                    {{-- <span class="d-none d-lg-inline-flex">John Doe</span> --}}
                    {{-- </a> --}}
                    {{-- <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="#" class="dropdown-item">My Profile</a>
                        <a href="#" class="dropdown-item">Settings</a>
                        <a href="#" class="dropdown-item">Log Out</a>
                    </div> --}}
                </div>
            </div>
        </nav>


        <html lang="en">

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
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                .dashboard-item img {
                    max-width: 100%;
                    height: auto;
                    border-radius: 8px;
                    margin-bottom: 10px;
                }

                nav {
                    background-color: lightblue;
                    color: #161515;
                    padding: 1em;
                }

                nav ul {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                    display: flex;
                }

                nav li {
                    margin-right: 20px;
                }

                nav a {
                    text-decoration: none;
                    color: blue font-weight: bold;
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
                <h1>Selamat Datang Di Aplikasi Absen Siswa</h1>
            </header>
            <section>
                <div class="dashboard-item">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/logosmk.jpg" alt="" style="width: 60px; height: 50px;">
                        <div>
                            <h2>SMK NEGERI TAMBAKBOYO</h2>
                            <p>SMK BISA, HEBAT </p>
                            <p> "Jangan takut salah ketika menuntut ilmu karena banyak orang sukses belajar dari sebuah
                                kesalahan."</p>
                        </div>
            </section>
        </body>

        </html>
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    @endsection

  
