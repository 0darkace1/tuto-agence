@extends('base')

@section('title', $option->exists ? 'Éditer une option' : 'Créer une option')

@section('content')
    <h1>@yield('title')</h1>

    <form class="vstack gap-2"
        action="{{ route($option->exists ? 'admin.options.update' : 'admin.options.store', ['option' => $option]) }}"
        method="POST">

        @csrf
        @method($option->exists ? 'put' : 'post')

        @include('shared.input', [
            'label' => 'Nom',
            'name' => 'name',
            'value' => $option->name,
        ])

        <div>
            <button class="btn btn-dark">
                @if ($option->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>
    </form>
@endsection
