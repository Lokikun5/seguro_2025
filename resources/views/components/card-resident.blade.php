<article class="card">
    <a href="{{ route('residents.show', ['slug' => $resident->resident_slug]) }}" title="découvrir {{ $resident->first_name }} {{ $resident->last_name }}">
        <div class="img-contain">
            <img src="{{ $resident->profile_pic }}" alt="{{ $resident->first_name }} {{ $resident->last_name }}" class="card-image">
        </div>
        <div class="card-content">
            <h3 class="card-title">{{ $resident->first_name }} {{ $resident->last_name }}</h3>
            <p class="card-subtitle">Nationalité: {{ $resident->nationality }}</p>
            <p class="card-description">Performance: {{ $resident->performance }}</p>
        </div>
    </a>
</article>