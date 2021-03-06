<?php

namespace App\Http\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Category extends Model {

    use HasSoftDelete;
    protected $table = "categories";
    protected $fillable = ['name','parent_id'];
    protected $deletedAt = 'deleted_at';

    public function parent(){

        return $this->belongsTo('\App\Http\Models\Category', 'parent_id', 'id');
    }
}