<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Reserv;
use App\Models\Salle;
use App\Models\User;
use Bouncer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ReservationControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_reservation_page_is_accessible(): void
    {
        // Création d'un utilisateur avec les rôles nécessaires
        $user = User::factory()->create();
        Bouncer::assign('user')->to($user);
        Bouncer::allow('user')->to('reserv-index');

        // Accéder à la page des réservations
        $response = $this
            ->actingAs($user)
            ->get('/reserv');

        // Assurer que tout ce passe bien
        $response->assertOk();
    }

    public function test_reservation_create_page_is_accessible(): void
    {
        // Création d'un utilisateur avec les rôles nécessaires
        $user = User::factory()->create();
        Bouncer::assign('user')->to($user);
        Bouncer::allow('user')->to('reserv-index');

        // Accéder à la page de création des réservations
        $response = $this
            ->actingAs($user)
            ->get('/reserv/create');

        // Assurer que tout ce passe bien
        $response->assertOk();
    }

    public function test_reservation_edit_page_is_accessible(): void
    {
        // Création d'un utilisateur avec les rôles nécessaires et d'une réservation
        $user = User::factory()->create();
        $reserv = Reserv::factory()->create();
        Bouncer::assign('user')->to($user);
        Bouncer::allow('user')->to('reserv-index');

        // Accéder à la page d'édition de la réservation
        $response = $this
            ->actingAs($user)
            ->get('/reserv/'.$reserv->id.'/edit');

        // Assurer que tout ce passe bien
        $response->assertOk();
    }

    public function test_reservation_information_can_be_updated(): void
    {
        // Création d'un utilisateur avec les rôles nécessaires, d'un client, d'une salle et d'une réservation
        $user = User::factory()->create();
        Bouncer::assign('user')->to($user);
        Bouncer::allow('user')->to('reserv-index');

        $client = Client::factory()->create();
        $reserv = Reserv::factory()->create();
        $salle = Salle::factory()->create();

        // Modifier la réservation en temps que $user avec des valeurs précise
        $response = $this
            ->actingAs($user)
            ->patch('/reserv/'.$reserv->id, [
                'numero' => 123,
                'date_reservation' => '2023-10-21',
                'heure_reservation' => '10:00',
                'prix' => 20,
                'nombre_place' => 5,
                'salle_id' => $salle->id,
                'client_id' => $client->id,
            ]);
        // Assurer qu'il n'y ai aucune erreur
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/reserv');

        $reserv->refresh();

        // Assurer que les valeurs sont bien celles modifiées
        $this->assertSame(123, $reserv->numero);
        $this->assertSame('2023-10-21', $reserv->date_reservation);
        $this->assertSame('10:00', substr($reserv->heure_reservation, 0, 5));
        $this->assertSame(20, (int)$reserv->prix);
        $this->assertSame(5, $reserv->nombre_place);
        $this->assertSame($salle->id, $reserv->salle_id);
        $this->assertSame($client->id, $reserv->client_id);
    }

    public function test_new_reservation_can_be_create(): void
    {
        // Création d'un utilisateur avec les rôles nécessaires, d'un client et d'une salle
        $client = Client::factory()->create();
        $salle = Salle::factory()->create();
        $user = User::factory()->create();
        Bouncer::assign('user')->to($user);
        Bouncer::allow('user')->to('reserv-index');

        // Créer une nouvelle réservation en temps que $user avec des valeurs précise
        $response = $this
        ->actingAs($user)
        ->post('/reserv', [
                'numero' => 123,
                'date_reservation' => '2023-10-21',
                'heure_reservation' => '10:00',
                'prix' => 20,
                'nombre_place' => 5,
                'salle_id' => $salle->id,
                'client_id' => $client->id,
        ]);
        // Assurer qu'une erreur ne se passe
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/reserv');
    }

    public function test_reservation_can_be_destroyed(): void
{
    // Création d'un utilisateur avec les rôles nécessaires
    $user = User::factory()->create();
    Bouncer::assign('user')->to($user);
    Bouncer::allow('user')->to('reserv-index');

    // Création d'une réservation
    $reserv = Reserv::factory()->create();

    // Vérification que la réservation existe avant la destruction
    $this->assertDatabaseHas('reservs', ['id' => $reserv->id]);

    // Requête DELETE pour détruire la réservation
    $response = $this
        ->actingAs($user)
        ->delete("/reserv/{$reserv->id}");

    // Assurer une redirection après la destruction
    $response->assertRedirect('/reserv');

    // Vérification que la réservation n'existe plus après la destruction
    $this->assertDatabaseMissing('reservs', ['id' => $reserv->id]);
}
}
