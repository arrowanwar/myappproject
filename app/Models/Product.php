<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Pest\Evaluators\Attributes;

class Product extends Model
{
    protected $fillable =['user_id','category_id','name','price','unit'];
    protected  $attributes = [
        'img_url'=> '0'
    ];
}
