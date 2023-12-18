<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id()->unique();
            $table->integer("author_id");
            $table->integer("category_id");
            $table->text('text');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
