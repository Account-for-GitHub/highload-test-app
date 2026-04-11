<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

return new class extends Migration {

    public function up(): void
    {
        Capsule::schema()->create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('requests')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->tinyInteger('format');
            $table->text('report');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Capsule::schema()->dropIfExists('reports');
    }
};
