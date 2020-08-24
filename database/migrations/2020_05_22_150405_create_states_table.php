<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('states')) {
            Schema::create('states', function (Blueprint $table) {
                $table->id();
                $table->string('title', 100);
                $table->timestamps();
            });

            DB::table('states')->insert([
                ['id' => 1, 'title' => 'Sindh', 'created_at' => Carbon::now()],
                ['id' => 2, 'title' => 'Punjab', 'created_at' => Carbon::now()],
                ['id' => 3, 'title' => 'Balochistan', 'created_at' => Carbon::now()]
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
        Schema::dropIfExists('states');
    }
}
