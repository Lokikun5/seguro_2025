<h2>Nouvelle demande de résidence</h2>

<p><strong>Nom :</strong> {{ $data['name'] }}</p>
<p><strong>Email :</strong> {{ $data['email'] }}</p>
<p><strong>Date de début :</strong> {{ $data['start_date'] }}</p>
<p><strong>Date de fin :</strong> {{ $data['end_date'] }}</p>
<p><strong>Formules :</strong> {{ implode(', ', $data['formules']) }}</p>
