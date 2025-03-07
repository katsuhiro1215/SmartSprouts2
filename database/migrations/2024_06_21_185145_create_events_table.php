<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->comment('イベント名');
            $table->text('description')->nullable()->comment('イベント概要');
            $table->string('event_photo_path')->nullable()->comment('イベント画像');
            $table->string('zipcode', 10)->nullable()->comment('郵便番号');
            $table->string('address1', 20)->nullable()->comment('都道府県名');
            $table->string('address2', 30)->nullable()->comment('市区町村名');
            $table->string('address3', 50)->nullable()->comment('町域名');
            $table->string('address4', 100)->nullable()->comment('それ以降の住所');
            $table->string('phone_number', 20)->nullable()->comment('電話番号');
            $table->string('mobile_number', 20)->nullable()->comment('携帯番号');
            $table->datetime('application_start_date')->nullable()->comment('申込開始日');
            $table->datetime('application_end_date')->nullable()->comment('申込終了日');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
