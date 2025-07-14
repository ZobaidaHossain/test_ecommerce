<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
'product_id','quantity','status',
    ];
    protected $dates=['deleted_at'];

public function getStatusAttribute($value)
{
    return $value ? 'Active' : 'Inactive';
}
public function getProfileAttribute($value){
    return env('APP_URL').'/PUBLIC/STORAGE/'.$value;
}

public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
