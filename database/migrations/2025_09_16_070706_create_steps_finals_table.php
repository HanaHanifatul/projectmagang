<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('steps_finals', function (Blueprint $table) {
            $table->id('step_final_id'); // Primary Key custom
            $table->date('actual_started');
            $table->date('final_ended');
            //$table->string('final_name');
            //$table->integer('final_triwulan');
            $table->text('final_desc');
            $table->text('final_doc')->nullable();
            $table->string('next_step')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            
            // Foreign Key ke steps_plans table
            $table->foreignId('fk_step_plan_id')
                  ->constrained('steps_plans', 'step_plan_id')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            // Foreign Key kedua ke strugles
            $table->foreignId('fk_struggle_id')
                  ->constrained('struggles', 'struggle_id')
                  ->onDelete('cascade')
                  ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps_finals');
    }
};
