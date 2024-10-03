@extends('guest.layouts.main')
@section('isi')
    @if (session()->has('loginError'))
        <div class="d-flex align-items-center alert alert-danger alert-dismissible fade show p-2" role="alert">
            <i class="bi bi-exclamation-circle fs-3"></i>
            &ensp;{{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-5">
            <main class="form-signin">
                <form action="/login" method="POST">
                    @csrf
                    <img src="" class="d-block mx-auto mt-5" alt="" style="height: 200px">
                    <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>

                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username"
                            autofocus required>
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                            required>
                        <label for="password">Password</label>
                    </div>
                    <div class="ms-auto d-block">
                        <a href="/register" class="text-decoration-none btn ms-auto mb-4" style="background-color: #c7c7c7">
                            <span>
                                Sign up
                            </span>
                        </a>
                        <button class="ms-auto my-0 d-inline-block btn mb-4 text-white" style="background-color: #FF7E00"
                            type="submit">Sign
                            in</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
@endsection
