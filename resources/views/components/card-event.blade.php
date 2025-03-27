<article class="card">
    <a href="{{ route('events.show', ['slug' => $event->slug]) }}" title="découvrir {{ $event->title }}">
        <div class="img-contain">
            <img src="{{ asset($event->profile_pic) }}" alt="{{ $event->title }}" class="card-image">
        </div>
        <div class="card-content">
            <h3 class="card-title">{{ $event->title }}</h3>
            <p class="card-subtitle mt-1">Date: {{ $event->start_date }}</p>
            <p class="card-description">Performance: {{ $event->performance }}</p>
        </div>
    </a>
</article>