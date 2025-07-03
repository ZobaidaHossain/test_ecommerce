<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'name'
    ];
    protected $dates=['deleted_at'];

public function users()
{
    return $this->belongsTo(User::class,'role_id','id');
}

static public function getRecord()
{
    return Role::get();
}
}
