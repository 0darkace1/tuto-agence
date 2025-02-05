@extends('base')

@section('title', 'Accueil')

@section('content')
    <div class="text-center">
        <h1>Agence Immo</h1>

        <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi veniam id quaerat, velit ad doloremque qui
            dolorem
            architecto quasi iusto animi dolores soluta blanditiis fuga aspernatur optio odit debitis aperiam?
        </p>
    </div>

    <div>
        <h3>
            Les derniers biens
        </h3>

        <div class="row">
            @foreach ($properties as $property)
                @include('properties.card', $property)
            @endforeach
        </div>
    </div>
@endsection
