<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EdgeModel extends Model
{
    use HasFactory;
    protected $table = 'edge';
    protected $guarded = [];

    public function startNode(){
        return $this->belongsTo(node::class, 'awal_id');
    }

    public function endNode(){
        return $this->belongsTo(node::class, 'akhir_id');
    }
}
