<?php

use Illuminate\Support\Facades\Route;
use App\Http\livewire\LiveHome;
use App\Http\livewire\LiveUser;
use App\Http\livewire\LiveNavbar;
use App\Http\livewire\LiveActivity;
use App\Http\livewire\LiveRole;
use App\Http\livewire\LiveAccess;

use App\Http\livewire\LiveInputprogress;
use App\Http\livewire\LiveMaterial;
use App\Http\livewire\LiveMentoring;
use App\Http\livewire\LivePresensi;
use App\Http\livewire\LiveScheduling;
use App\Http\livewire\LiveCategory;
use App\Http\livewire\LiveInputtask;
use App\Http\livewire\Liveboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layout.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/home',LiveHome::class)->name('home')->middleware('auth');
Route::get('/user',LiveUser::class)->name('user')->middleware('auth');

//Route Management User
Route::get('/aktivitas',LiveActivity::class)->name('aktivitas')->middleware('auth');
Route::get('/peran',LiveRole::class)->name('peran')->middleware('auth');
Route::get('/akses',LiveAccess::class)->name('akses')->middleware('auth');
Route::get('/navigasi',LiveNavbar::class)->name('navigasi')->middleware('auth');
//Route Management User

//Route Arkamaya
Route::get('/proses',LiveInputprogress::class)->name('proses')->middleware('auth');
Route::get('/materi',LiveMaterial::class)->name('materi')->middleware('auth');
Route::get('/diskusi',LiveMentoring::class)->name('diskusi')->middleware('auth');
Route::get('/presensi',LivePresensi::class)->name('presensi')->middleware('auth');
Route::get('/jadwal',LiveScheduling::class)->name('jadwal')->middleware('auth');
Route::get('/kategori',LiveCategory::class)->name('kategori')->middleware('auth');
Route::get('/tugas',LiveInputtask::class)->name('tugas')->middleware('auth');
Route::get('/nilai',Liveboard::class)->name('nilai')->middleware('auth');
//Route Arkamaya
