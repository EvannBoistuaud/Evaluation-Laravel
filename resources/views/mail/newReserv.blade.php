
<p>
    Bonjour {{$reserv->client->nom}} {{$reserv->client->prenom}},

    <br>Votre réservation du {{$reserv->date_reservation}} à {{$reserv->heure_reservation}} à bien été prise en compte.

    <br>Elle se passera à la {{$reserv->salle->nom_salle}}

    <br>Information:

    <br>- Prix : {{$reserv->prix}}
    <br>- Nombre de place : {{$reserv->nombre_place}}
</p>
