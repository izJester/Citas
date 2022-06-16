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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->boolean('success');
            $table->integer('responseCode');
            $table->string('responseMessage');
            $table->string('idLetter');
            $table->integer('idNumber');
            $table->float('amount' , 10 , 2);
            $table->integer('currency');
            $table->string('reference');
            $table->string('title');
            $table->string('description');
            $table->string('token');
            $table->integer('transactionId');
            $table->integer('paymentMethodCode')->nullable();
            $table->string('paymentMethodDescription');
            $table->integer('authorizationCode');
            $table->string('paymentMethodNumber');
            $table->string('paymentDate');
            $table->foreignIdFor(App\Models\Tramite::class)->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
};
