<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RolesCapabilities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('roles_capabilities')) {
            Schema::create('roles_capabilities', function (Blueprint $table) {
                $table->id();
                $table->string('title', 100);
                $table->string('short_code', 100);
                $table->enum('type', ['role', 'capability']);
                $table->integer('is_deleted')->default(0);
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
            });

            DB::table('roles_capabilities')->insert([
                [
                    'title' => 'Super Administrator',
                    'short_code' => 'super_administrator',
                    'type' => 'role',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'View',
                    'short_code' => 'view',
                    'type' => 'capability',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'Add',
                    'short_code' => 'add',
                    'type' => 'capability',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'Edit',
                    'short_code' => 'edit',
                    'type' => 'capability',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'Delete',
                    'short_code' => 'delete',
                    'type' => 'capability',
                    'created_at' => Carbon::now()
                ]
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_capabilities');
    }
}
