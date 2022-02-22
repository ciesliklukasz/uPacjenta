<?php

use App\Models\LaboratoryExaminationCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoryExaminationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratory_examinations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('name');
            $table->bigInteger('category_id')->unsigned();
            $table->unique('uuid');
            $table->unique('name');
            $table->timestamps();
        });

        Schema::table('laboratory_examinations', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('laboratory_examination_category')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laboratory_examinations');
    }
}
