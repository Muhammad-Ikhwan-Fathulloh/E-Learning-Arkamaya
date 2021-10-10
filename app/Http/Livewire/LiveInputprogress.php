<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Inputprogress;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\LiveActivity;

class LiveInputprogress extends Component
{
	use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $id_mentor;
    public $id_student;
    public $id_material;
    public $score_material;
    public $description_progress;
    public $idInputprogress;

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
                    'toast' =>  false, 
                    'text' =>  '', 
                    'confirmButtonText' =>  'Ok', 
                    'cancelButtonText' =>  'Cancel', 
                    'showCancelButton' =>  false, 
                    'showConfirmButton' =>  false, 
        ]);
    }

    //function clear form Inputprogress
    public function clearform(){
        $this->id_mentor = '';
        $this->id_student = '';
        $this->id_material = '';
        $this->score_material = '';
        $this->description_progress = '';
    }

    //function save data Inputprogress
    public function SaveData(){
    	$this->validate([
            'id_mentor' => 'required',
            'id_student' => 'required',
            'id_material' => 'required',
            'score_material' => 'required',
            'description_progress' => 'required',
        ], [
            'id_mentor.required' => 'Wajib diisi !!',
            'id_student.required' => 'Wajib diisi !!',
            'id_material.required' => 'Wajib diisi !!',
            'score_material.required' => 'Wajib diisi !!',
            'description_progress.required' => 'Wajib diisi !!',
        ]);

        $activity_user = "Tambah Data Inputprogress ".$this->id_student;
        $this->LiveActivity->SaveDataActivity($activity_user);
        
        Inputprogress::create([
            'id_mentor' => $this->id_mentor,
            'id_student' => $this->id_student,
            'id_material' => $this->id_material,
            'score_material' => $this->score_material,
            'description_progress' => $this->description_progress,
        ]);
       
        //Livewire Alert
        $messages = "Data Berhasil Disimpan !!!";
        $this->Alerts($messages);

        $this->emit('defaultModalInputprogress');
		$this->clearform();
    }

    //function detail data Inputprogress
    public function DetailData($id_progress){
  		  $Inputprogressk = Inputprogress::where('id_progress',$id_progress)->first();
          $this->idInputprogress = $Inputprogressk->id_progress;
  		  $this->id_mentor = $Inputprogressk->id_mentor;
  		  $this->id_student = $Inputprogressk->id_student;
  		  $this->id_material = $Inputprogressk->id_material;
  		  $this->score_material = $Inputprogressk->score_material;
  		  $this->description_progress = $Inputprogressk->description_progress;
  	}

  	//function update data Inputprogress
	  public function UpdateData(){
    	$this->validate([
            'id_mentor' => 'required',
            'id_student' => 'required',
            'id_material' => 'required',
            'score_material' => 'required',
            'description_progress' => 'required',
        ], [
            'id_mentor.required' => 'Wajib diisi !!',
            'id_student.required' => 'Wajib diisi !!',
            'id_material.required' => 'Wajib diisi !!',
            'score_material.required' => 'Wajib diisi !!',
            'description_progress.required' => 'Wajib diisi !!',
        ]);


        $activity_user = "Ubah Data Inputprogress ".$this->id_student;
        $this->LiveActivity->SaveDataActivity($activity_user);

        Inputprogress::where('id_progress', $this->idInputprogress)->update([
            'id_mentor' => $this->id_mentor,
            'id_student' => $this->id_student,
            'id_material' => $this->id_material,
            'score_material' => $this->score_material,
            'description_progress' => $this->description_progress,
        ]);
        
        //Livewire Alert
        $messages = "Data Berhasil Diubah !!!";
        $this->Alerts($messages);

        $this->emit('defaultModalupdateInputprogress');
    }

    //function delete data Inputprogress
    public function DeleteData($id_progress){
        $Inputprogressk = Inputprogress::where('id_progress',$id_progress)->first();
        $this->id_mentor = $Inputprogressk->id_mentor;
        $this->id_material = $Inputprogressk->id_material;

        $activity_user = "Hapus Data Inputprogress ".$this->id_student;
        $this->LiveActivity->SaveDataActivity($activity_user);

    	Inputprogress::where('id_progress',$id_progress)->delete();
    		
        //Livewire Alert
        $messages = "Data Berhasil Dihapus !!!";
        $this->Alerts($messages);
	}

    public function render()
    {
        return view('livewire.live-inputprogress')->layout('progress.progress');
    }
}
