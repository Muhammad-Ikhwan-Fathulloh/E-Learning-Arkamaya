<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class LiveUser extends Component
{
	use WithPagination;
    protected $paginationTheme = 'bootstrap';

	public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function Alerts($messages){
        $this->alert('success', $messages, [
                    'position' =>  'top-end', 
                    'timer' =>  3000,  
                    'toast' =>  true, 
                    'text' =>  '', 
                    'confirmButtonText' =>  'Ok', 
                    'cancelButtonText' =>  'Cancel', 
                    'showCancelButton' =>  false, 
                    'showConfirmButton' =>  false, 
        ]);
    }

    //function update role user
    public function rolek($id_user){
        $userk = User::where('id_user',$id_user)->first();
        $ids = $userk->id_user;
        $role = $userk->role;
        if ($role==2) {
            User::where('id_user', $ids)->update([
            'role' => 3,
            ]);

            //Livewire Alert
            $messages = "Role User!";
            $this->Alerts($messages);

        }else if($role==3){
            User::where('id_user', $ids)->update([
            'role' => 2,
            ]);

            //Livewire Alert
            $messages = "Role Admin!";
            $this->Alerts($messages);
        }
        
    }

    //function update status user
    public function statusk($id_user){
        $userk = User::where('id_user',$id_user)->first();
        $ids = $userk->id_user;
        $status = $userk->status;
        if ($status==0) {
            User::where('id_user', $ids)->update([
            'status' => 1,
            ]);

            //Livewire Alert
            $messages = "Status Active!";
            $this->Alerts($messages);
            
        }else if($status==1){
            User::where('id_user', $ids)->update([
            'status' => 0,
            ]);

            //Livewire Alert
            $messages = "Status Passive!";
            $this->Alerts($messages);
        }
        
    }

    //function delete data user
    public function deleteData($id_user){
        User::where('id_user',$id_user)->delete();
        session()->flash('pesan','Data Berhasil Dihapus !!!');

        //Livewire Alert
        $messages = "Status Passive!";
        $this->Alerts($messages);
    }

    //function send data user to view
    public function render()
    {
        return view('livewire.live-user', [
        	'users' => User::where('name', 'like', '%'.$this->search.'%')->orderBy('id_user','DESC')->paginate(5),
        ])->layout('user.user'); 
    }
}
