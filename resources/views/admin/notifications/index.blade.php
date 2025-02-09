@extends('base')

@section('title', 'Liste des notifications')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Notifications</h1>
        {{-- <a href="{{ route('admin.options.create') }}" class="btn btn-dark">Ajouter une option</a> --}}
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Notification</th>
                <th>Message</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($notifications as $notification)
                <tr>
                    <td>
                        {{ $notification->data['notification_title'] }}
                    </td>
                    <td>
                        {{ $notification->data['notification_description'] }}
                    </td>
                    <td class="text-end">
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a class="btn btn-success"
                                href="{{ route('admin.notifications.show', $notification->id) }}">Voir</a>

                            <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST">
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
@endsection
