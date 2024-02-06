<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class node extends Model
{
    use HasFactory;
    protected $table = 'node';
    protected $guarded = [];

    public function edgesAsStart(){
        return $this->hasMany(EdgeModel::class, 'awal_id');
    }

    public function edgesAsEnd(){
        return $this->hasMany(EdgeModel::class, 'akhir_id');
    }
}
