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
        Schema::create('sys_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sys_groups_id');
            $table->bigInteger('sys_packages_id');
            $table->bigInteger('sys_profiles_id');
            $table->bigInteger('sys_messages_id');
            $table->string('description');
            $table->string('short_name', 10)->nullable();
            $table->string('email')->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('remember_token');
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('job_title')->nullable();
            $table->string('image')->nullable();
            $table->dateTime('last_acess')->nullable();
            $table->char('status', 1);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys_users');
    }
};
