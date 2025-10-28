<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MagangApplicants extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'asal_institusi',
        'program_studi',
        'email',
        'nomor_hp',
        // 'pilihan_divisi',
        'surat_pengantar_path',
        // --- Kolom Admin Decision ---
        'status', 
        'alasan_admin',
        'tanggal_keputusan',
        'surat_keputusan_path', // Untuk menyimpan path Surat Keputusan Admin
    ];

    // Set default status dan tipe data
    protected $attributes = [
        'status' => 'pending',
    ];
    
    protected $casts = [
        'tanggal_keputusan' => 'datetime',
    ];
}