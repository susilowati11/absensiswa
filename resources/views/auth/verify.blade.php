@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
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
                        }
                    
                        .card-header {
                            background-color: #007bff; 
                            color: #fff;
                            border-bottom: 1px solid #0069d9; 
                        }
                    
                        .card-body {
                            padding: 20px; 
                        }
                    
                        label {
                            font-weight: bold;
                            margin-bottom: 0.5rem;
                        }
                    
                        input {
                            margin-bottom: 1rem;
                        }
                    
                        .btn-primary {
                            background-color: #007bff; 
                            border-color: #007bff;
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
