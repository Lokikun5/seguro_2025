<section class="section-content">
    <h2>Nos évènements</h2>
    <p class="max-width-text">La Villa Seguro accueille des performances, expositions, projections et rencontres tout au long de l’année.  
        Rejoignez-nous pour célébrer la création sous toutes ses formes.
    </p>
    <div class="list">
        @forelse($events as $event)
            @include('components.card-event', ['events' => $event])
        @empty
            <p class="no-msg">Aucun évènement à venir pour le moment.</p>
        @endforelse
    </div>
    <a class="seguro-btn my-5" href="{{ route('events.index') }}">
        Découvrir les évènements
        <span class="arrow"></span>
    </a>
</section>