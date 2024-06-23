@extends('layouts.app_login')

@section('content')
    <div class="wrapper">
        <div class="main">
            <main class="content" style="background-image: url('img/bg-index.jpeg'); background-size: cover;">
                <div class="container-fluid">
                    <h1 class="text-center">EMPLOYEE MANAGEMENT</h1>
                    <div class="row card border p-5" style="margin: 50px 400px 50px 400px; box-shadow: 4px 4px 4px gray">
                        <div class="d-flex justify-content-center">
                            <h1 class="px-5 mt-3">Login ke Akun Anda</h1>
                        </div>
                        <br>
                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <input name="email" type="email" placeholder="Email" class="form-control mb-4">
                            <input name="password" type="password" placeholder="Password" class="form-control mb-4">
                            <button name="login" type="submit" class="btn btn-success w-100">Login</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
