<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Navbar;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\LiveActivity;

class LiveNavbar extends Component
{
	use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $created_by;
    public $icon_nav;
    public $name_nav;
    public $link_nav;
    public $idnav;

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function __construct(){
        $this->LiveActivity = new LiveActivity();
    }

    //function clear form navbar
    public function clearform(){
        $this->icon_nav = '';
        $this->name_nav = '';
        $this->link_nav = '';
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

    //function save data navbar
    public function SaveData(){
    	$this->validate([
            'icon_nav' => 'required',
            'name_nav' => 'required',
            'link_nav' => 'required',
        ], [
            'icon_nav.required' => 'Wajib diisi !!',
            'name_nav.required' => 'Wajib diisi !!',
            'link_nav.required' => 'Wajib diisi !!',
        ]);

        $activity_user = "Tambah Data Navigasi ".$this->name_nav;
        $this->LiveActivity->SaveDataActivity($activity_user);

        Navbar::create([
            'created_by' => Auth::user()->id_user,
            'updated_by' => Auth::user()->id_user,
            'icon_nav' => $this->icon_nav,
            'name_nav' => $this->name_nav,
            'link_nav' => $this->link_nav,
        ]);
        
        //Livewire Alert
        $messages = "Data Berhasil Disimpan !!!";
        $this->Alerts($messages);
		    $this->clearform();
    }

    //function detail data navbar
    public function DetailData($id_navbar){
  		  $navbark = Navbar::where('id_navbar',$id_navbar)->first();
        $this->created_by = $navbark->created_by;
  		  $this->icon_nav = $navbark->icon_nav;
  		  $this->name_nav = $navbark->name_nav;
  		  $this->link_nav = $navbark->link_nav;
  	}

    //function update data navbar
	  public function UpdateData(){
    	$this->validate([
            'icon_nav' => 'required',
            'name_nav' => 'required',
            'link_nav' => 'required',
        ], [
            'icon_nav.required' => 'Wajib diisi !!',
            'name_nav.required' => 'Wajib diisi !!',
            'link_nav.required' => 'Wajib diisi !!',
        ]);

        $activity_user = "Ubah Data Navigasi ".$this->name_nav;
        $this->LiveActivity->SaveDataActivity($activity_user);

        Navbar::where('id_navbar', $this->idnav)->update([
            'created_by' => $this->created_by,
            'updated_by' => Auth::user()->id_user,
            'icon_nav' => $this->icon_nav,
            'name_nav' => $this->name_nav,
            'link_nav' => $this->link_nav,
        ]);
        
        //Livewire Alert
        $messages = "Data Berhasil Disimpan !!!";
        $this->Alerts($messages);
    }

    //function delete data navbar
    public function DeleteData($id_navbar){
        $navbark = Navbar::where('id_navbar',$id_navbar)->first();
        $this->name_nav = $navbark->name_nav;
        $activity_user = "Hapus Data Navigasi ".$this->name_nav;
        $this->LiveActivity->SaveDataActivity($activity_user);
    		Navbar::where('id_navbar',$id_navbar)->delete();
    		
        //Livewire Alert
        $messages = "Data Berhasil Disimpan !!!";
        $this->Alerts($messages);
	}

    public function render()
    {
        return view('livewire.live-navbar', [
          'navbars' => Navbar::where('name_nav', 'like', '%'.$this->search.'%')->orderBy('id_navbar','DESC')->paginate(5),
        ])->layout('navbar.navbar');
    }
}
