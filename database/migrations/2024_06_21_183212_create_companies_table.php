<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained();
            $table->string('name', 50)->comment('会社名');
            $table->text('description')->nullable()->comment('会社概要');
            $table->string('company_photo_path')->nullable()->comment('会社写真');
            $table->string('company_logo_path')->nullable()->comment('会社ロゴ');
            $table->string('zipcode', 10)->comment('郵便番号');
            $table->string('address1', 20)->comment('都道府県名');
            $table->string('address2', 30)->comment('市区町村名');
            $table->string('address3', 50)->comment('町域名');
            $table->string('address4', 100)->comment('それ以降の住所');
            $table->string('phone_number', 20)->comment('電話番号');
            $table->string('fax_number', 20)->nullable()->comment('FAX番号');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->string('website')->nullable()->comment('URL');
            $table->string('facebook')->nullable()->comment('Facebook URL');
            $table->string('twitter')->nullable()->comment('Twitter URL');
            $table->string('instagram')->nullable()->comment('Instagram URL');
            $table->string('youtube')->nullable()->comment('YouTube URL');
            $table->string('line')->nullable()->comment('LINE URL');
            $table->date('established_date')->nullable()->comment('設立日');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
