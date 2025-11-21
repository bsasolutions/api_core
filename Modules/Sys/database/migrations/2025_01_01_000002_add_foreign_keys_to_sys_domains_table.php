<?php

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
        Schema::table('sys_domains', function (Blueprint $table) {
            $table->foreign(['tenant_id'], 'fk_sys_sys_domains_tenants')->references(['id'])->on('sys_tenants')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sys_domains', function (Blueprint $table) {
            $table->dropForeign('fk_sys_sys_domains_tenants');
        });
    }
};
