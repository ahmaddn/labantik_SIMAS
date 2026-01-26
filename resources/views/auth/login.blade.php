@extends('layouts.master')

@section('title', 'login')
@section('content')

    <div class="container-fluid">
        <div class="main-content d-flex flex-column p-0">
            <div class="m-lg-auto my-auto w-930 py-3">
                <div class="card bg-white border rounded-10 border-white py-4 px-4 px-md-5">
                    <div class="p-3">
                        <div class="text-center mb-3">
                            <h2 class="fs-32 fw-bold mb-1" style="color: #333;">
                                SIMAS
                            </h2>
                            <p class="fs-18 fw-medium mb-1" style="color: #666;">
                                Sistem Informasi Manajemen Surat
                            </p>
                            <p class="fs-16 mb-3" style="color: #888;">
                                SMKN 1 Talaga
                            </p>
                            <h3 class="fs-26 fw-medium mb-0">
                                Sign In SIMAS
                            </h3>
                        </div>
                        @error('email')
                            <div class="alert fs-16 alert-danger bg-transparent text-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        @error('password')
                            <div class="alert fs-16 alert-danger bg-transparent text-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        @if ($errors->any())
                            @foreach ($errors->getMessages() as $key => $error)
                                @if (!in_array($key, ['email', 'password']))
                                    <div class="alert fs-16 alert-danger bg-transparent text-danger" role="alert">
                                        {{ $error }}
                                    </div>
                                @endif
                            @endforeach
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="label fs-16 mb-2">
                                    Email Address
                                </label>
                                <div class="form-floating">
                                    <input class="form-control" id="floatingInput1" name="email"
                                        placeholder="Enter email address *" type="email" />
                                    <label for="floatingInput1">
                                        Enter email address *
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="label fs-16 mb-2">
                                    Your Password
                                </label>
                                <div class="form-group" id="password-show-hide">
                                    <div class="password-wrapper position-relative password-container">
                                        <input class="form-control text-secondary password" placeholder="Enter password *"
                                            type="password" name="password" />
                                        <i aria-hidden="true"
                                            class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 position-absolute cursor text-secondary"
                                            style="color: #A9A9C8; font-size: 22px; right: 15px;">
                                        </i>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-1">
                                    <div class="form-check">
                                        <input class="form-check-input" id="flexCheckDefault" type="checkbox"
                                            value="" />
                                        <label class="form-check-label fs-16" for="flexCheckDefault">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <button class="btn btn-primary fw-normal text-white w-100"
                                    style="padding-top: 18px; padding-bottom: 18px;" type="submit">
                                    Sign In
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
