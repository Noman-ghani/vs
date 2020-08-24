<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cities')) {
            Schema::create('cities', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('state_id');
                $table->string('title', 100);
                $table->integer('is_active')->default(1);
                $table->timestamps();
            });

            DB::table('cities')->insert([
                ['state_id' => 1, 'title' => 'Karachi', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Hyderābād City', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Sukkur', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Lārkāna', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Mīrpur Khās', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Nawābshāh', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Shahdād Kot', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Matiāri', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Thatta', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Badīn', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Tando Allāhyār', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Sānghar', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Ghotki', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Dādu', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Shikārpur', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Khairpur', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Jāmshoro', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Umarkot', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Jacobābād', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Naushahro Fīroz', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Tando Muhammad Khān', 'created_at' => Carbon::now()],
                ['state_id' => 1, 'title' => 'Kandhkot', 'created_at' => Carbon::now()],

                ['state_id' => 2, 'title' => 'Lahore', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Faisalābād', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Rāwalpindi', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Multān', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Gujrānwāla', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Bahāwalpur', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Sargodha', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Siālkot City', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Sheikhupura', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Rahīmyār Khān', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Jhang Sadr', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Gujrāt', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Kasūr', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Dera Ghāzi Khān', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Masīwāla', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Okāra', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Chiniot', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Sādiqābād', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Kundiān', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Lodhrān', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Muzaffargarh', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Nankāna', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Sāhib', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Hāfizābād', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Jhang City', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Sāhīwāl', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Pākpattan', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Chakwāl', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Khushāb', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Bahāwalnagar', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Khānewāl', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Nārowāl', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Vihāri', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Jhelum', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Mandi Bahāuddīn', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Bhakkar', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Toba Tek Singh', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Miānwāli', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Rājanpur', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Leiah', 'created_at' => Carbon::now()],
                ['state_id' => 2, 'title' => 'Attock City', 'created_at' => Carbon::now()],

                ['state_id' => 3, 'title' => 'Quetta', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Turbat', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Khuzdar', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Hub', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Chaman', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Dera Murad Jamali', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Gwadar', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Dera Allah Yar', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Usta Mohammad', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Sui Town', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Sibi', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Tump', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Nushki', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Zhob', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Kharan', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Chitkan', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Khanozai', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Buleda', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Saranan', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Zehri', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Qalat', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Tasp', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Surab', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Pishin', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Mastung', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Qilla Saifullah', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Pasni', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Nal', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Winder', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Uthal', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Huramzai', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Muslim Bagh', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Dera Bugti', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Qilla Abdullah', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Bela', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Wadh', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Washuk', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Awaran', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Machh', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Jiwani', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Ormara', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Kohlu', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Bhag', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Dalbandin', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Dhadar', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Musakhel', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Harnai', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Dureji', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Sohbatpur', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Gajjar Mashkay', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Barkhan', 'created_at' => Carbon::now()],
                ['state_id' => 3, 'title' => 'Shahrug', 'created_at' => Carbon::now()],
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
        Schema::dropIfExists('cities');
    }
}
