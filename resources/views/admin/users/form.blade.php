@extends('base')

@section('title', $user->exists ? 'Éditer un utilisateur' : 'Créer un utilisateur')

@section('content')
    <h1>@yield('title')</h1>

    <form class="vstack gap-2"
        action="{{ route($user->exists ? 'admin.users.update' : 'admin.users.store', ['user' => $user]) }}" method="POST">

        @csrf
        @method($user->exists ? 'put' : 'post')

        @include('shared.input', [
            'label' => 'Nom',
            'name' => 'name',
            'type' => 'text',
            'value' => $user->name,
        ])
        @include('shared.input', [
            'label' => 'Email',
            'name' => 'email',
            'type' => 'email',
            'value' => $user->email,
        ])
        @include('shared.input', [
            'label' => 'Mot de passe',
            'name' => 'password',
            'type' => 'password',
            // 'value' => $user->password,
        ])
        {{-- @include('shared.checkbox', [
            'label' => 'Email vérifié',
            'name' => 'email_verified_at',
            'value' => $user->email_verified,
        ]) --}}

        <div>
            <button class="btn btn-dark">
                @if ($user->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>
    </form>
@endsection
