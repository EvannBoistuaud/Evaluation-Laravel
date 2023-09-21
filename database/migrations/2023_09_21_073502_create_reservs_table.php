<?php

use App\Models\Client;
use App\Models\Salle;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservs', function (Blueprint $table) {
            $table->id();

            $table->integer('numero');
            $table->date('date_reservation');
            $table->time('heure_reservation');
            $table->decimal('prix', 5, 2);
            $table->integer('nombre_place');
            $table->foreignIdFor(Salle::class)->constrained();
            $table->foreignIdFor(Client::class)->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservs');
    }
};
