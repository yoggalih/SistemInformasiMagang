<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class MagangApplicants extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'asal_institusi',
        'program_studi',
        'email',
        'nomor_hp',
        'pilihan_divisi',
        'surat_pengantar_path',
    ];
}
