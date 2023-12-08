<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Bouncer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_client_page_is_accessible(): void
    {
        $user = User::factory()->create();
        Bouncer::assign('user')->to($user);
        Bouncer::allow('user')->to('client-index');

        $response = $this
            ->actingAs($user)
            ->get('/client');

        $response->assertOk();
    }



    public function test_client_edit_page_is_accessible(): void
    {
        $user = User::factory()->create();

        $client = Client::factory()->create();
        Bouncer::assign('user')->to($user);
        Bouncer::allow('user')->to('client-index');

        $response = $this
            ->actingAs($user)
            ->get('/client/'.$client->id.'/edit');

        $response->assertOk();
    }

    public function test_client_information_can_be_updated(): void
    {
        $user = User::factory()->create();
        Bouncer::assign('user')->to($user);
        Bouncer::allow('user')->to('client-index');

        $client = Client::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/client/'.$client->id, [
                'nom' => 'Maria',
                'prenom' => 'Eve',
                'email' => 'eve.maria@gmail.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/client');

        $client->refresh();

        $this->assertSame('Maria', $client->nom);
        $this->assertSame('Eve', $client->prenom);
        $this->assertSame('eve.maria@gmail.com', $client->email);

    }

    public function test_new_client_can_be_create(): void
    {


        $user = User::factory()->create();
        Bouncer::assign('user')->to($user);
        Bouncer::allow('user')->to('client-index');

        $response = $this
        ->actingAs($user)
        ->post('/client', [
            'id_user' => $user->id,
            'nom' => 'Maria',
            'prenom' => 'Eve',
            'email' => 'eve.maria@gmail.com',
        ]);

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

    // Création d'une réservation
    $client = Client::factory()->create();

    // Vérification que la réservation existe avant la destruction
    $this->assertDatabaseHas('clients', ['id' => $client->id]);

    // Requête DELETE pour détruire la réservation
    $response = $this
        ->actingAs($user)
        ->delete("/client/{$client->id}");

    // Assurer une redirection après la destruction
    $response->assertRedirect('/client');

    // Vérification que la réservation n'existe plus après la destruction
    $this->assertDatabaseMissing('clients', ['id' => $client->id]);
}
}
