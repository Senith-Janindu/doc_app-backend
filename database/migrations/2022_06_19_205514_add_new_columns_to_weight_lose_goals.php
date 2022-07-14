<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weight_lose_goals', function (Blueprint $table) {
//            $table->string('phone_number')->unique()->after('email');->after('look_forward_factors');
            $table->string('how_much_do_you_love_food')->nullable()->after('look_forward_factors');
            $table->string('how_would_you_rate_your_self_control')->nullable()->after('look_forward_factors');
            $table->string('how_many_times_week_do_i_exercise')->nullable()->after('look_forward_factors');
            $table->text('contribute_favtors_frequency')->nullable()->after('look_forward_factors');
            $table->string('what_stopped_you_from_continuing_to_lose_weight')->nullable()->after('look_forward_factors');
            $table->string('what_has_prevented_you_from_trying_again')->nullable()->after('look_forward_factors');
            $table->string('in_the_reasons_for_current_weight')->nullable()->after('look_forward_factors');
            $table->string('how_hard_have_you_really_tried_to_lose_weight')->nullable()->after('look_forward_factors');
            $table->string('roughly_how_many_times_have_you_tried')->nullable()->after('look_forward_factors');

            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weight_lose_goals', function (Blueprint $table) {
            $table->dropColumn('how_much_do_you_love_food');
            $table->dropColumn('how_would_you_rate_your_self_control');
            $table->dropColumn('how_many_times_week_do_i_exercise');
            $table->dropColumn('contribute_favtors_frequency');
            $table->dropColumn('what_stopped_you_from_continuing_to_lose_weight');
            $table->dropColumn('what_has_prevented_you_from_trying_again');
            $table->dropColumn('in_the_reasons_for_current_weight');
            $table->dropColumn('how_hard_have_you_really_tried_to_lose_weight');
            $table->dropColumn('roughly_how_many_times_have_you_tried');
        });
    }
};
