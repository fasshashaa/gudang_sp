<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarang extends Model
{
    use HasFactory;

    protected $table = 'tb_detailbarang';
    protected $primaryKey = 'code_detail'; // Ini adalah foreign key tapi juga primary key di tabel ini
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'code_detail',
        'specification',
        'box',
        'using_2024',
        'opening',
        'received',
        'used',
        'closing',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'code_detail', 'code');
    }
}