@php
    $url = urlencode(Request::fullUrl());
    $title = urlencode($title ?? config('meta.default.title'));
@endphp

<aside class="share-section">
    <h3>Partager sur</h3>
    <div class="share-section-cont">
        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $url }}&title={{ $title }}" target="_blank" rel="noopener">
            <img src="{{ asset('images/logo/linkedin-svgrepo-com.svg') }}" alt="Partager sur LinkedIn">
        </a>

        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank" rel="noopener">
            <img src="{{ asset('images/logo/facebook-svgrepo-com.svg') }}" alt="Partager sur Facebook">
        </a>

        <a href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ $title }}" target="_blank" rel="noopener">
            <img src="{{ asset('images/logo/X_logo_2023.svg') }}" alt="Partager sur Twitter">
        </a>

        <a href="https://api.whatsapp.com/send?text={{ $title }}%20{{ $url }}" target="_blank" rel="noopener">
            <img src="{{ asset('images/logo/insta-svgrepo-com.svg') }}" alt="Partager sur WhatsApp">
        </a>
    </div>
</aside>
