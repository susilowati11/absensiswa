@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card rounded-top"> <!-- Add the 'rounded-top' class here -->
                <div class="card-header fs-5">{{ __('Masuk') }}</div>

                <div class="card-body text-center">
                    <!-- Add a wrapper div for the logo with a class for styling -->
                    <div class="logo-container mb-4">
                        <img src="img/logosmk.jpg" alt="Your Image Alt Text" class="img-fluid mx-auto d-block logo" style="max-height: 150px;">
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Alamat Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-2 text-center">
                                <button type="submit" class="btn btn-primary btn-lg w-100"> <!-- Added 'w-100' for full width -->
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <style>
                        body {
                            background-color: #f8f9fa; 
                        }
                    
                        .card {
                            margin-top: 50px;
                            border: 1px solid #ddd;
                            border-radius: 8px; 
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                            background-color: #ffffff;
                        }

                        .rounded-top {
                            border-top-left-radius: 8px; 
                            border-top-right-radius: 8px; 
                        }
                    
                        .card-header {
                            background-color: #007bff;
                            color: #fff;
                            border-bottom: 1px solid #0069d9;
                        }
                    
                        .card-body {
                            padding: 20px;
                        }

                        /* Add styles for the logo container and hover effect */
                        .logo-container {
                            position: relative;
                            overflow: hidden;
                        }

                        .logo {
                            transition: transform 0.3s ease-in-out;
                        }

                        /* Apply the hover effect on the logo */
                        .logo-container:hover .logo {
                            transform: scale(1.1);
                        }
                    
                        label {
                            font-weight: bold;
                            margin-bottom: 0.5rem;
                            color: #495057;
                        }
                    
                        input {
                            margin-bottom: 1rem;
                            border: 1px solid #ced4da;
                            padding: 0.375rem 0.75rem;
                            border-radius: 0.25rem;
                        }
                    
                        .btn-primary {
                            background-color: #007bff;
                            border-color: #007bff;
                            color: #fff;
                        }
                    
                        .btn-primary:hover {
                            background-color: #0056b3;
                            border-color: #0056b3;
                        }
                    
                        .btn-link {
                            color: #007bff;
                        }
                    
                        .btn-link:hover {
                            text-decoration: underline;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
