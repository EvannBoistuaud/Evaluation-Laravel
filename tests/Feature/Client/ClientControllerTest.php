<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Bouncer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{

    use DatabaseTransactions;

    public function test_client_page_is_accessible(): void
    {
        // Création d'un utilisateur avec les rôles nécessaires
        $user = User::factory()->create();
        Bouncer::assign('user')->to($user);
        Bouncer::allow('user')->to('client-index');

        // Acceder à la page Client en temps que $user
        $response = $this
            ->actingAs($user)
            ->get('/client');

        // Assurer que tout ce passe bien
        $response->assertOk();
    }



    public function test_client_edit_page_is_accessible(): void
    {
        // Création d'un utilisateur avec les rôles nécessaires et d'un client
        $user = User::factory()->create();
        $client = Client::factory()->create();
        Bouncer::assign('user')->to($user);
        Bouncer::allow('user')->to('client-index');

        // Redirection vers la page d'édition en temps que $user
        $response = $this
            ->actingAs($user)
            ->get('/client/'.$client->id.'/edit');

        // Assurer que tout ce passe bien
        $response->assertOk();
    }

    public function test_client_information_can_be_updated(): void
    {
        // Création d'un utilisateur avec les rôles nécessaires et d'un client
        $user = User::factory()->create();
        Bouncer::assign('user')->to($user);
        Bouncer::allow('user')->to('client-index');
        $client = Client::factory()->create();

        // Modification du client avec des valeurs précises
        $response = $this
            ->actingAs($user)
            ->patch('/client/'.$client->id, [
                'id_user' => $user->id,
                'nom' => 'Maria',
                'prenom' => 'Eve',
                'email' => 'eve.maria@gmail.com',
            ]);
        // Assurer qu'aucune erreur ne survient et redirection
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/client');

        $client->refresh();

        // Assurer que les valeurs sont bien les même valeurs que celles modifié
        $this->assertSame($user->id, $client->id_user);
        $this->assertSame('Maria', $client->nom);
        $this->assertSame('Eve', $client->prenom);
        $this->assertSame('eve.maria@gmail.com', $client->email);

    }

    public function test_new_client_can_be_create(): void
    {

        // Création d'un utilisateur avec les rôles nécessaires
        $user = User::factory()->create();
        Bouncer::assign('user')->to($user);
        Bouncer::allow('user')->to('client-index');

        // Création d'un client en temps que $user avec les bonnes valeurs
        $response = $this
        ->actingAs($user)
        ->post('/client', [
            'id_user' => $user->id,
            'nom' => 'Maria',
            'prenom' => 'Eve',
            'email' => 'eve.maria@gmail.com',
        ]);

        // Assurer qu'aucune erreur ne se passe et redirection vers client
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/client');
    }

    public function test_client_can_be_destroyed(): void
{
    // Création d'un utilisateur avec les rôles nécessaires
    $user = User::factory()->create();
    Bouncer::assign('user')->to($user);
    Bouncer::allow('user')->to('client-index');

    // Création d'un client
    $client = Client::factory()->create();

    // Vérification que le client existe avant la destruction
    $this->assertDatabaseHas('clients', ['id' => $client->id]);

    // Requête DELETE pour détruire le client
    $response = $this
        ->actingAs($user)
        ->delete("/client/{$client->id}");

    // Assurer une redirection après la destruction
    $response->assertRedirect('/client');

    // Vérification que le client n'existe plus après la destruction
    $this->assertDatabaseMissing('clients', ['id' => $client->id]);
}
}
