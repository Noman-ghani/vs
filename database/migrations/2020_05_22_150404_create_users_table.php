<?php

use App\Models\Rbac\RolesCapabilities;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('role_id');
                $table->string('firstname');
                $table->string('lastname');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('api_token', 80)->unique();
                $table->rememberToken();
                $table->integer('is_active')->default(1);
                $table->integer('is_deleted')->default(0);
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
            });

            // Super Administrator
            DB::table('users')->insert([
            'role_id' => RolesCapabilities::where('short_code', 'super_administrator')->first()->id,
            'firstname' => 'Super',
            'lastname' => 'Administrator',
            'email' => 'superadmin@ntb.com',
            'password' => Hash::make('Adobe110#'),
            'api_token' => Str::random(60),
            'created_at' => Carbon::now()
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
        Schema::dropIfExists('users');
    }
}