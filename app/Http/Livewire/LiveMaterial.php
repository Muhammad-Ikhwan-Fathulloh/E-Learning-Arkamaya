<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Materialaccess;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\LiveActivity;

class LiveMaterial extends Component
{
	use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    //Find method Activity from LiveActivity
    public function __construct(){
        $this->LiveActivity = new LiveActivity();
    }

    public function Alerts($messages){
        $this->alert('success', $messages, [
                    'position' =>  'center', 
                    'timer' =>  3000,  
                    'toast' =>  true, 
                    'text' =>  '', 
                    'confirmButtonText' =>  'Ok', 
                    'cancelButtonText' =>  'Cancel', 
                    'showCancelButton' =>  false, 
                    'showConfirmButton' =>  false, 
        ]);
    }

    //function delete data Materialaccess
    public function DeleteData($id_material){
        $materik = Materialaccess::where('id_material',$id_material)->first();
        $this->title = $materik->title;

        $activity_user = "Hapus Data Materi ".$this->title;
        $this->LiveActivity->SaveDataActivity($activity_user);

    	Materialaccess::where('id_material',$id_material)->delete();
    		
        //Livewire Alert
        $messages = "Data Berhasil Dihapus !!!";
        $this->Alerts($messages);
	}

    public function render()
    {
        return view('livewire.live-material', [
          'materials' => Materialaccess::where('title', 'like', '%'.$this->search.'%')->orderBy('id_material','DESC')->paginate(5),
        ])->layout('material.material');
    }
}
