<div id="form-errors" class="alert alert-danger" style="display: none;"></div>
<div id="contact" class="login-container from-hompage">

    {{-- Message de confirmation d'envoi --}}
        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 2rem;">
                {{ session('success') }}
            </div>
        @endif
        @error('message')
        <span class="error-msg">{{ $message }}</span>
        @enderror

    <form method="POST" action="{{ route('contact.send') }}" class="login-form">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="first_name">Prénom</label>
                <input id="first_name" type="text" name="first_name" required>
            </div>

            <div class="form-group">
                <label for="last_name">Nom</label>
                <input id="last_name" type="text" name="last_name" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input id="phone" type="text" name="phone" required>
            </div>

            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input id="email" type="email" name="email" required>
            </div>
        </div>

        <div class="form-group border-from">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>

        <button type="submit" class="seguro-btn">
            Envoyer
            <span class="arrow"></span>
        </button>
    </form>
</div>