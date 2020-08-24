<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateMcqsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcqs_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('mcq_id');
            $table->char('option',10);
            $table->string('answer',200);
            $table->integer('is_correct')->default(0);
            $table->timestamps();
        });
        DB::table('mcqs_answers')->insert([
            ['mcq_id' => 1, 'option' => 'A', 'answer' => '1000', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 1, 'option' => 'B', 'answer' => '525', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 1, 'option' => 'C', 'answer' => '265', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 1, 'option' => 'D', 'answer' => '140', 'is_correct' => 0, 'created_at' => Carbon::now()],
             
            ['mcq_id' => 2, 'option' => 'A', 'answer' => 'Influenza virus', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 2, 'option' => 'B', 'answer' => 'Gram positive cocci', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 2, 'option' => 'C', 'answer' => 'Mycobacterium Tuberculosis', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 2, 'option' => 'D', 'answer' => 'E-coli', 'is_correct' => 0, 'created_at' => Carbon::now()],
             
            ['mcq_id' => 3, 'option' => 'A', 'answer' => 'cough', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 3, 'option' => 'B', 'answer' => 'weight loss', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 3, 'option' => 'C', 'answer' => 'fever', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 3, 'option' => 'D', 'answer' => 'all of above', 'is_correct' => 1, 'created_at' => Carbon::now()],
             
            ['mcq_id' => 4, 'option' => 'A', 'answer' => 'cough of 10 days’ duration with rhinitis &amp; body aches', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 4, 'option' => 'B', 'answer' => 'abdominal pain, nausea and vomiting for 7 days', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 4, 'option' => 'C', 'answer' => 'cough for more than two weeks', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 4, 'option' => 'D', 'answer' => 'fever and cough for the 3 days', 'is_correct' => 0, 'created_at' => Carbon::now()],
             
            ['mcq_id' => 5, 'option' => 'A', 'answer' => 'Sputum smear microscopy', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 5, 'option' => 'B', 'answer' => 'Xpert', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 5, 'option' => 'C', 'answer' => 'Blood CP', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 5, 'option' => 'D', 'answer' => 'Culture', 'is_correct' => 0, 'created_at' => Carbon::now()],
             
            ['mcq_id' => 6, 'option' => 'A', 'answer' => 'One specimen', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 6, 'option' => 'B', 'answer' => 'Two specimen', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 6, 'option' => 'C', 'answer' => 'Three specimen', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 6, 'option' => 'D', 'answer' => 'Four specimen', 'is_correct' => 0, 'created_at' => Carbon::now()],
             
            ['mcq_id' => 7, 'option' => 'A', 'answer' => 'Pulmonary &amp; Extra pulmonary', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 7, 'option' => 'B', 'answer' => 'Smear positive &amp; smear Negative', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 7, 'option' => 'C', 'answer' => 'New TB case &amp; previously treated TB case', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 7, 'option' => 'D', 'answer' => 'All of above', 'is_correct' => 0, 'created_at' => Carbon::now()],
             
            ['mcq_id' => 8, 'option' => 'A', 'answer' => 'Positive on smear microscopy and/or Positive on Xpert MTB/RI', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 8, 'option' => 'B', 'answer' => 'Granulomatous inflammation on histopathology', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 8, 'option' => 'C', 'answer' => 'X-Ray chest highly suggestive of TB', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 8, 'option' => 'D', 'answer' => 'Raised ESR', 'is_correct' => 0, 'created_at' => Carbon::now()],
             
            ['mcq_id' => 9, 'option' => 'A', 'answer' => 'New Sputum Positive case', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 9, 'option' => 'B', 'answer' => 'Failure of previous treatment with ATT', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 9, 'option' => 'C', 'answer' => 'Contact of MDR TB Patient', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 9, 'option' => 'D', 'answer' => 'All of the above', 'is_correct' => 1, 'created_at' => Carbon::now()],
            
            ['mcq_id' => 10, 'option' => 'A', 'answer' => 'Rapid screening results', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 10, 'option' => 'B', 'answer' => 'Help in Clinical diagnosis of TB', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 10, 'option' => 'C', 'answer' => 'Scoring in PPA chart for children.', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 10, 'option' => 'D', 'answer' => 'All of the above', 'is_correct' => 1, 'created_at' => Carbon::now()],
            
            ['mcq_id' => 11, 'option' => 'A', 'answer' => 'Milliary mottling', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 11, 'option' => 'B', 'answer' => 'Cavitation.', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 11, 'option' => 'C', 'answer' => 'Parenchymal infiltrates', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 11, 'option' => 'D', 'answer' => 'All of the above', 'is_correct' => 1, 'created_at' => Carbon::now()],
            
            ['mcq_id' => 12, 'option' => 'A', 'answer' => 'Eight months', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 12, 'option' => 'B', 'answer' => 'Nine months.', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 12, 'option' => 'C', 'answer' => 'Six  Months infiltrates', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 12, 'option' => 'D', 'answer' => 'Eighteen Months', 'is_correct' => 0, 'created_at' => Carbon::now()],

            ['mcq_id' => 13, 'option' => 'A', 'answer' => '2 months  HRZE and 4 months HR', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 13, 'option' => 'B', 'answer' => '1 month  HRZE and 5 months HR', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 13, 'option' => 'C', 'answer' => '2 months  HRZE and 4 months HE', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 13, 'option' => 'D', 'answer' => '1 month HRZE and 5 months HE', 'is_correct' => 0, 'created_at' => Carbon::now()],
            
            ['mcq_id' => 14, 'option' => 'A', 'answer' => 'History of previous anti TB treatment', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 14, 'option' => 'B', 'answer' => 'Weight of patient', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 14, 'option' => 'C', 'answer' => 'Tuberculin skin testing and ESR report', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 14, 'option' => 'D', 'answer' => 'a &amp; b', 'is_correct' => 1, 'created_at' => Carbon::now()],

            ['mcq_id' => 15, 'option' => 'A', 'answer' => '30-39 kg , 40-54kg  and 55 kg &amp; above', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 15, 'option' => 'B', 'answer' => '20-35 kg, 35-50 kg, 50kg  and 50kg &amp; above', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 15, 'option' => 'C', 'answer' => '20-40kg, 40-60kg  and 60kg  &amp; above', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 15, 'option' => 'D', 'answer' => '15-35kg , 35-55kg  and 55kg &amp; above', 'is_correct' => 0, 'created_at' => Carbon::now()],
            
            ['mcq_id' => 16, 'option' => 'A', 'answer' => 'Results of sputum examination', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 16, 'option' => 'B', 'answer' => 'X-ray chest PA view', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 16, 'option' => 'C', 'answer' => 'Weight of the patient', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 16, 'option' => 'D', 'answer' => 'Reporting tools', 'is_correct' => 0, 'created_at' => Carbon::now()],
            
            ['mcq_id' => 17, 'option' => 'A', 'answer' => 'Directly observed treatment (short course)', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 17, 'option' => 'B', 'answer' => 'Date of Treatment started', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 17, 'option' => 'C', 'answer' => 'Duration of Treatment(s)', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 17, 'option' => 'D', 'answer' => 'Duration of TB', 'is_correct' => 0, 'created_at' => Carbon::now()],
            
            ['mcq_id' => 18, 'option' => 'A', 'answer' => 'Ethambutol', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 18, 'option' => 'B', 'answer' => 'pyrazinamide', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 18, 'option' => 'C', 'answer' => 'Isoniazid', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 18, 'option' => 'D', 'answer' => 'Rifampicin', 'is_correct' => 1, 'created_at' => Carbon::now()],
            
            ['mcq_id' => 19, 'option' => 'A', 'answer' => 'Stop Pyrazinamide', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 19, 'option' => 'B', 'answer' => 'Reducing dose of pyrazinamide', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 19, 'option' => 'C', 'answer' => 'Continue ATT and give NSAID', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 19, 'option' => 'D', 'answer' => 'No action and reassurance', 'is_correct' => 0, 'created_at' => Carbon::now()],
            
            ['mcq_id' => 20, 'option' => 'A', 'answer' => 'Ethambutol', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 20, 'option' => 'B', 'answer' => 'Levofloxacin', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 20, 'option' => 'C', 'answer' => 'Isoniazid', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 20, 'option' => 'D', 'answer' => 'Rifampicin', 'is_correct' => 0, 'created_at' => Carbon::now()],
            
            ['mcq_id' => 21, 'option' => 'A', 'answer' => '1, 3 &amp; 5 months', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 21, 'option' => 'B', 'answer' => '2, 5 &amp; 6 months', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 21, 'option' => 'C', 'answer' => '1, 6 &amp; 8 months', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 21, 'option' => 'D', 'answer' => '2, 4 &amp; 6 months', 'is_correct' => 0, 'created_at' => Carbon::now()],

            ['mcq_id' => 22, 'option' => 'A', 'answer' => 'Successful treatment is important.', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 22, 'option' => 'B', 'answer' => 'All first line TB drugs are safe in pregnancy', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 22, 'option' => 'C', 'answer' => 'Treatment of TB  should be continued', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 22, 'option' => 'D', 'answer' => 'All of above', 'is_correct' => 1, 'created_at' => Carbon::now()],

            ['mcq_id' => 23, 'option' => 'A', 'answer' => 'PPA scoring chart', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 23, 'option' => 'B', 'answer' => 'X-ray findings suggestive of TB', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 23, 'option' => 'C', 'answer' => 'Fever and raised ESR', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 23, 'option' => 'D', 'answer' => 'History of contact with TB patient.', 'is_correct' => 0, 'created_at' => Carbon::now()],
            
            ['mcq_id' => 24, 'option' => 'A', 'answer' => '2 months HRZ and 4 months HR', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 24, 'option' => 'B', 'answer' => '2 months HR and 6 months HE', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 24, 'option' => 'C', 'answer' => '6 months HRZE', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 24, 'option' => 'D', 'answer' => '4 months HRZE and 2 month HE', 'is_correct' => 0, 'created_at' => Carbon::now()],

            ['mcq_id' => 25, 'option' => 'A', 'answer' => 'Persistent immune response by Mycobacterium TB antigens', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 25, 'option' => 'B', 'answer' => 'Having No evidence of active TB.', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 25, 'option' => 'C', 'answer' => 'Having  risk of developing active TB', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 25, 'option' => 'D', 'answer' => 'All above', 'is_correct' => 1, 'created_at' => Carbon::now()],

            ['mcq_id' => 26, 'option' => 'A', 'answer' => 'After exclusion of active TB disease', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 26, 'option' => 'B', 'answer' => 'On confirmation of active TB disease', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 26, 'option' => 'C', 'answer' => 'In both cases above', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 26, 'option' => 'D', 'answer' => 'None of above is true', 'is_correct' => 0, 'created_at' => Carbon::now()],

            ['mcq_id' => 27, 'option' => 'A', 'answer' => 'Rifampicin', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 27, 'option' => 'B', 'answer' => 'Rifampicin and pyrazinamide', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 27, 'option' => 'C', 'answer' => 'Rifampicin and Isoniazid', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 27, 'option' => 'D', 'answer' => 'Rifampicin and Levofloxacin', 'is_correct' => 0, 'created_at' => Carbon::now()],

            ['mcq_id' => 28, 'option' => 'A', 'answer' => '6-8 months', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 28, 'option' => 'B', 'answer' => '9-11 months', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 28, 'option' => 'C', 'answer' => '12-15 months', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 28, 'option' => 'D', 'answer' => '18-20 months', 'is_correct' => 1, 'created_at' => Carbon::now()],

            ['mcq_id' => 29, 'option' => 'A', 'answer' => 'It is compulsory for all doctors and laboratories to inform the district health authorities if any patient is diagnosed or treated for TB with 24 hours.', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 29, 'option' => 'B', 'answer' => 'TB patient can be notified online through SMS at  9122 code', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 29, 'option' => 'C', 'answer' => 'Government can take legal action if TB case is NOT notified to DHO', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 29, 'option' => 'D', 'answer' => 'All of the above', 'is_correct' => 1, 'created_at' => Carbon::now()],

            ['mcq_id' => 30, 'option' => 'A', 'answer' => 'TB can’t be treated at Private clinic hospital', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 30, 'option' => 'B', 'answer' => 'TB Can be treated at Private Clinic/Hospital by Medical doctor but it is Notifiable disease', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 30, 'option' => 'C', 'answer' => 'TB is Non Notifiable disease', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 30, 'option' => 'D', 'answer' => 'All of above', 'is_correct' => 0, 'created_at' => Carbon::now()],

            ['mcq_id' => 31, 'option' => 'A', 'answer' => '01-05 contacts persons in a year.', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 31, 'option' => 'B', 'answer' => '05-10 contacts persons in a year.', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 31, 'option' => 'C', 'answer' => '10-15 contacts persons in a year.', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 31, 'option' => 'D', 'answer' => '10-15 contacts persons in a year.', 'is_correct' => 0, 'created_at' => Carbon::now()],

            ['mcq_id' => 32, 'option' => 'A', 'answer' => '700,000', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 32, 'option' => 'B', 'answer' => '562,000', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 32, 'option' => 'C', 'answer' => '265,000', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 32, 'option' => 'D', 'answer' => '140,000', 'is_correct' => 0, 'created_at' => Carbon::now()],

            ['mcq_id' => 33, 'option' => 'A', 'answer' => 'Government Health facilities', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 33, 'option' => 'B', 'answer' => 'Private hospitals', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 33, 'option' => 'C', 'answer' => 'Private clinics', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 33, 'option' => 'D', 'answer' => 'All of above', 'is_correct' => 1, 'created_at' => Carbon::now()],

            ['mcq_id' => 34, 'option' => 'A', 'answer' => 'cough, fever and weight loss', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 34, 'option' => 'B', 'answer' => 'Headache, anxiety, restlessness', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 34, 'option' => 'C', 'answer' => 'Chest pain, palpitation and shortness of breath', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 34, 'option' => 'D', 'answer' => 'All of above', 'is_correct' => 0, 'created_at' => Carbon::now()],

            ['mcq_id' => 35, 'option' => 'A', 'answer' => 'Fever, Fatigue, weight loss and Chest pain', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 35, 'option' => 'B', 'answer' => 'Fever,  weight loss and matted swellings in neck', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 35, 'option' => 'C', 'answer' => 'A & B', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 35, 'option' => 'D', 'answer' => 'None of above', 'is_correct' => 0, 'created_at' => Carbon::now()],

            ['mcq_id' => 36, 'option' => 'A', 'answer' => 'Hand shake, sharing food or drink, touching bed linens.', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 36, 'option' => 'B', 'answer' => 'Air from one person to another by coughing, sneezing and shouting.', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 36, 'option' => 'C', 'answer' => 'Through the breast milk to nursing baby', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 36, 'option' => 'D', 'answer' => 'All of above', 'is_correct' => 0, 'created_at' => Carbon::now()],

            ['mcq_id' => 37, 'option' => 'A', 'answer' => 'Mainly on the quantity of infectious droplet nuclei in the air.', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 37, 'option' => 'B', 'answer' => 'The length of exposure with an infectious person.', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 37, 'option' => 'C', 'answer' => 'The immunity of infected person.', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 37, 'option' => 'D', 'answer' => 'All of above', 'is_correct' => 1, 'created_at' => Carbon::now()],

            ['mcq_id' => 38, 'option' => 'A', 'answer' => 'The symptoms and signs of TB depending on part of the body are affected.', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 38, 'option' => 'B', 'answer' => 'Symptoms of TB disease usually develop slowly after the initial infection', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 38, 'option' => 'C', 'answer' => 'All tubes and cavities can have TB', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 38, 'option' => 'D', 'answer' => 'All of above', 'is_correct' => 1, 'created_at' => Carbon::now()],

            ['mcq_id' => 39, 'option' => 'A', 'answer' => 'Pulmonary &amp; Extra pulmonary', 'is_correct' => 1, 'created_at' => Carbon::now()],
            ['mcq_id' => 39, 'option' => 'B', 'answer' => 'Smear positive &amp; smear Negative', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 39, 'option' => 'C', 'answer' => 'New TB case &amp; previously treated TB case', 'is_correct' => 0, 'created_at' => Carbon::now()],
            ['mcq_id' => 39, 'option' => 'D', 'answer' => 'All of above', 'is_correct' => 0, 'created_at' => Carbon::now()],
        
            
            
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mcqs_answers');
    }
}
