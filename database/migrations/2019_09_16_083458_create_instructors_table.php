<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_number')->unique();
            $table->string('name');
            $table->string('password');
            $table->enum('gender', ['male', 'female']);
            $table->string('profile')->default('http://res.cloudinary.com/dpcxcsdiw/image/upload/c_fit,h_150,w_150/qtw0flebtkxhcekaclwq.png');
            $table->date('birthdate');
            $table->enum('active', ['yes', 'no'])->default('yes');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructors');
    }
}
