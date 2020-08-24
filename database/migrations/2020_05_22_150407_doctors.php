<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Doctors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('doctors')) {
            Schema::create('doctors', function (Blueprint $table) {
                $table->id();
                $table->boolean('are_you_doctor');
                $table->unsignedInteger('user_id');
                $table->bigInteger('mobile_no');
                $table->bigInteger('alternate_contact_no')->nullable();
                $table->string('province', 100);
                $table->string('district', 100);
                $table->string('basic_qualification', 100);
                $table->string('other_qualification', 100)->nullable();
                $table->string('workplace_type')->nullable();
                $table->text('address_government_hospital')->nullable();
                $table->text('address_private_hospital')->nullable();
                $table->text('address_personal_hospital')->nullable();
                $table->string('work_experience')->nullable();
                $table->string('cnic', 15);
                $table->string('pmdc_registration_number', 100)->nullable();
                $table->tinyInteger('has_taken_pretest')->default(0);
                $table->timestamp('pretest_started_at')->nullable();
                $table->timestamp('pretest_ended_at')->nullable();
                $table->integer('module_id')->default('1');
                $table->integer('section_id')->default('1');
                $table->integer('is_deleted')->default(0);
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
