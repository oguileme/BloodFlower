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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('payment_status', ['pendente', 'pago', 'parcelado'])->default('pendente');
            $table->enum('order_status', ['cancelado', 'entregue', 'enviado', 'pendente', 'processando'])->default('pendente');
            $table->enum('payment_type', ['pix', 'debito', 'credito', 'boleto'])->default('pix');
            $table->integer('outstanding_portion')->nullable();
            $table->integer('installment_paid')->nullable();
            $table->double('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
