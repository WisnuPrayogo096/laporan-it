<?php
// database/migrations/xxxx_xx_xx_rename_user_table_to_petugas_it.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus foreign key terlebih dahulu
        Schema::table('detail_laporan', function (Blueprint $table) {
            $table->dropForeign(['petugas_it']);
        });

        // Rename tabel
        Schema::rename('user', 'petugas_it');

        // Buat ulang foreign key
        Schema::table('detail_laporan', function (Blueprint $table) {
            $table->foreign('petugas_it')
                  ->references('nama_petugas_it')
                  ->on('petugas_it')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        // Hapus foreign key
        Schema::table('detail_laporan', function (Blueprint $table) {
            $table->dropForeign(['petugas_it']);
        });

        // Rename kembali
        Schema::rename('petugas_it', 'user');

        // Buat ulang foreign key
        Schema::table('detail_laporan', function (Blueprint $table) {
            $table->foreign('petugas_it')
                  ->references('nama_petugas_it')
                  ->on('user')
                  ->onDelete('set null');
        });
    }
};