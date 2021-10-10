<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Access;
use App\Models\Role;
use App\Models\Navbar;
use Livewire\WithPagination;
use App\Http\Livewire\LiveActivity;

class LiveAccess extends Component
{
	use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name;
    public $id_role;
    public $id_nav;
    public $idaccess;

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function __construct(){
        $this->LiveActivity = new LiveActivity();
    }

    //function clear form access
    public function clearform(){
        $this->id_role = '';
        $this->id_nav = '';
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

    //function save data access
    public function SaveData(){
    	$this->validate([
            'id_role' => 'required',
            'id_nav' => 'required',
        ], [
            'id_role.required' => 'Wajib diisi !!',
            'id_nav.required' => 'Wajib diisi !!',
        ]);

        $levelk = Level::where('id_role', $this->id_role)->first();
        $this->name = $levelk->name_level;

        $activity_user = "Tambah Data Akses ".$this->name;
        $this->LiveActivity->SaveDataActivity($activity_user);

        Access::create([
            'id_role' => $this->id_role,
            'id_nav' => $this->id_nav,
        ]);
        
        //Livewire Alert
        $messages = "Data Berhasil Disimpan !!!";
        $this->Alerts($messages);
		$this->clearform();
    }

    //function detail data access
    public function DetailData($id_access){
    	$accessk = Access::where('id_access',$id_access)->first();
        $this->idaccess = $accessk->id_access;
    	$this->id_role = $accessk->id_role;
    	$this->id_nav = $accessk->id_nav;
        $levelk = Role::where('id_role', $this->id_role)->first();
        $this->name = $levelk->name_level;
  	}

  	//function update data access
	public function UpdateData(){
    	$this->validate([
            'id_role' => 'required',
            'id_nav' => 'required',
        ], [
            'id_role.required' => 'Wajib diisi !!',
            'id_nav.required' => 'Wajib diisi !!',
        ]);

        $activity_user = "Ubah Data Akses ".$this->name;
        $this->LiveActivity->SaveDataActivity($activity_user);


        Access::where('id_access', $this->idaccess)->update([
            'id_role' => $this->id_role,
            'id_nav' => $this->id_nav,
        ]);
        
        //Livewire Alert
        $messages = "Data Berhasil Diubah !!!";
        $this->Alerts($messages);
    }

    //function delete data access
    public function DeleteData($id_access){
        $accessk = Access::where('id_access',$id_access)->first();
        $this->id_role = $accessk->id_role;
        $levelk = Role::where('id_role', $this->id_role)->first();
        $this->name = $levelk->name_level;

        $activity_user = "Hapus Data Akses ".$this->name;
        $this->LiveActivity->SaveDataActivity($activity_user);

    		Access::where('id_access',$id_access)->delete();
    		
        //Livewire Alert
        $messages = "Data Berhasil Dihapus !!!";
        $this->Alerts($messages);
	  }
    
    public function render()
    {
        return view('livewire.live-access', [
        	'accesss' => Access::Join('roles', 'accesses.id_role', '=', 'roles.id_role')->Join('navbars', 'accesses.id_nav', '=', 'navbars.id_navbar')->where('roles.name_role', 'like', '%'.$this->search.'%')->orderBy('id_access','DESC')->paginate(5),
        	'roles' => Role::get(),
        	'navbars' => Navbar::get(),
        ])->layout('access.access');
    }
}
