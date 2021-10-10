<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inputtask extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_student',
        'id_material',
        'title_task',
        'task',
        'description_task',
        'status_task',
    ];

    public function allData(){
        return DB::table('inputtasks')->paginate(5);
    }

    public function allDatas(){
        return DB::table('inputtasks')->get();
    }

    public function allDatak($id_task){
        return DB::table('inputtasks')->where('id_task', $id_task)->get();
    }

    public function Search($search){
        return DB::table('inputtasks')
        ->where('title_campus','LIKE',"%".$search."%")
        ->paginate();
    }

    public function detailData($id_task){
        return DB::table('inputtasks')->where('id_task', $id_task)->first();
    }

    public function addData($data){
        DB::table('inputtasks')->insert($data);
    }

    public function editData($id_task, $data){
        DB::table('inputtasks')
        ->where('id_task', $id_task)
        ->update($data);
    }

    public function deleteData($id_task){
        DB::table('inputtasks')
        ->where('id_task', $id_task)
        ->delete();
    }
}
