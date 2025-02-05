@extends('base')

@section('title', 'Login')

@section('content')
    <div class="h-100 d-flex flex-column align-items-center justify-content-center">

        <h1 class="mb-4">Agence Immo</h1>

        <form action="{{ route('register') }}" method="POST" class="p-4 w-50">
            @csrf

            <div class="mb-3">
                @include('shared.input', [
                    'name' => 'name',
                    'label' => 'Nom',
                    'type' => 'text',
                ])
            </div>
            <div class="mb-3">
                @include('shared.input', [
                    'name' => 'email',
                    'label' => 'Email',
                    'type' => 'email',
                ])
            </div>
            <div class="mb-3">
                @include('shared.input', [
                    'name' => 'password',
                    'label' => 'Mot de passe',
                    'type' => 'password',
                ])
            </div>
            <div class="mb-3">
                @include('shared.input', [
                    'name' => 'password_confirm',
                    'label' => 'Confirmation mot de passe',
                    'type' => 'password',
                ])
            </div>

            <div class="d-flex flex-column justify-content-center text-center">
                <button type="submit" class="btn btn-dark mb-4">S'inscrire</button>
                <a href="{{ route('login') }}">
                    Déjà un inscrit ? Se connecter
                </a>
            </div>
    </div>
@endsection
