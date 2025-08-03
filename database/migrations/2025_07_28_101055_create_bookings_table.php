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
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); 
            $table->string('booking_code')->unique();
            // Kolom-kolom baru sesuai dengan kebutuhan Anda
            $table->string('region')->nullable();
            $table->string('group_name');
            $table->string('group_address')->nullable();
            $table->string('leader_name');
            $table->string('contact_number')->nullable();
            $table->integer('number_of_pilgrims')->default(1);
            $table->string('vehicle_type')->nullable();
            $table->integer('number_of_vehicles')->nullable();
            $table->dateTime('arrival_time'); 
            $table->dateTime('departure_time')->nullable();
            $table->string('status')->default('pending');
            $table->string('pickup_status')->nullable(); 
            $table->text('notes')->nullable();
            $table->foreignId('maktab_id')->nullable()->constrained('maktabs')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};