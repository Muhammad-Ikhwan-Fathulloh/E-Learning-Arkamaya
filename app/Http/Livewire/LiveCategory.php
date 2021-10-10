<?php

namespace App\Http\Livewire;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\LiveActivity;

use Livewire\Component;

class LiveCategory extends Component
{
	use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name_category;
    public $idcategory;

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

    //function clear form category
    public function clearform(){
        $this->name_category = '';
    }

    //function save data category
    public function SaveData(){
    	$this->validate([
            'name_category' => 'required',
        ], [
            'name_category.required' => 'Wajib diisi !!',
        ]);

        $activity_user = "Tambah Data Kategori ".$this->name_category;
        $this->LiveActivity->SaveDataActivity($activity_user);

        Category::create([
            'name_category' => $this->name_category,
        ]);
       
        //Livewire Alert
        $messages = "Data Berhasil Disimpan !!!";
        $this->Alerts($messages);

        $this->emit('defaultModalcategory');
		$this->clearform();
    }

    //function detail data category
    public function DetailData($id_category){
  		  $categoryk = Category::where('id_category',$id_category)->first();
          $this->idcategory = $categoryk->id_category;
  		  $this->name_category = $categoryk->name_category;
  	}

  	//function update data category
	  public function UpdateData(){
    	$this->validate([
            'name_category' => 'required',
        ], [
            'name_category.required' => 'Wajib diisi !!',
        ]);

        $activity_user = "Ubah Data Kategori ".$this->name_category;
        $this->LiveActivity->SaveDataActivity($activity_user);

        Category::where('id_category', $this->idcategory)->update([
            'name_category' => $this->name_category,
        ]);
        
        //Livewire Alert
        $messages = "Data Berhasil Diubah !!!";
        $this->Alerts($messages);

        $this->emit('defaultModalupdatecategory');
    }

    //function delete data category
    public function DeleteData($id_category){
        $categoryk = Category::where('id_category',$id_category)->first();
        $this->name_category = $categoryk->name_category;

        $activity_user = "Hapus Data Kategori ".$this->name_category;
        $this->LiveActivity->SaveDataActivity($activity_user);

    	Category::where('id_category',$id_category)->delete();
    		
        //Livewire Alert
        $messages = "Data Berhasil Dihapus !!!";
        $this->Alerts($messages);
	}

    public function render()
    {
        return view('livewire.live-category', [
          'categories' => Category::where('name_category', 'like', '%'.$this->search.'%')->orderBy('id_category','DESC')->paginate(5),
        ])->layout('category.category');
    }
}
