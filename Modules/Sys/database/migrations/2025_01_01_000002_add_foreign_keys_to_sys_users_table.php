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
        Schema::table('sys_users', function (Blueprint $table) {
            $table->foreign(['sys_groups_id'], 'fk_sys_users_sys_groups')->references(['id'])->on('sys_groups')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['sys_packages_id'], 'fk_sys_users_sys_packages')->references(['id'])->on('sys_packages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['sys_profiles_id'], 'fk_sys_users_sys_profiles')->references(['id'])->on('sys_profiles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['sys_messages_id'], 'fk_sys_users_sys_messages')->references(['id'])->on('sys_messages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sys_users', function (Blueprint $table) {
            $table->dropForeign('fk_sys_users_sys_groups');
            $table->dropForeign('fk_sys_users_sys_packages');
            $table->dropForeign('fk_sys_users_sys_profiles');
            $table->dropForeign('fk_sys_users_sys_messages');
        });
    }
};
