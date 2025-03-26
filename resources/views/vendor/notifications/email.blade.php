@component('mail::message')
# Bonjour {{ $user->name ?? '' }} 👋

Merci de vous être inscrit sur **Villa Seguro** !

Cliquez sur le bouton ci-dessous pour **vérifier votre adresse email** et finaliser votre inscription.

@component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
Vérifier mon adresse
@endcomponent

---

Si vous n'avez pas créé de compte, aucune action n'est requise.

Merci pour votre confiance 🙏  
**— L'équipe Villa Seguro**

@endcomponent