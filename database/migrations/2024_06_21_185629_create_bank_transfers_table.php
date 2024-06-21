<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bank_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('member_id')->comment('会員ID');
            $table->datetime('process_date')->comment('処理日時');
            $table->integer('amount')->comment('利用金額');
            $table->integer('tax')->comment('税送料');
            $table->string('description')->comment('説明文');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_transfers');
    }
};
