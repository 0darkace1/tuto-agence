@extends('base')

@section('title', 'Login')

@section('content')
    <div class="h-100 d-flex flex-column align-items-center justify-content-center">

        <h1 class="mb-4">Agence Immo</h1>

        <form action="{{ route('login') }}" method="POST" class="p-4 w-50">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Adresse mail</label>
                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="email@example.com">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input id="password" name="password" type="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex flex-column justify-content-center text-center">
                <button type="submit" class="btn btn-dark mb-4">Se connecter</button>
                <a href="{{ route('register') }}">
                    Pas encore de compte ?
                </a>
            </div>
        </form>
    </div>
@endsection
