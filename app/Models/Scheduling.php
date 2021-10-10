<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Scheduling extends Model
{
    use HasFactory;

    protected $fillable = [
    	'id_material',
        'id_tahfids',
        'id_mentor',
        'schedule',
        'start_date',
        'finish_date',
        'description_schedule',
        'publish',
    ];

    public function allData(){
        return DB::table('schedulings')->paginate(5);
    }

    public function allDatas(){
        return DB::table('schedulings')->get();
    }

    public function allDatak($id_schedule){
        return DB::table('schedulings')->where('id_schedule', $id_schedule)->get();
    }

    public function Search($search){
        return DB::table('schedulings')
        ->where('title_campus','LIKE',"%".$search."%")
        ->paginate();
    }

    public function detailData($id_schedule){
        return DB::table('schedulings')->where('id_schedule', $id_schedule)->first();
    }

    public function addData($data){
        DB::table('schedulings')->insert($data);
    }

    public function editData($id_schedule, $data){
        DB::table('schedulings')
        ->where('id_schedule', $id_schedule)
        ->update($data);
    }

    public function deleteData($id_schedule){
        DB::table('schedulings')
        ->where('id_schedule', $id_schedule)
        ->delete();
    }
}
