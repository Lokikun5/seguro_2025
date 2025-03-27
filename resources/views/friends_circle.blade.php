@extends('layouts.app')
@section('title', config('meta.cercle.title'))
@section('description', config('meta.cercle.description'))
@section('canonical', Request::url())

@section('content')
    <nav class="breadcrumb-container" aria-label="Fil d’Ariane">
        <ul class="breadcrumb">
            <li><a href="{{ route('welcome') }}">Accueil</a></li>
            <li aria-current="page">Cercle des Amis</li>
        </ul>
    </nav>

    <section class="section-content">
        <h1 class="text-center">CERCLE DES AMIS DE LA VILLA SEGURO</h1>
        <h2 class="text-center mb-4">Un engagement collectif pour soutenir la création</h2>
        <div class="txtplusimg px-4">
            <div class="bloc1">
                <p><strong>CERCLE DES AMIS DE LA VILLA SEGURO</strong> a été créé en 2019 par les Amis de la Villa Seguro. Il compte une dizaine de membres qui soutiennent les projets de résidence et de 2e construction d'une bibliothèque de référence.</p>
                <p>Le Cercle finance grâce aux dons de ses membres des projets de recherche et de documentation. En 2024, le Cercle projette la construction et l'aménagement d'une bibliothèque de référence d'arts africains et salle de lecture.</p>
            </div>
            <div class="bloc2">
                <img src="{{ asset('images/photos/seguro-hero.webp') }}" alt="logo villa Seguro" class="logo">
            </div>
        </div>
    </section>

    <section class="intro-section content2">
        <h3 class="my-4">POURQUOI NOUS AIDER ?</h3>
        <div class="txtplusimg2">
            <div class="bloc1">
                <p>Le mécénat permet de rendre la culture accessible à un plus grand nombre de personnes. Les restitutions publiques des artistes en résidence : musiciens, chanteurs, danseurs, plasticiens sont des occasions de proposer aux publics jeunes et adultes issus de milieux défavorisés des concerts gratuits, des ateliers d'initiation aux chants, au dessin, aux arts plastiques et visuels.</p>
                <p>Grâce à vos dons, la Villa Seguro offre aux artistes un espace privilégié de rencontres, de création, de diffusion et de médiation au service de leurs projets artistiques et culturels. Les résidents sont appelés à nouer des relations de travail avec les milieux professionnels, universitaires, artistiques et culturels du Togo.</p>
            </div>
            <div class="bloc2">
                <img src="{{ asset('images/inspiration/villa-Seguro-WEB-8.webp') }}" alt="villa Seguro image 2">
            </div>
        </div>
    </section>

    <section class="intro-section content2 mt-5">
        <h3 class="my-4">NOS RÉALISATIONS</h3>
        <div class="txtplusimg">
            <div class="bloc1">
                <ul>
                    <li><span class="color-focus">2019 :</span> Résidence du plasticien franco-togolais Yao METSOKO</li>
                    <li><span class="color-focus">2020 :</span> Résidence du peintre et sérigraphe togolais Kanfitine YAFFAH</li>
                    <li><span class="color-focus">2021 :</span> Résidence d'écriture de scénario de dessin animé « Junior les idées en or saison 2 » avec 12 scénaristes africains</li>
                    <li><span class="color-focus">2022 :</span> Résidences artistiques : Le Pouvoir des Mots, accompagnement de chanteurs classiques et lyriques</li>
                </ul>
            </div>
            <div class="bloc2">
                <img src="{{ asset('images/photos/seguro-hero.webp') }}" alt="logo villa Seguro" class="logo">
            </div>
        </div>
    </section>

    <section class="intro-section content2 mt-5">
        <h3 class="my-4">COMMENT NOUS AIDER ?</h3>
        <div class="txtplusimg2">
            <div class="bloc1">
                <p>Chaque donateur du Cercle effectue un don libre mensuel ou annuel. Les donateurs peuvent être des particuliers ou des sociétés représentées par une personne physique. Le don peut prendre la forme d'un versement numéraire (espèces, chèque ou virement bancaire).</p>
                <p>Le don manuel (en nature ou en espèces) ne nécessite pas d'acte notarié. La Villa Seguro offre gracieusement une chambre à l'année à ses membres avec accès au jardin et au patio.</p>
            </div>
            <div class="bloc2">
                <img src="{{ asset('images/inspiration/villa-Seguro-WEB-11.webp') }}" alt="villa Seguro image 3">
            </div>
        </div>
    </section>

    <section class="intro-section content2 my-5">
        <h3 class="my-4">DEVENIR AMIS</h3>
        <div class="price-bloc my-5">
            <div class="price-card">20.000 <br>F CFA</div>
            <div class="price-card2">35.000 <br>F CFA</div>
            <div class="price-card3">50.000 <br>F CFA</div>
            <div class="price-card4">faites<br>un don</div>
        </div>
        <h3 class="text-center mt-5">Les amis de la Villa Seguro</h3>
        <p class="text-center mt-3">Votre donation ponctuelle à votre discrétion</p>
        <div class="flex-center mt-4">
            <a class="seguro-btn" href="{{ route('make_a_donation') }}">
                Faire un don
                <span class="arrow"></span>
            </a>
        </div>
    </section>
@endsection