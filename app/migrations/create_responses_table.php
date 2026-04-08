<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

return new class extends Migration {

    public function up(): void
    {
        Capsule::schema()->create('responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('requests')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->smallInteger('status')->unsigned();
            $table->text('response');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Capsule::schema()->dropIfExists('responses');
    }
};
