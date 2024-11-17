<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dailyschedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kode',
        'matakuliah',
        'sks',
        'nama_kelas',
        'hari',
        'jam',
        'ruang',
        'pengampu1',
        'pengampu2',
    ]; 
}
