<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
'image','title','brand','price'
    ];
    protected $dates=['deleted_at'];

public function getStatusAttribute($value)
{
    return $value ? 'Active' : 'Inactive';
}
public function getProfileAttribute($value){
    return env('APP_URL').'/PUBLIC/STORAGE/'.$value;
}

public function orders()
{
    return $this->hasMany(Order::class, 'product_id', 'id');
}
}
