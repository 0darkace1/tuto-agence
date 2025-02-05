<x-mail::message>

# Nouvelle demande de contact

Une nouvelle demande de contact a été fait pour le bien <a
    href="{{ route('properties.show', ['slug' => $property->getSlug(), 'property' => $property]) }}">{{ $property->title }}</a>

-   Nom: {{ $data['lastname'] }}
-   Prénom: {{ $data['firstname'] }}
-   Téléphone: {{ $data['phone'] }}
-   Email: {{ $data['email'] }}

**Message :**<br />
{{ $data['message'] }}

</x-mail::message>
