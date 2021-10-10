<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Logactivity;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\LiveActivity;

class LiveActivity extends Component
{
	  use WithPagination;
    protected $paginationTheme = 'bootstrap';

	  public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

	  //function save data activity
    public function SaveDataActivity($activity_user){
    	  date_default_timezone_set('Asia/Jakarta');

        Logactivity::create([
            'id_user' => Auth::user()->id_user,
            'activity_user' => $activity_user,
            'date' => date('d-m-Y'),
        ]);
    }

    //function delete data activity
    public function DeleteData($id_activity){
        Logactivity::where('id_activity',$id_activity)->delete();
        
        //Livewire Alert
        $this->alert('success', 'Data Berhasil Dihapus !!!', [
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

    public function render()
    {
        return view('livewire.live-activity', [
            'activities' => Logactivity::Join('users', 'logactivities.id_user', '=', 'users.id_user')->where('users.name', 'like', '%'.$this->search.'%')->orderBy('id_activity','DESC')->paginate(5),
        ])->layout('activity.activity');
    }
}
