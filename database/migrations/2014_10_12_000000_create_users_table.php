<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('mname')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('img');
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'fname' => 'Ricardo',
            'lname' => 'Dalisay',
            'mname' => 'DL',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'img' => 'default.svg'
        ]);
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
