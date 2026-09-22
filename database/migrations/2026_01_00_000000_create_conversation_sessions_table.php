<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection(config('telgeram.db.connection'))
            ->create(config('telgeram.db.table', 'conversation_sessions'), function (Blueprint $table) {
                $table->string('chat_id')->primary();
                $table->string('conversation');
                $table->json('state');
                $table->timestamps();
            });
    }

    public function down(): void
    {
        Schema::connection(config('telgeram.db.connection'))
            ->dropIfExists(config('telgeram.db.table', 'conversation_sessions'));
    }
};