
<p>
    Bonjour {{$reserv->client->nom}} {{$reserv->client->prenom}},

    <br>Votre réservation n°{{$reserv->numero}} à bien été modifiée

    <br>Voici les nouvelles valeurs:

    <br>- Date: {{$reserv->date_reservation}}
    <br>- Heure: {{$reserv->heure_reservation}}
    <br>- Prix: {{$reserv->prix}}
    <br>- Nombre de Place : {{$reserv->nombre_place}}
    <br>- Salle : {{$reser->salle->nom_salle}}
</p>
