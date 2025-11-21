<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public $connection = 'db_controller';

    public function up(): void
    {
        Schema::create('sys_tenants', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->timestamps();
            $table->json('data')->nullable();
            //your custom columns may go here
            $table->string('description')->nullable();
            $table->string('database')->nullable();
            $table->string('schema')->nullable();
            $table->string('url_app')->nullable();
            $table->string('url_api')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys_tenants');
    }
};
