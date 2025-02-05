@extends('base')

@section('title', 'Bien')

@section('content')
    <h1 class="mb-4">
        @if ($property->sold)
            <span class="text-danger">Vendu</span> - {{ $property->title }}
        @else
            {{ $property->title }}
        @endif
    </h1>

    <div class="row d-flex flex-column flex-md-row mb-4">
        <div class="col-md-6 mb-md-4">
            {{-- <img src="https://i0.wp.com/citygem.app/wp-content/uploads/2024/08/placeholder-8.png?ssl=1"
                class="img-thumbnail w-100"> --}}
            <div id="carouselExample" class="carousel slide w-100">
                <div class="carousel-inner rounded">
                    @foreach ($property->pictures as $k => $picture)
                        <div class="carousel-item @if ($k === 0) active @endif">
                            <img src="{{ $picture->getImageUrl(800, 530) }}" class="d-block w-100">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="col-md-6">
            {{-- <h3>Appartement Plein Centre Ville</h3> --}}
            <h4>{{ $property->rooms }} pièces - {{ $property->surface }} m²</h4>
            <h2 class="card-text text-primary">
                @if ($property->sold)
                    <span class="text-danger"
                        style="text-decoration:line-through;">{{ number_format($property->price, thousands_separator: ' ') }}
                        €</span>
                @else
                    {{ number_format($property->price, thousands_separator: ' ') }} €
                @endif
            </h2>

            <hr>

            <h4>
                Intéressé par ce bien ?
            </h4>
            <form action="{{ route('properties.contact', $property) }}" method="POST" class="vstack gap-2">
                @csrf
                <div class="row">
                    @include('shared.input', [
                        'name' => 'lastname',
                        'label' => 'Nom',
                        'type' => 'text',
                        'value' => 'DOE',
                        'disabled' => $property->sold,
                        'class' => 'col',
                    ])
                    @include('shared.input', [
                        'name' => 'firstname',
                        'label' => 'Prénom',
                        'type' => 'text',
                        'value' => 'John',
                        'disabled' => $property->sold,
                        'class' => 'col',
                    ])
                </div>
                <div class="row">
                    @include('shared.input', [
                        'name' => 'phone',
                        'label' => 'Téléphone',
                        'type' => 'number',
                        'value' => '0612345678',
                        'disabled' => $property->sold,
                        'class' => 'col',
                    ])
                    @include('shared.input', [
                        'name' => 'email',
                        'label' => 'Email',
                        'type' => 'email',
                        'value' => 'email@example.com',
                        'disabled' => $property->sold,
                        'class' => 'col',
                    ])
                </div>
                @include('shared.input', [
                    'name' => 'message',
                    'label' => 'Message',
                    'type' => 'textarea',
                    'value' => 'Bonjour, ce bien m’intéresse',
                    'disabled' => $property->sold,
                    'class' => 'col',
                ])

                <div class="row g-2 align-items-center">
                    <button class="btn btn-dark" @disabled($property->sold) type="submit">Envoyer le message</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-8 mb-4">
        <p>
            {{ nl2br($property->description) }}
        </p>
    </div>

    <div class="row d-flex flex-column flex-md-row">
        <div class="col-md-8 mb-md-4">
            <h3>Caractéristiques</h3>

            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>Surface habitable</td>
                        <td>{{ $property->surface }} m²</td>
                    </tr>
                    <tr>
                        <td>Pièces</td>
                        <td>{{ $property->rooms }}</td>
                    </tr>
                    <tr>
                        <td>Chambres</td>
                        <td>{{ $property->bedrooms }}</td>
                    </tr>
                    <tr>
                        <td>Étage</td>
                        <td>{{ $property->floor ?: 'Rez de chaussé' }}</td>
                    </tr>
                    <tr>
                        <td>Localisation</td>
                        <td>{{ $property->city }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-4">
            <h3>Spécificités</h3>

            <ul class="list-group">
                @foreach ($property->options as $option)
                    <li class="list-group-item">{{ $option->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>


@endsection
