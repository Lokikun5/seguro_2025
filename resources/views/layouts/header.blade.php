<header class="fixed-header">
 <nav class="navbar navbar-expand-lg pt0">
  <div class="container-fluid p0">
   <a class="navbar-brand pt0" href="{{ route('welcome') }}">
    <div class="header-logo">
     <img src="{{ asset('images/logo/seguro-logo3.webp') }}" alt="logo villa Seguro">
    </div>
   </a>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
   </button>

   <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center flex-wrap">

     <li class="nav-item nav-custom-item">
      <a class="nav-link nav-style nav-custom-link" href="{{ route('presentation') }}">Présentation</a>
     </li>
     <li class="nav-item nav-custom-item">
      <a class="nav-link nav-style nav-custom-link" href="{{ route('residents.index') }}">Les Résidents</a>
     </li>
     <li class="nav-item nav-custom-item">
      <a class="nav-link nav-style nav-custom-link" href="{{ route('events.index') }}">Événements</a>
     </li>
     <li class="nav-item nav-custom-item">
      <a class="nav-link nav-style nav-custom-link" href="{{ route('friends_circle') }}">Le cercle d'amis</a>
     </li>
     <li class="nav-item nav-custom-item">
      <a class="nav-link nav-style nav-custom-link" href="{{ route('welcome') }}#contact">Contact</a>
     </li>

     @auth
        <li class="nav-item user-name me-2 text-end">
            Bonjour, {{ Auth::user()->name }}<br>
            <small class="text-muted">({{ ucfirst(Auth::user()->role) }})</small>
        </li>

        @if(Auth::user()->role === 'admin')
            <li class="nav-item">
                <a class="seguro-btn mx-2 my-1" href="{{ route('admin.dashboard') }}">
                    Admin talbeau de bord
                    <span class="arrow"></span>
                </a>
            </li>
        @elseif(Auth::user()->role === 'user')
            <li class="nav-item">
                <a class="seguro-btn mx-2 my-1" href="{{ route('user.dashboard') }}">
                    Mon espace
                    <span class="arrow"></span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="seguro-btn mx-2 my-1">
                    Déconnexion
                    <span class="arrow"></span>
                </button>
            </form>
        </li>
     @else
        <li class="nav-item">
            <a class="seguro-btn mx-2" href="{{ route('login') }}">
                Connexion
                <span class="arrow"></span>
            </a>
        </li>
     @endauth

    </ul>
   </div>
  </div>
 </nav>
</header>