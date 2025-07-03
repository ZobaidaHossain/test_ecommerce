<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table='permissions';
    static public function getSignle($id)
    {
        return Permission::find($id);
    }
    static public function getRecord()
    {
        $getPermission =Permission::groupBy('groupBy')->get();
        $result=array();
        foreach($getPermission as $value){
            $getPermissionGroup = Permission::getPermissionGroup($value->groupby);
            $data =array();
            $data['id']=$value->id;
            $data['name']=$value->name;
            $group=array();
            foreach($getPermissionGroup as $valueG)
            {
                $dataG=array();
                $dataG['id']=$valueG->id;
                $dataG['name']=$valueG->name;
                $group[]=$dataG;
            }
            $data['group']=$group;
            $result[]=$data;

        }
return $result;
    }
    static public function getPermissiongroup($groupby)
    {
        return Permission::where('groupby','=',$groupby)->get();
    }
}
