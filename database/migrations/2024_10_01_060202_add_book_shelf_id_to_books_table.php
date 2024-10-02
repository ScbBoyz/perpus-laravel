<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Jika kolom sudah ada, hanya tambahkan foreign key
            if (!Schema::hasColumn('books', 'book_shelf_id')) {
                $table->unsignedBigInteger('book_shelf_id')->nullable();
            }

            $table->foreign('book_shelf_id')->references('id')->on('bookshelfs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['book_shelf_id']);
            $table->dropColumn('book_shelf_id');
        });
    }
};
