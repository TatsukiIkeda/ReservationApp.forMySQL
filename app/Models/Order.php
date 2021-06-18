<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Order extends Model
{

    protected $fillable = [
        'order_id',
        'user_id',
        'order_name',
        'title',
        'arrival_date',
        'memo',
        'flg',
        'quantity',
        'vendor',

    ];
    protected $primaryKey = 'order_id';
}
