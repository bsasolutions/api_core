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
        Schema::table('sys_groups', function (Blueprint $table) {
            $table->foreign(['sys_tenants_id'], 'fk_sys_groups_sys_tenants')->references(['id'])->on('sys_tenants')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sys_groups', function (Blueprint $table) {
            $table->dropForeign('fk_sys_groups_sys_tenants');
        });
    }
};
