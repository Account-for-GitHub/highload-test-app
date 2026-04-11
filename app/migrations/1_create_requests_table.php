<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

return new class extends Migration {

    public function up(): void
    {
        Capsule::schema()->create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('url', 255)->index('request_url_index');
            $table->integer('quantity')->unsigned();
            $table->json('request_json');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Capsule::schema()->dropIfExists('requests');
    }
};
