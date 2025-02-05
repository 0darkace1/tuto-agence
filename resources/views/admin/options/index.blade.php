@extends('base')

@section('title', 'Liste des options')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Liste des options</h1>
        <a href="{{ route('admin.options.create') }}" class="btn btn-dark">Ajouter une option</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($options as $option)
                <tr>
                    <td>{{ $option->name }}</td>
                    <td class="text-end">
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a class="btn btn-warning" href="{{ route('admin.options.edit', $option->id) }}">Éditer</a>

                            <form action="{{ route('admin.options.destroy', $option) }}" method="POST">
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

    {{ $options->links() }}
@endsection
