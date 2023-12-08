
<p>
    Bonjour {{$reserv->client->nom}} {{$reserv->client->prenom}},

    Votre réservation du {{$reserv->date_reservation}} à {{$reserv->heure_reservation}} à bien été prise en compte.

    Elle se passera à la {{$reserv->salle->nom_salle}}

    information:

    - Prix : {{$reserv->prix}}
    - Nombre de place : {{$reserv->nombre_place}}
</p>
