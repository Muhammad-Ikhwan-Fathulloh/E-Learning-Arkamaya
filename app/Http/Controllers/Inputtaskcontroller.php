<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inputtask;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Livewire\LiveActivity;
use Image;

class Inputtaskcontroller extends Controller
{
    public function __construct(){
        $this->Inputtask = new Inputtask();
        $this->Material = new Material();
        $this->LiveActivity = new LiveActivity();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Request()->validate([
            'id_student' => 'required',
            'id_material' => 'required',
            // 'material' => '|mimes:jpg,jpeg,bmp,png|max:1024',
            'title_task' => 'required',
            'description_task' => 'required',
        ], [
            'id_student.required' => 'Wajib diisi !!',
            'id_material.required' => 'Wajib diisi !!',
            'title_task.required' => 'Wajib diisi !!',
            'description_task.required' => 'Wajib diisi !!',
        ]);

        $this->validate($request, [
            'task' => 'required',
            'task.*' => 'required',
        ]);

        $files = [];
        if ($request->hasFile('task')) {
            foreach ($request->file('task') as $file) {
                $input['imagename'] = time().rand(1,100).'.'.$file->extension();
                $file = Image::make($file->path());
                $file->resize(300, 300, function($constraint){
                    $constraint->aspectRatio();
                })->save(public_path('task').'/'.$input['imagename']);
                $files[] = $input['imagename'];
            }
        }

        $data = [
            'id_student' => Auth::user()->id_user,
            'id_material' => Request()->id_material,
            'title_task' => Request()->title_task,
            'task' => json_encode($files),
            'description_task' => Request()->description_task,
            'status_task' => 0,
        ];

        $activity_user = "Tambah Data Tugas ".Request()->title_task;
        $this->LiveActivity->SaveDataActivity($activity_user);

        $this->Inputtask->addData($data);
        Alert::success('Berhasil','Menambahkan Data');
        return redirect()->route('tugas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'material' => $this->Material->allDatas(),
        ];
        return view('task.addtask', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_task)
    {
        if (!$this->Inputtask->detailData($id_task)) {
            abort(404);
        }
        $Inputtasks = $this->Inputtask->detailData($id_task);
        $data = [
            'material' => $this->Material->allDatas(),
            'detail' => $this->Material->allDatak($Inputtasks->id_material),
            'view' => $this->Inputtask->detailData($id_task),
            'images' => json_decode($Inputtasks->task),
        ];
        return view('task.viewtask', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_task)
    {
        if (!$this->Inputtask->detailData($id_task)) {
            abort(404);
        }
        $Inputtasks = $this->Inputtask->detailData($id_task);
        $data = [
            'material' => $this->Material->allDatas(),
            'detail' => $this->Material->allDatak($Inputtasks->id_material),
            'edit' => $this->Inputtask->detailData($id_task),
            'images' => json_decode($Inputtasks->task),
        ];
        return view('task.edittask', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_task)
    {
        Request()->validate([
            'id_student' => 'required',
            'id_material' => 'required',
            // 'material' => '|mimes:jpg,jpeg,bmp,png|max:1024',
            'title_task' => 'required',
            'description_task' => 'required',
        ], [
            'id_student.required' => 'Wajib diisi !!',
            'id_material.required' => 'Wajib diisi !!',
            'title_task.required' => 'Wajib diisi !!',
            'description_task.required' => 'Wajib diisi !!',
        ]);

        if ($request->hasFile('task') <> "") {
            $files = [];
            if ($request->hasFile('task')) {
                foreach ($request->file('task') as $file) {
                    $input['imagename'] = time().rand(1,100).'.'.$file->extension();
                    $file = Image::make($file->path());
                    $file->resize(300, 300, function($constraint){
                        $constraint->aspectRatio();
                    })->save(public_path('task').'/'.$input['imagename']);
                    $files[] = $input['imagename'];
                }
            }
            $data = [
                'id_student' => Auth::user()->id_user,
                'id_material' => Request()->id_material,
                'title_task' => Request()->title_task,
                'task' => json_encode($files),
                'description_task' => Request()->description_task,
            ];

            $this->Inputtask->editData($id_task, $data);
        }else{
             $data = [
                'id_student' => Auth::user()->id_user,
                'id_material' => Request()->id_material,
                'title_task' => Request()->title_task,
                'description_task' => Request()->description_task,
            ];

            $this->Inputtask->editData($id_task, $data);
        }

        $activity_user = "Ubah Data Tugas ".Request()->title_news;
        $this->LiveActivity->SaveDataActivity($activity_user);

        Alert::success('Berhasil','Mengubah Data');
        return redirect()->route('tugas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
