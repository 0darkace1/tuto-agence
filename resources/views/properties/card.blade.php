<div class="col-md-3 mb-4">
    <div class="card h-100">
        @if ($property->getPicture())
            <img src="{{ $property->getPicture()->getImageUrl(360, 230) }}" class="card-img-top h-100">
        @else
            <img src="https://i0.wp.com/citygem.app/wp-content/uploads/2024/08/placeholder-8.png?ssl=1"
                class="card-img-top h-100">
        @endif
        <div class="card-body">
            <a href="{{ route('properties.show', ['slug' => $property->getSlug(), 'property' => $property]) }}">
                <h5 class="card-title">
                    {{ $property->title }}
                </h5>
            </a>
            <p class="card-text">
                {{ $property->surface }} m² - {{ $property->city }} ({{ $property->postal_code }})
            </p>
            <p class="fs-4 card-text text-primary" style="font-size: 1.4rem;">
                @if ($property->sold)
                    <span class="text-danger"
                        style="text-decoration:line-through;">{{ number_format($property->price, thousands_separator: ' ') }}
                        €</span>
                @else
                    {{ number_format($property->price, thousands_separator: ' ') }} €
                @endif
            </p>
        </div>
        <div class="card-footer text-center">
            @if ($property->sold)
                <p class="card-text text-danger">
                    Vendu
                </p>
            @else
                <p class="card-text">
                    Disponible
                </p>
            @endif
        </div>
    </div>
</div>
