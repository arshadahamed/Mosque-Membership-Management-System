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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('Name_of_Family_Head');
            $table->string('NIC_Number');
            $table->string('Address');
            $table->decimal('Membership_fee', 8, 2);
            $table->string('Land_Mobile_Number')->nullable();
            $table->string('WhatsApp_Number')->nullable();
            $table->string('Workplace_Address')->nullable();
            $table->string('Workplace_Mobile_Number')->nullable();
            $table->integer('Number_of_Family_Members_Male');
            $table->integer('Number_of_Family_Members_Female');
            $table->integer('Family_Members_Id')->nullable();
            $table->boolean('Is_Low_Income')->default(false); // Default value
            $table->decimal('Account_Balance', 10, 2)->default(0.00); // Default value
            $table->date('Registered_Date')->nullable(); // Nullable if not always provided
            $table->boolean('Status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
