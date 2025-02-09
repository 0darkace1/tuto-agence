@extends('base')

@section('title', 'Liste des notifications')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Notification</h1>
        {{-- <a href="{{ route('admin.options.create') }}" class="btn btn-dark">Ajouter une option</a> --}}
    </div>

    <div>
        {{-- @dd($notification) --}}
        <h3>Nouvelle demande de contact</h3>
        <p>Une nouvelle demande de contact a été fait pour le bien {{ $notification->data['title'] }}</p>
        <ul>
            <li>Nom: {{ $notification->data['lastname'] }}</li>
            <li>Prénom: {{ $notification->data['firstname'] }}</li>
            <li>Téléphone: {{ $notification->data['phone'] }}</li>
            <li>Email: {{ $notification->data['email'] }}</li>
        </ul>
        <h3>Message:</h3>
        <p>
            {{ $notification->data['message'] }}
        </p>
    </div>

@endsection
