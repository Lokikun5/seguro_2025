<section class="section-content">
    <h2>Les nouveaux résidents</h2>
    <p class="max-width-text">Découvrez les artistes actuellement en résidence à la Villa Seguro.  
    Chacun d’eux apporte son univers, ses disciplines et ses projets uniques.</p>
    <div class="list">
        @forelse($residents as $resident)
            @include('components.card-resident', ['resident' => $resident])
        @empty
            <p class="no-msg">Pas de nouveau résident pour le moment.</p>
        @endforelse
    </div>
    <a class="seguro-btn my-5" href="{{ route('residents.index') }}">
        Découvrir les residents
        <span class="arrow"></span>
    </a>
</section>