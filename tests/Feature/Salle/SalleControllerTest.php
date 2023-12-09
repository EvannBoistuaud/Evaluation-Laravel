<?php

namespace Tests\Feature;


use App\Models\Salle;
use App\Models\User;
use Bouncer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SalleControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_salle_page_is_accessible(): void
    {
        // Création d'un utilisateur avec les rôles nécessaires
        $user = User::factory()->create();
        Bouncer::assign('admin')->to($user);
        Bouncer::allow('admin')->to('salle-index');

        // Accéder à la page des salles en temps que $user
        $response = $this
            ->actingAs($user)
            ->get('/salle');

        // Assurer que tout va bien
        $response->assertOk();
    }

    public function test_salle_create_page_is_accessible(): void
    {
        // Création d'un utilisateur avec les rôles nécessaires
        $user = User::factory()->create();
        Bouncer::assign('admin')->to($user);
        Bouncer::allow('admin')->to('salle-index');

        // Accéder à la page de création de salle en temps que $user
        $response = $this
            ->actingAs($user)
            ->get('/salle/create');

        // Assurer que tout va bien
        $response->assertOk();
    }

    public function test_salle_edit_page_is_accessible(): void
    {
        // Création d'un utilisateur avec les rôles nécessaires et d'une salle
        $user = User::factory()->create();
        $salle = Salle::factory()->create();
        Bouncer::assign('admin')->to($user);
        Bouncer::allow('admin')->to('salle-index');

        // Accéder à la page d'édition de la salle en temps que $user
        $response = $this
            ->actingAs($user)
            ->get('/salle/'.$salle->id.'/edit');

        // Assurer que tout est bon
        $response->assertOk();
    }

    public function test_salle_information_can_be_updated(): void
    {
        // Création d'un utilisateur avec les rôles nécessaires et d'une salle
        $user = User::factory()->create();
        Bouncer::assign('admin')->to($user);
        Bouncer::allow('admin')->to('salle-index');
        $salle = Salle::factory()->create();

        // Modifier la salle en temps que $user
        $response = $this
            ->actingAs($user)
            ->patch('/salle/'.$salle->id, [
                'nom_salle' => 'Salle Caillou',
                'adresse' => '23 rue Jean-Pierre',
                'nombre_place' => 52,
            ]);

        // Assurer qu'il n'y ai aucune erreur
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/salle');

        $salle->refresh();

        // Assurer que les valeurs sont les même que celles modifiées
        $this->assertSame('Salle Caillou', $salle->nom_salle);
        $this->assertSame('23 rue Jean-Pierre', $salle->adresse);
        $this->assertSame(52, $salle->nombre_place);
    }

    public function test_new_salle_can_be_create(): void
    {
        // Création d'un utilisateur avec les rôles nécessaires
        $user = User::factory()->create();
        Bouncer::assign('admin')->to($user);
        Bouncer::allow('admin')->to('salle-index');

        //Création d'une salle avec des valeurs précises
        $response = $this
        ->actingAs($user)
        ->post('/salle', [
            'nom_salle' => 'Salle Caillou',
            'adresse' => '23 rue Jean-Pierre',
            'nombre_place' => 52,
        ]);

        // Assurer qu'il n'y ai aucune erreur
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

    // Création d'une salle
    $salle = Salle::factory()->create();

    // Vérification que la salle existe avant la destruction
    $this->assertDatabaseHas('salles', ['id' => $salle->id]);

    // Requête DELETE pour détruire la salle
    $response = $this
        ->actingAs($user)
        ->delete("/salle/{$salle->id}");

    // Assurer une redirection après la destruction
    $response->assertRedirect('/salle');

    // Vérification que la salle n'existe plus après la destruction
    $this->assertDatabaseMissing('salles', ['id' => $salle->id]);
}
}
