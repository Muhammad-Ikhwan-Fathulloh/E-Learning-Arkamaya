<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scheduling;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Livewire\LiveActivity;
use Image;

class Schedulingcontroller extends Controller
{
    public function __construct(){
        $this->Scheduling = new Scheduling();
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
        //
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
        return view('schedule.addschedule', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Request()->validate([
            'id_material' => 'required',
            'id_mentor' => 'required',
            // 'material' => '|mimes:jpg,jpeg,bmp,png|max:1024',
            'start_date' => 'required',
            'finish_date' => 'required',
            'description_schedule' => 'required',
        ], [
            'id_material.required' => 'Wajib diisi !!',
            'id_mentor.required' => 'Wajib diisi !!',
            'start_date.required' => 'Wajib diisi !!',
            'finish_date.required' => 'Wajib diisi !!',
            'description_schedule.required' => 'Wajib diisi !!',
        ]);

        $this->validate($request, [
            'schedule' => 'required',
            'schedule.*' => 'required',
        ]);

        $files = [];
        if ($request->hasFile('schedule')) {
            foreach ($request->file('schedule') as $file) {
                $input['imagename'] = time().rand(1,100).'.'.$file->extension();
                $file = Image::make($file->path());
                $file->resize(300, 300, function($constraint){
                    $constraint->aspectRatio();
                })->save(public_path('schedule').'/'.$input['imagename']);
                $files[] = $input['imagename'];
            }
        }

        $data = [
            'id_material' => Request()->id_material,
            'id_mentor' => Auth::user()->id_user,
            'schedule' => json_encode($files),
            'start_date' => Request()->start_date,
            'finish_date' => Request()->finish_date,
            'description_schedule' => Request()->description_schedule,
            'publish' => 0,
        ];

        $activity_user = "Tambah Data Jadwal ".Request()->description_schedule;
        $this->LiveActivity->SaveDataActivity($activity_user);

        $this->News->addData($data);
        Alert::success('Berhasil','Menambahkan Data');
        return redirect()->route('jadwal');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_schedule)
    {
        if (!$this->Scheduling->detailData($id_schedule)) {
            abort(404);
        }
        $Schedulings = $this->Scheduling->detailData($id_schedule);
        $data = [
            'material' => $this->Material->allDatas(),
            'detail' => $this->Material->allDatak($Schedulings->id_material),
            'view' => $this->Scheduling->detailData($id_schedule),
            'images' => json_decode($Schedulings->scheduling),
        ];
        return view('schedule.viewschedule', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_schedule)
    {
        if (!$this->Scheduling->detailData($id_schedule)) {
            abort(404);
        }
        $Schedulings = $this->Scheduling->detailData($id_schedule);
        $data = [
            'material' => $this->Material->allDatas(),
            'detail' => $this->Material->allDatak($Schedulings->id_material),
            'edit' => $this->Scheduling->detailData($id_schedule),
            'images' => json_decode($Schedulings->scheduling),
        ];
        return view('schedule.editschedule', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_schedule)
    {
        Request()->validate([
            'id_material' => 'required',
            'id_mentor' => 'required',
            // 'material' => '|mimes:jpg,jpeg,bmp,png|max:1024',
            'start_date' => 'required',
            'finish_date' => 'required',
            'description_schedule' => 'required',
        ], [
            'id_material.required' => 'Wajib diisi !!',
            'id_mentor.required' => 'Wajib diisi !!',
            'start_date.required' => 'Wajib diisi !!',
            'finish_date.required' => 'Wajib diisi !!',
            'description_schedule.required' => 'Wajib diisi !!',
        ]);

        if ($request->hasFile('schedule') <> "") {
            $files = [];
            if ($request->hasFile('schedule')) {
                foreach ($request->file('schedule') as $file) {
                    $input['imagename'] = time().rand(1,100).'.'.$file->extension();
                    $file = Image::make($file->path());
                    $file->resize(300, 300, function($constraint){
                        $constraint->aspectRatio();
                    })->save(public_path('schedule').'/'.$input['imagename']);
                    $files[] = $input['imagename'];
                }
            }

            $data = [
                'id_material' => Request()->id_material,
                'id_mentor' => Auth::user()->id_user,
                'schedule' => json_encode($files),
                'start_date' => Request()->start_date,
                'finish_date' => Request()->finish_date,
                'description_schedule' => Request()->description_schedule,
                'publish' => 0,
            ];

            $this->Scheduling->editData($id_schedule, $data);
        }else{
             $data = [
                'id_material' => Request()->id_material,
                'id_mentor' => Auth::user()->id_user,
                'start_date' => Request()->start_date,
                'finish_date' => Request()->finish_date,
                'description_schedule' => Request()->description_schedule,
                'publish' => 0, 
            ];

            $this->Scheduling->editData($id_schedule, $data);
        }

        $activity_user = "Ubah Data Jadwal ".Request()->description_schedule;
        $this->LiveActivity->SaveDataActivity($activity_user);

        Alert::success('Berhasil','Mengubah Data');
        return redirect()->route('jadwal');
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
