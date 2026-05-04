@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0">
                <div class="card-body p-5">
                    <h3 class="text-center mb-4">Daftar Akun</h3>
                    <form action="{{ url('/register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control"
                                @error('name') is-invalid @enderror value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                @error('email') is-invalid @enderror value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                @error('password') is-invalid @enderror>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
                        <p class="text-center mt-3">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
