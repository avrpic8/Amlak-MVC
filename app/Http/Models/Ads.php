<?php

namespace App\Http\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Ads extends Model
{
    use HasSoftDelete;

    protected $table = 'ads';
    protected $fillable = ['title', 'description', 'address', 'amount', 'image', 'floor', 'year', 'storeroom', 'balcony', 'area'
    , 'room', 'toilet', 'parking', 'tag', 'status', 'user_id', 'cat_id', 'sell_status', 'type', 'view'];
    protected $deletedAt = 'deleted_at';

    public function gallery(){

        return $this->hasMany('\App\Http\Models\Gallery', 'advertise_id', 'id');
    }

    public function user(){

        return $this->belongsTo('\App\Http\Models\User', 'user_id', 'id');
    }

    public function category(){

        return $this->belongsTo('\App\Http\Models\Category', 'cat_id', 'id');
    }

    public function sellStatus(){

        return ($this->sell_status == 0) ? 'اجاره' : 'خرید';
    }

    public function type(){

        switch ($this->type){

            case 0:
                return 'آپارتمان';

            case 1:
                return 'ویلایی';

            case 2:
                return 'زمین';

            case 3:
                return 'سوله';
        }
    }
}