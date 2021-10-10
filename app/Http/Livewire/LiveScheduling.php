<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Scheduling;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\LiveActivity;

class LiveScheduling extends Component
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

    //function delete data Scheduling
    public function DeleteData($id_schedule){
        $schedulek = Scheduling::where('id_schedule',$id_schedule)->first();
        $this->schedule = $schedulek->schedule;

        $activity_user = "Hapus Data Penjadwalan ".$this->schedule;
        $this->LiveActivity->SaveDataActivity($activity_user);

    	Scheduling::where('id_schedule',$id_schedule)->delete();
    		
        //Livewire Alert
        $messages = "Data Berhasil Dihapus !!!";
        $this->Alerts($messages);
	}

    public function render()
    {
        return view('livewire.live-scheduling', [
          'schedules' => Scheduling::where('id_material', 'like', '%'.$this->search.'%')->orderBy('id_schedule','DESC')->paginate(5),
        ])->layout('schedule.schedule');
    }
}
