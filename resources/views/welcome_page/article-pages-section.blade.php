<aside class="section-content">
    <h2>Article </h2>
    <p>Explorez notre galerie d’images, nos articles et réflexions autour des résidences et du monde artistique contemporain. </p>
    <div class="articles-list">
        @forelse($articles as $article)
            <a href="{{ route('page.show', ['slug' => $article->slug]) }}" title="découvrir {{ $article->title }}" class="article-card">
                <div class="card-content">
                    <div class="contain">
                        <img src="{{ asset($article->profile_pic) }}" alt="{{ $article->title }}" class="card-image">
                    </div>
                    <p class="card-title">{{ $article->title }}</p>
                    <p>{{ $article->meta_description }}</p>
                    <p>Le {{ $article->created_at->format('d F Y') }}</p>

                </div>
            </a>
        @empty
            <p class="no-msg">Aucun article disponible pour le moment.</p>
        @endforelse
    </div>
    <a class="seguro-btn my-5" href="{{ route('page.index') }}">
        Découvrir les articles
        <span class="arrow"></span>
    </a>

</aside>