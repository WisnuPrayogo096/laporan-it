<?php
// database/migrations/xxxx_xx_xx_rename_user_table_to_petugas_it.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // public function up(): void
    // {
    //     // Hapus foreign key terlebih dahulu
    //     Schema::table('detail_laporan', function (Blueprint $table) {
    //         $table->dropForeign(['id_petugas_it']);
    //     });

    //     // Perbarui foreign key agar tetap menggunakan id
    //     Schema::table('detail_laporan', function (Blueprint $table) {
    //         $table->foreign('id_petugas_it')
    //               ->references('id')
    //               ->on('petugas_it')
    //               ->onDelete('set null');
    //     });
    // }

    // public function down(): void
    // {
    //     // Hapus foreign key sebelum rename kembali tabel
    //     Schema::table('detail_laporan', function (Blueprint $table) {
    //         $table->dropForeign(['id_petugas_it']);
    //     });

    //     // Rename tabel kembali ke user
    //     Schema::rename('petugas_it', 'user');

    //     // Buat ulang foreign key yang mengarah ke tabel user
    //     Schema::table('detail_laporan', function (Blueprint $table) {
    //         $table->foreign('petugas_it')
    //               ->references('id')
    //               ->on('user')
    //               ->onDelete('set null');
    //     });
    // }
};