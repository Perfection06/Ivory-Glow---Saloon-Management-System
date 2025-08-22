<?php

     use Illuminate\Database\Migrations\Migration;
     use Illuminate\Database\Schema\Blueprint;
     use Illuminate\Support\Facades\Schema;

     return new class extends Migration
     {
         public function up(): void
         {
             Schema::create('services', function (Blueprint $table) {
                 $table->id();
                 $table->string('name', 255);
                 $table->integer('duration');
                 $table->text('description')->nullable();
                 $table->decimal('price', 8, 2);
                 $table->string('image')->nullable()->default('images/barber.jpg');
                 $table->foreignId('staff_id')->constrained()->onDelete('restrict');
                 $table->boolean('active')->default(true);
                 $table->timestamps();
             });
         }

         public function down(): void
         {
             Schema::dropIfExists('services');
         }
     };