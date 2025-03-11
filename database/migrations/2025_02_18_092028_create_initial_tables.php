<?php
// database/migrations/xxxx_xx_xx_create_initial_tables.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create user table
        Schema::create('petugas_it', function (Blueprint $table) {
            $table->id(); // Primary Key (Big Integer, Auto Increment)
            $table->string('nomor_petugas', 50)->unique();
            $table->string('nama_petugas_it', 100)->unique();
            $table->integer('jml_selesai')->default(0);
            $table->integer('jml_ditolak')->default(0);
            $table->integer('jml_diproses')->default(0);
            $table->timestamps();
        });

        // Create detail_laporan table
        Schema::create('detail_laporan', function (Blueprint $table) {
            $table->id();
            $table->string('nmr_laporan', 15);
            $table->dateTime('waktu_dihubungi');
            $table->string('ruangan_unit', 20);
            $table->string('petugas_pelapor', 20);
            $table->string('jenis_kerusakan', 20);
            $table->text('permasalahan');
            $table->text('tindakan')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->string('kriteria', 50)->nullable();
            $table->time('waktu_pengerjaan')->nullable();
            $table->integer('numerator')->nullable();
            $table->integer('denominator')->nullable();
            $table->unsignedBigInteger('id_petugas_it')->nullable();
            $table->string('nomor_pelapor', 20)->nullable();
            $table->enum('status_laporan', ['Dalam Antrean', 'Diluar Jam Operasional', 'Diproses', 'Belum Dikonfirmasi', 'Selesai', 'Ditolak'])->default('Dalam Antrean');
            $table->timestamps();

            // Foreign key constraint ke tabel user
            $table->foreign('id_petugas_it')
                ->references('id')
                ->on('petugas_it')
                ->onDelete('set null');
        });

        // Create activity table
        Schema::create('activity', function (Blueprint $table) {
            $table->id();
            $table->dateTime('time');
            $table->text('message_received');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_laporan');
        Schema::dropIfExists('activity');
        Schema::dropIfExists('user');
    }
};
