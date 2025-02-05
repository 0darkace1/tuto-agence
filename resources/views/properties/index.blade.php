@extends('base')

@section('title', 'Nos Biens')

@section('content')
    <h1 class="mb-4">Trouvez le bien adapté a vos exigences</h1>

    <div class="card mb-4">
        <div class="card-header">
            Filtres
        </div>

        <form class="card-body p-4" action="" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-12 col-md">
                    <label for="surface" class="form-label">Surface minimum</label>
                    <input id="surface" name="surface" type="number" value="{{ $input['surface'] ?? '' }}"
                        class="form-control">
                </div>
                <div class="col-12 col-md">
                    <label for="rooms" class="form-label">Nombre de pièces min</label>
                    <input id="rooms" name="rooms" type="number" value="{{ $input['rooms'] ?? '' }}"
                        class="form-control">
                </div>
                <div class="col-12 col-md">
                    <label for="price" class="form-label">Budget max</label>
                    <input id="price" name="price" type="number" value="{{ $input['price'] ?? '' }}"
                        class="form-control">
                </div>
                <div class="col-12 col-md">
                    <label for="keyword" class="form-label">Mot clef</label>
                    <input id="keyword" name="keyword" type="text" value="{{ $input['keyword'] ?? '' }}"
                        class="form-control">
                </div>
                <div class="col-12 col-md-auto align-self-end">
                    <button type="submit" class="btn btn-dark w-100">Rechercher</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">

        @forelse ($properties as $property)
            @include('properties.card', $property)
        @empty
            <p>Aucun bien ne correspond à votre recherche</p>
        @endforelse
    </div>

    <div class="my-4">
        {{ $properties->links() }}
    </div>
@endsection
