<?php

namespace App\Http\Livewire;
use App\Models\Presensi;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\LiveActivity;

use Livewire\Component;

class LivePresensi extends Component
{
	use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $id_mentor;
    public $id_student;
    public $date_presensi;
    public $description_presensi;
    public $status_presensi;
    public $idpresensi;

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

    //function clear form presensi
    public function clearform(){
        $this->id_mentor = '';
        $this->id_student = '';
        $this->date_presensi = '';
        $this->description_presensi = '';
        $this->status_presensi = '';
    }

    //function save data presensi
    public function SaveData(){
    	$this->validate([
            'id_mentor' => 'required',
            'id_student' => 'required',
            'description_presensi' => 'required',
            'status_presensi' => 'required',
        ], [
            'id_mentor.required' => 'Wajib diisi !!',
            'id_student.required' => 'Wajib diisi !!',
            'description_presensi.required' => 'Wajib diisi !!',
            'status_presensi.required' => 'Wajib diisi !!',
        ]);

        $activity_user = "Tambah Data Presensi ".$this->id_student." Tanggal ".date('d-m-Y');
        $this->LiveActivity->SaveDataActivity($activity_user);
        date_default_timezone_set('Asia/Jakarta');

        Presensi::create([
            'id_mentor' => $this->id_mentor,
            'id_student' => $this->id_student,
            'date_presensi' => date('d-m-Y'),
            'description_presensi' => $this->description_presensi,
            'status_presensi' => $this->status_presensi,
        ]);
       
        //Livewire Alert
        $messages = "Data Berhasil Disimpan !!!";
        $this->Alerts($messages);

        $this->emit('defaultModalpresensi');
		$this->clearform();
    }

    //function detail data presensi
    public function DetailData($id_presensi){
  		  $presensik = Presensi::where('id_presensi',$id_presensi)->first();
          $this->idpresensi = $presensik->id_presensi;
  		  $this->id_mentor = $presensik->id_mentor;
  		  $this->id_student = $presensik->id_student;
  		  $this->date_presensi = $presensik->date_presensi;
  		  $this->description_presensi = $presensik->description_presensi;
  		  $this->status_presensi = $presensik->status_presensi;
  	}

  	//function update data presensi
	  public function UpdateData(){
    	$this->validate([
            'id_mentor' => 'required',
            'id_student' => 'required',
            'description_presensi' => 'required',
            'status_presensi' => 'required',
        ], [
            'id_mentor.required' => 'Wajib diisi !!',
            'id_student.required' => 'Wajib diisi !!',
            'description_presensi.required' => 'Wajib diisi !!',
            'status_presensi.required' => 'Wajib diisi !!',
        ]);


        $activity_user = "Ubah Data Presensi ".$this->id_student." Tanggal ".$this->date_presensi;
        $this->LiveActivity->SaveDataActivity($activity_user);

        Presensi::where('id_presensi', $this->idpresensi)->update([
            'id_mentor' => $this->id_mentor,
            'id_student' => $this->id_student,
            'date_presensi' => $this->date_presensi,
            'description_presensi' => $this->description_presensi,
            'status_presensi' => $this->status_presensi,
        ]);
        
        //Livewire Alert
        $messages = "Data Berhasil Diubah !!!";
        $this->Alerts($messages);

        $this->emit('defaultModalupdatepresensi');
    }

    //function delete data presensi
    public function DeleteData($id_presensi){
        $presensik = Presensi::where('id_presensi',$id_presensi)->first();
        $this->id_mentor = $presensik->id_mentor;
        $this->date_presensi = $presensik->date_presensi;

        $activity_user = "Hapus Data Presensi ".$this->id_student." Tanggal ".$this->date_presensi;
        $this->LiveActivity->SaveDataActivity($activity_user);

    	Presensi::where('id_presensi',$id_presensi)->delete();
    		
        //Livewire Alert
        $messages = "Data Berhasil Dihapus !!!";
        $this->Alerts($messages);
	}

    public function render()
    {
        return view('livewire.live-presensi')->layout('presensi.presensi');
    }
}
