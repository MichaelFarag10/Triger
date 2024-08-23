<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('customer_name');
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->string('national_id');
            $table->date('date_in')->format('d-m-Y')->nullable();
            $table->date('date_pending')->format('d-m-Y')->nullable();
            $table->date('date_out')->format('d-m-Y')->nullable();
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('code')->nullable();
            $table->string('code2')->nullable();
            $table->string('job')->nullable();
            $table->string('inquiry_type');
            $table->string('city');
            $table->string('status');
            $table->string('journey')->nullable();
            $table->string('journey2')->nullable();
            $table->text('reason')->nullable();

            $table->softDeletes('delete_customer');
            $table->timestamps();

       /*   $table->enum('code', ['7', '8', '27', '110', '40', '53', '105', '107', '112', '114', '100', '30', '80', '70' , 'Proto]);
            $table->enum('journey',[1,2]);
        */

        });

        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
