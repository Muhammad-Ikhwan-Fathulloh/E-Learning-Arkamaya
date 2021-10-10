<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Leaderboard;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\LiveActivity;

class LiveBoard extends Component
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

     public function ScoreBoard($id_user, $score){
        $boards = Leaderboard::where('id_student',$id_user)->first();
        if (empty($boards->id_leaderboard)) {
            Leaderboard::create([
                'id_student' => $id_user,
                'score_user' => $boards->score + $score,
            ]);
        }else{
            Leaderboard::where('id_leaderboard', $boards->id_leaderboard)->update([
                'score_user' => $boards->score + $score,
            ]);
        }
        
    }

    public function render()
    {
        return view('livewire.live-board')->layout('board.board');
    }
}
