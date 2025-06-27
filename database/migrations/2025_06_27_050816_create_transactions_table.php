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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('wallet_id');
        $table->unsignedBigInteger('category_id');
        $table->date('date');
        $table->decimal('amount', 12, 2);
        $table->string('note')->nullable();
        $table->timestamps();

        $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
