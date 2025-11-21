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
        Schema::table('sys_menus_packages', function (Blueprint $table) {
            $table->foreign(['sys_menus_id'], 'fk_sys_menus_packages_sys_menus')->references(['id'])->on('sys_menus')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['sys_packages_id'], 'fk_sys_menus_packages_sys_packages')->references(['id'])->on('sys_packages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sys_menus_packages', function (Blueprint $table) {
            $table->dropForeign('fk_sys_menus_packages_sys_menus');
            $table->dropForeign('fk_sys_menus_packages_sys_packages');
        });
    }
};
