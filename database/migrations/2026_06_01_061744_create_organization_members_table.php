<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organization_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');                  // Nama personel
            $table->string('position');              // Jabatan (misal: Kepala Desa)
            $table->string('photo')->nullable();     // Foto
            $table->foreignId('parent_id')->nullable()->constrained('organization_members')->nullOnDelete();
            $table->integer('order')->default(0);    // Urutan tampil
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization_members');
    }
};
