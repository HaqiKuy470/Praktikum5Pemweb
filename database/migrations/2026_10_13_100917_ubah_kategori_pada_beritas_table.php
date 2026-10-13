<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            // Kolom bawaan Praktikum 4 yang tidak dipakai lagi (tag kini lewat tabel pivot)
            $table->dropUnique(['slug']);
            $table->dropColumn(['kategori', 'slug', 'tanggal', 'ringkasan', 'tag']);
        });

        Schema::table('beritas', function (Blueprint $table) {
            $table->string('gambar')->nullable()->change();
            $table->foreignId('kategori_id')->after('judul')
                  ->constrained('kategoris');
        });
    }

    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kategori_id');
        });

        Schema::table('beritas', function (Blueprint $table) {
            $table->string('kategori')->after('judul')->default('');
            $table->string('slug')->nullable()->unique();
            $table->date('tanggal')->nullable();
            $table->text('ringkasan')->nullable();
            $table->string('tag')->default('');
        });
    }
};
