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
            $table->string('plan_name');
            $table->enum('plan_type', ['PERSIAPAN', 'PENGUMPULAN DATA', 'PENGOLAHAN DATA', 'ANALISIS DATA', 'DISEMINASI']);
            //$table->integer('plan_triwulan');
            $table->text('plan_desc');
            $table->text('plan_doc')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            
            // Foreign Key ke publications table
            $table->foreignId('fk_publication_id')
                  ->constrained('publications', 'publication_id')
                  ->onDelete('cascade')
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
