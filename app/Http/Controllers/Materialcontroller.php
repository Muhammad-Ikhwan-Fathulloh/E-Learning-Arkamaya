<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Livewire\LiveActivity;
use Image;

class Materialcontroller extends Controller
{
    public function __construct(){
        $this->Category = new Category();
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
            'category' => $this->Category->allDatas(),
        ];
        return view('material.addmaterial', $data);
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
            'id_mentor' => 'required',
            'title' => 'required',
            // 'material' => '|mimes:jpg,jpeg,bmp,png|max:1024',
            'id_category' => 'required',
            'description' => 'required',
        ], [
            'id_mentor.required' => 'Wajib diisi !!',
            'title.required' => 'Wajib diisi !!',
            'id_category.required' => 'Wajib diisi !!',
            'description.required' => 'Wajib diisi !!',
        ]);

        $this->validate($request, [
            'material' => 'required',
            'material.*' => 'required',
        ]);

        $files = [];
        if ($request->hasFile('material')) {
            foreach ($request->file('material') as $file) {
                $input['imagename'] = time().rand(1,100).'.'.$file->extension();
                $file = Image::make($file->path());
                $file->resize(300, 300, function($constraint){
                    $constraint->aspectRatio();
                })->save(public_path('material').'/'.$input['imagename']);
                $files[] = $input['imagename'];
            }
        }

        date_default_timezone_set('Asia/Jakarta');

        $data = [
            'id_mentor' => Auth::user()->id_user,
            'title' => Request()->title,
            'id_category' => Request()->id_category,
            'date' => date('d-m-Y'),
            'material' => json_encode($files),
            'description' => Request()->description,
            'status' => 0,
        ];

        $activity_user = "Tambah Data Materi ".Request()->title;
        $this->LiveActivity->SaveDataActivity($activity_user);

        $this->News->addData($data);
        Alert::success('Berhasil','Menambahkan Data');
        return redirect()->route('materi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_material)
    {
        if (!$this->Material->detailData($id_material)) {
            abort(404);
        }
        $Materials = $this->Material->detailData($id_material);
        $data = [
            'category' => $this->Category->allDatas(),
            'detail' => $this->Category->allDatak($Materials->id_category),
            'view' => $this->Material->detailData($id_material),
            'images' => json_decode($Materials->material),
        ];
        return view('material.viewmaterial', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_material)
    {
        if (!$this->Material->detailData($id_material)) {
            abort(404);
        }
        $Materials = $this->Material->detailData($id_material);
        $data = [
            'category' => $this->Category->allDatas(),
            'detail' => $this->Category->allDatak($Materials->id_category),
            'edit' => $this->Material->detailData($id_material),
            'images' => json_decode($Materials->material),
        ];
        return view('material.editmaterial', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_material)
    {
        Request()->validate([
            'id_mentor' => 'required',
            'title' => 'required',
            
            'id_category' => 'required',
            'description' => 'required',
        ], [
            'id_mentor.required' => 'Wajib diisi !!',
            'title.required' => 'Wajib diisi !!',
            'id_category.required' => 'Wajib diisi !!',
            'description.required' => 'Wajib diisi !!',
        ]);

        if ($request->hasFile('material') <> "") {
            $files = [];
            if ($request->hasFile('material')) {
                foreach ($request->file('material') as $file) {
                    $input['imagename'] = time().rand(1,100).'.'.$file->extension();
                    $file = Image::make($file->path());
                    $file->resize(300, 300, function($constraint){
                        $constraint->aspectRatio();
                    })->save(public_path('material').'/'.$input['imagename']);
                    $files[] = $input['imagename'];
                }
            }
            $data = [
                'id_mentor' => Auth::user()->id_user,
                'title' => Request()->title,
                'id_category' => Request()->id_category,
                'date' => date('d-m-Y'),
                'material' => json_encode($files),
                'description' => Request()->description,
                'status' => 0,
            ];

            $this->Material->editData($id_material, $data);
        }else{
             $data = [
                'id_mentor' => Auth::user()->id_user,
                'title' => Request()->title,
                'id_category' => Request()->id_category,
                'description' => Request()->description,
                'status' => 0,
            ];

            $this->Material->editData($id_material, $data);
        }

        $activity_user = "Ubah Data Materi ".Request()->title;
        $this->LiveActivity->SaveDataActivity($activity_user);

        Alert::success('Berhasil','Mengubah Data');
        return redirect()->route('materi');
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
