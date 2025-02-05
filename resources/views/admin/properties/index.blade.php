@extends('base')

@section('title', 'Liste des biens')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Liste des biens</h1>
        <a href="{{ route('admin.properties.create') }}" class="btn btn-dark">Ajouter un bien</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Surface</th>
                <th>Prix</th>
                <th>Ville</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($properties as $property)
                <tr>
                    <td>{{ $property->title }}</td>
                    <td>{{ $property->surface }}m²</td>
                    <td>{{ number_format($property->price, thousands_separator: ' ') }}€</td>
                    <td>{{ $property->city }}</td>
                    <td class="text-end">
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a class="btn btn-warning" href="{{ route('admin.properties.edit', $property->id) }}">Éditer</a>

                            @if ($property->deleted_at)
                                <form action="{{ route('admin.properties.restore', $property->id) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-success">Restaurer</button>
                                </form>
                            @else
                                <form action="{{ route('admin.properties.destroy', $property) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $properties->links() }}
@endsection
