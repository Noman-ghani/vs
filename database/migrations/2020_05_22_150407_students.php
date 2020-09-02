<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Students extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('Students')) {
            Schema::create('Students', function (Blueprint $table) {
                $table->id();
                $table->boolean('std_active');
                $table->unsignedInteger('user_id');
                $table->bigInteger('mobile_no');
                $table->bigInteger('alternate_contact_no')->nullable();
                $table->string('cnic', 15);
                $table->string('province', 100);
                $table->string('district', 100);
                $table->string('basic_qualification', 100);
                $table->string('other_qualification', 100)->nullable();
                $table->string('work_experience')->nullable();
                $table->string('workplace_type')->nullable();
                $table->text('address_personal_workplace')->nullable();
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
        Schema::dropIfExists('Students');
    }
}
