@extends('base')

@section('title', $property->exists ? 'Éditer un bien' : 'Créer un bien')

@section('content')
    <h1>@yield('title')</h1>

    <form class="vstack gap-2"
        action="{{ route($property->exists ? 'admin.properties.update' : 'admin.properties.store', ['property' => $property]) }}"
        method="POST" enctype="multipart/form-data">

        @csrf
        @method($property->exists ? 'put' : 'post')

        <div class="row">
            <div class="col vstack gap-2" style="flex: 100">
                <div class="row">
                    @include('shared.input', [
                        'label' => 'Titre',
                        'name' => 'title',
                        'value' => $property->title,
                        'class' => 'col',
                    ])
                    <div class="col row">
                        @include('shared.input', [
                            'label' => 'Surface',
                            'name' => 'surface',
                            'value' => $property->surface,
                            'class' => 'col',
                        ])
                        @include('shared.input', [
                            'label' => 'Prix',
                            'name' => 'price',
                            'type' => 'number',
                            'value' => $property->price,
                            'class' => 'col',
                        ])
                    </div>
                </div>
                @include('shared.input', [
                    'label' => 'Description',
                    'name' => 'description',
                    'type' => 'textarea',
                    'value' => $property->description,
                ])
                <div class="row">
                    @include('shared.input', [
                        'label' => 'Pièces',
                        'name' => 'rooms',
                        'type' => 'number',
                        'value' => $property->rooms,
                        'class' => 'col',
                    ])
                    @include('shared.input', [
                        'label' => 'Chambres',
                        'name' => 'bedrooms',
                        'type' => 'number',
                        'value' => $property->bedrooms,
                        'class' => 'col',
                    ])
                    @include('shared.input', [
                        'label' => 'Étage',
                        'name' => 'floor',
                        'type' => 'number',
                        'value' => $property->floor,
                        'class' => 'col',
                    ])
                </div>
                <div class="row">
                    @include('shared.input', [
                        'label' => 'Adresse',
                        'name' => 'address',
                        'type' => 'text',
                        'value' => $property->address,
                        'class' => 'col',
                    ])
                    @include('shared.input', [
                        'label' => 'Ville',
                        'name' => 'city',
                        'type' => 'text',
                        'value' => $property->city,
                        'class' => 'col',
                    ])
                    @include('shared.input', [
                        'label' => 'Code Postale',
                        'name' => 'postal_code',
                        'type' => 'text',
                        'value' => $property->postal_code,
                        'class' => 'col',
                    ])
                </div>
                @include('shared.select', [
                    'label' => 'Options',
                    'name' => 'options',
                    'value' => $property->options()->pluck('id'),
                    'multiple' => true,
                    'options' => $options,
                ])
                @include('shared.checkbox', [
                    'label' => 'Vendu',
                    'name' => 'sold',
                    'value' => $property->sold,
                ])

                <div>
                    <button class="btn btn-dark">
                        @if ($property->exists)
                            Modifier
                        @else
                            Créer
                        @endif
                    </button>
                </div>
            </div>

            <div class="col vstack gap-2" style="flex: 25">
                @foreach ($property->pictures as $picture)
                    <div id="picture-{{ $picture->id }}" class="position-relative">
                        <img src="{{ $picture->getImageUrl() }}" class="d-block w-100">
                        <button type="button" class="btn btn-danger position-absolute bottom-0 w-100 start-0"
                            hx-delete="{{ route('admin.picture.destroy', $picture) }}" hx-swap="delete"
                            hx-target="#picture-{{ $picture->id }}
                            ">
                            <span class="htmx-indicator spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span>
                            Supprimer
                        </button>
                    </div>
                @endforeach

                @include('shared.upload', [
                    'label' => 'Images',
                    'name' => 'pictures',
                    'multiple' => true,
                    'class' => 'col',
                ])
            </div>
        </div>
    </form>
@endsection
