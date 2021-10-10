<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Materialaccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_mentor',
        'title',
        'id_category',
        'date',
        'material',
        'description',
        'status',
    ];

    public function allData(){
        return DB::table('materialaccesses')->paginate(5);
    }

    public function allDatas(){
        return DB::table('materialaccesses')->get();
    }

    public function allDatak($id_material){
        return DB::table('materialaccesses')->where('id_material', $id_material)->get();
    }

    public function Search($search){
        return DB::table('materialaccesses')
        ->where('title_campus','LIKE',"%".$search."%")
        ->paginate();
    }

    public function detailData($id_material){
        return DB::table('materialaccesses')->where('id_material', $id_material)->first();
    }

    public function addData($data){
        DB::table('materialaccesses')->insert($data);
    }

    public function editData($id_material, $data){
        DB::table('materialaccesses')
        ->where('id_material', $id_material)
        ->update($data);
    }

    public function deleteData($id_material){
        DB::table('materialaccesses')
        ->where('id_material', $id_material)
        ->delete();
    }
}
