@extends('base')

@section('title', 'Liste des biens')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Liste des utilisateurs</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-dark">Ajouter un utilisateur</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Email vérifié</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->email_verified_at ? 'Oui' : 'Non' }}</td>
                    <td class="text-end">
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a class="btn btn-warning" href="{{ route('admin.users.edit', $user->id) }}">Éditer</a>

                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
@endsection
