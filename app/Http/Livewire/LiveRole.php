<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Role;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\LiveActivity;

class LiveRole extends Component
{
	  use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $created_by;
    public $name_role;
    public $idrole;

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function __construct(){
        $this->LiveActivity = new LiveActivity();
    }

    //function clear form role
    public function clearform(){
        $this->name_role = '';
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

    //function save data role
    public function SaveData(){
    	  $this->validate([
            'name_role' => 'required',
        ], [
            'name_role.required' => 'Wajib diisi !!',
        ]);

        $activity_user = "Tambah Data role ".$this->name_role;
        $this->LiveActivity->SaveDataActivity($activity_user);

        Role::create([
            'created_by' => Auth::user()->id_user,
            'updated_by' => Auth::user()->id_user,
            'name_role' => $this->name_role,
        ]);
        
        //Livewire Alert
        $messages = "Data Berhasil Disimpan !!!";
        $this->Alerts($messages);

		    $this->clearform();
    }

    //function detail data role
    public function DetailData($id_role){
  		  $rolek = Role::where('id_role',$id_role)->first();
        $this->created_by = $rolek->created_by;
        $this->idrole = $rolek->id_role;
  		  $this->name_role = $rolek->name_role;
  	}

  	//function update data role
	  public function UpdateData(){
    	  $this->validate([
            'name_role' => 'required',
        ], [
            'name_role.required' => 'Wajib diisi !!',
        ]);

        $activity_user = "Ubah Data role ".$this->name_role;
        $this->LiveActivity->SaveDataActivity($activity_user);

        Role::where('id_role', $this->idrole)->update([
            'created_by' => $this->created_by,
            'updated_by' => Auth::user()->id_user,
            'name_role' => $this->name_role,
        ]);
        
        //Livewire Alert
        $messages = "Data Berhasil Diubah !!!";
        $this->Alerts($messages);
    }

    //function delete data role
    public function DeleteData($id_role){
        $rolek = role::where('id_role',$id_role)->first();
        $this->name_role = $rolek->name_role;
        $activity_user = "Hapus Data role ".$this->name_role;
        $this->LiveActivity->SaveDataActivity($activity_user);
    		Role::where('id_role',$id_role)->delete();
    		
        //Livewire Alert
        $messages = "Data Berhasil Dihapus !!!";
        $this->Alerts($messages);
	}

    public function render()
    {
        return view('livewire.live-role', [
        	'roles' => Role::where('name_role', 'like', '%'.$this->search.'%')->orderBy('id_role','DESC')->paginate(5),
        ])->layout('role.role');
    }
}
