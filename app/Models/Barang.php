<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'tb_barang';
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
     public $timestamps = false;

    protected $fillable = [
        'code',
        'machine',
        'name_of_good',
    ];

    public function detail()
    {
        return $this->hasOne(DetailBarang::class, 'code_detail', 'code');
    }
}