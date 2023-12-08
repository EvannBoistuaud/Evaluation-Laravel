<?php

namespace Tests\Feature;


use App\Models\Salle;
use App\Models\User;
use Bouncer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SalleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_salle_page_is_accessible(): void
    {
        $user = User::factory()->create();
        Bouncer::assign('admin')->to($user);
        Bouncer::allow('admin')->to('salle-index');

        $response = $this
            ->actingAs($user)
            ->get('/salle');

        $response->assertOk();
    }

    public function test_salle_create_page_is_accessible(): void
    {
        $user = User::factory()->create();
        Bouncer::assign('admin')->to($user);
        Bouncer::allow('admin')->to('salle-index');

        $response = $this
            ->actingAs($user)
            ->get('/salle/create');

        $response->assertOk();
    }

    public function test_salle_edit_page_is_accessible(): void
    {
        $user = User::factory()->create();

        $salle = Salle::factory()->create();
        Bouncer::assign('admin')->to($user);
        Bouncer::allow('admin')->to('salle-index');

        $response = $this
            ->actingAs($user)
            ->get('/salle/'.$salle->id.'/edit');

        $response->assertOk();
    }

    public function test_salle_information_can_be_updated(): void
    {
        $user = User::factory()->create();
        Bouncer::assign('admin')->to($user);
        Bouncer::allow('admin')->to('salle-index');


        $salle = Salle::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/salle/'.$salle->id, [
                'nom_salle' => 'Salle Caillou',
                'adresse' => '23 rue Jean-Pierre',
                'nombre_place' => 52,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/salle');

        $salle->refresh();

        $this->assertSame('Salle Caillou', $salle->nom_salle);
        $this->assertSame('23 rue Jean-Pierre', $salle->adresse);
        $this->assertSame(52, $salle->nombre_place);
    }

    public function test_new_reservation_can_be_create(): void
    {

        $user = User::factory()->create();
        Bouncer::assign('admin')->to($user);
        Bouncer::allow('admin')->to('salle-index');

        $response = $this
        ->actingAs($user)
        ->post('/salle', [
            'nom_salle' => 'Salle Caillou',
            'adresse' => '23 rue Jean-Pierre',
            'nombre_place' => 52,
        ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/salle');
    }

    public function test_salle_can_be_destroyed(): void
{
    // Création d'un utilisateur avec les rôles nécessaires
    $user = User::factory()->create();
    Bouncer::assign('admin')->to($user);
    Bouncer::allow('admin')->to('reserv-index');

    // Création d'une réservation
    $salle = Salle::factory()->create();

    // Vérification que la réservation existe avant la destruction
    $this->assertDatabaseHas('salles', ['id' => $salle->id]);

    // Requête DELETE pour détruire la réservation
    $response = $this
        ->actingAs($user)
        ->delete("/salle/{$salle->id}");

    // Assurer une redirection après la destruction
    $response->assertRedirect('/salle');

    // Vérification que la réservation n'existe plus après la destruction
    $this->assertDatabaseMissing('salles', ['id' => $salle->id]);
}
}
