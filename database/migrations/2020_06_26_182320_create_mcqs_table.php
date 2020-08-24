<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateMcqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcqs', function (Blueprint $table) {
            $table->id();
            $table->string('question', 200);
            $table->string('type', 100);
            $table->string('classification', 100)->nullable();
            $table->unsignedInteger('sort')->nullable();
            $table->integer('is_active')->default(1);
            $table->integer('is_deleted')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        DB::table('mcqs')->insert([
            ['question' => 'How many estimated incidence TB case are there in 100,000 populations in Pakistan.', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'The causative organism of TB is', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'common symptoms of pulmonary TB is', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'A person is labeled as TB Presumptive if he/she has following symptoms', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'Which laboratory investigation is recommended by National TB Control Program for TB diagnosis at primary care level', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'Number sputum examinations required for diagnosis of TB in a presumptive TB case', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'TB is classified on the basis of site involved, into', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'A bacteriologically confirmed TB case is when a biological specimen is:', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'Among the following patients, who qualify for the X-pert test ? Tick only one options', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'Chest radiography is an important tool for', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'X-Ray chest suggestive of TB shows following signs:', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'The NTP recommended duration of treatment for a TB patient is', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'NTP recommended regimen to treat new cases of TB', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'Before prescribing ATT to a diagnosed case following information are required', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'How many weight groups of TB patient have been suggested by NTP for treatment of TB patients?', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'What is required to prescribe the treatment for a diagnosed case of TB', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => '“DOTs” stands for', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'The discoloration of urine is due to the use of which of the following ATT Drug:', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'Joint pain is minor side effect of pyrazinamide, it is managed as', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'The peripheral Neuritis is due to the use of which of the following ATT Drug:', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'Follow-up sputum smear microscopy for a smear positive TB will be at the end of', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'A pregnant women with TB should be informed that', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'Diagnosis of TB in children established on the basis of', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'NTP recommends regimen to treat a child with smear negative PTB case', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'Latent TB infection is state of', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'Preventive treatment should be given to all HIV positive patients, risk group and all children below 5 years & contacts for bacteriologically positive index case', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'MDR TB is called when Mycobacterium TB is resistant to', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'The maximum treatment duration for Drug Resistant TB is', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'The following are true for Mandatory TB Notification', 'type' => 'pretest', 'created_at' => Carbon::now()],
            ['question' => 'As per TB Notification Acts approved by Provincial Governments', 'type' => 'pretest', 'created_at' => Carbon::now()],

            ['question' => 'One untreated sputum positive patient can transmits TB to', 'type' => 'post_test_module_1', 'created_at' => Carbon::now()],
            ['question' => 'Number of peoples developed TB in Pakistan in 2018.', 'type' => 'post_test_module_1', 'created_at' => Carbon::now()],
            ['question' => 'National TB control program offers TB care services through', 'type' => 'post_test_module_1', 'created_at' => Carbon::now()],
            ['question' => 'Common symptoms of pulmonary TB', 'type' => 'post_test_module_1', 'created_at' => Carbon::now()],
            ['question' => 'Common symptoms extra-pulmonary TB are', 'type' => 'post_test_module_1', 'created_at' => Carbon::now()],
            ['question' => 'TB bacteria are spread through the :', 'type' => 'post_test_module_1', 'created_at' => Carbon::now()],
            ['question' => 'The chance of becoming infected with TB depends', 'type' => 'post_test_module_1', 'created_at' => Carbon::now()],
            ['question' => 'Following are correct about TB', 'type' => 'post_test_module_1', 'created_at' => Carbon::now()],
            ['question' => 'TB is classified on the basis of site involved, into', 'type' => 'post_test_module_1', 'created_at' => Carbon::now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mcqs');
    }
}
