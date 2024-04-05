@extends('layouts.app')
@section('title', 'Ecommerce App| Thanks')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<style>
    @keyframes borderAnimation {
        0% {
            border-color: #2193b0;
        }

        25% {
            border-color: #6dd5ed;
        }

        50% {
            border-color: #ff9a8b;
        }

        75% {
            border-color: #ff6a88;
        }

        100% {
            border-color: #ff99ac;
        }
    }

    @keyframes gradientEffect {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }
</style>


@section('content')

    <section class="container"><br />
        <div
            style="position: relative; padding: 50px; border: 5px solid transparent; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); animation: borderAnimation 2s linear infinite; text-align: center;">
            <span
                style="background: linear-gradient(45deg, #2193b0, #6dd5ed, #ff9a8b, #ff6a88, #ff99ac, #f6d365, #fda085, black); background-size: 200% 200%; -webkit-text-fill-color: transparent; -webkit-background-clip: text; animation: gradientEffect 5s ease-in-out infinite; font-size: 2em; display: block;">
                👍 Thank you for Your Order!!👍<br />
                <a href="{{ url('myorders') }}">👉Check This Out</a>
            </span><br />
        </div>
    </section>

@endsection