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
        Schema::create('steps_plans', function (Blueprint $table) {
            $table->id('step_plan_id'); // Primary Key custom
            $table->date('plan_start_date');
            $table->date('plan_end_date');
            $table->string('plan_name');
            $table->string('plan_type');
            //$table->integer('plan_triwulan');
            $table->text('plan_desc');
            $table->string('plan_doc')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            
            // Foreign Key ke publications table
            $table->foreignId('publication_id')
                  ->constrained('publications', 'publication_id')
                  ->onDelete('no action')
                  ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps_plans');
    }
};
