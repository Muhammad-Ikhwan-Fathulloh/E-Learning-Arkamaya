<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Inputtask;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\LiveActivity;

class LiveInputtask extends Component
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
                    'toast' =>  false, 
                    'text' =>  '', 
                    'confirmButtonText' =>  'Ok', 
                    'cancelButtonText' =>  'Cancel', 
                    'showCancelButton' =>  false, 
                    'showConfirmButton' =>  false, 
        ]);
    }

    //function delete data Inputtask
    public function DeleteData($id_task){
        $tasks = Inputtask::where('id_task',$id_task)->first();
        $this->title_task = $tasks->title_task;

        $activity_user = "Hapus Data Tugas ".$this->title_task;
        $this->LiveActivity->SaveDataActivity($activity_user);

    	Inputtask::where('id_task',$id_task)->delete();
    		
        //Livewire Alert
        $messages = "Data Berhasil Dihapus !!!";
        $this->Alerts($messages);
	}
    public function render()
    {
        return view('livewire.live-inputtask')->layout('task.task');
    }
}
