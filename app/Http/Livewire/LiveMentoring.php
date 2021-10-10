<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Mentoring;
use Livewire\WithPagination;

class LiveMentoring extends Component
{
	  use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $id_mentor;
  	public $pesan;
  	public $file;

  	public $ids;

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

	  public function clearform(){
        $this->id_mentor = '';
        $this->pesan = '';
        $this->file = '';
    }

    public function SimpanData(){
      if (is_null($this->id_mentor)) {
        $messages = "Pilih Mentor!";
        $this->Alerts($messages);
      
      }elseif ($this->id_mentor == '------- Mentor -------') {
        $messages = "Pilih Mentor!";
        $this->Alerts($messages);

      } else{
        $this->validate([
            'pesan' => 'required',
        ], [
            'pesan.required' => 'Wajib diisi !!',
        ]);

        Mentoring::create([
            'id_mentor' => $this->id_mentor,
            'id_student' => Auth::user()->id_user,
            'pesan' => $this->pesan,
            'file' => $this->file,
        ]);
        $this->clearform();

        $activity_user = "Mengirim pesan ".$this->pesan;
        $this->LiveActivity->SaveDataActivity($activity_user);

        $messages = "Pesan Terkirim!";
        $this->Alerts($messages);
      }
        
    }

    public function deleteData($id_mentoring){
      $mentorings = Mentoring::where('id_mentoring',$id_mentoring)->first();
      $this->pesan = $mentorings->pesan;

      $activity_user = "Menghapus pesan ".$this->pesan;
      $this->LiveActivity->SaveDataActivity($activity_user);

  		Mentoring::where('id_mentoring',$id_mentoring)->delete();
  		
  	}

    public function render()
    {
        return view('livewire.live-mentoring')->layout('mentoring.mentoring');
    }
}
