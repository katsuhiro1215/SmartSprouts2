<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credit_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->comment('オーダーID');
            $table->string('status')->nullable()->comment('取引状態');
            $table->datetime('process_date')->nullable()->comment('処理日時');
            $table->integer('amount')->nullable()->comment('利用金額');
            $table->integer('tax')->nullable()->comment('税送料');
            $table->string('member_id')->nullable()->comment('会員ID');
            $table->string('client_field')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_transactions');
    }
};
