<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="card border-light mb-3 bg-ku">
	  <div class="card-body">
	  	<h3 class="text-dark"><strong>Akses</strong></h3>
	  	<div>
      <form class="d-flex" wire:poll>
      		<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalaccesss"> <strong class="text-white"><i class="fas fa-fw fa-plus"></i></strong></button>
          <input wire:model="search" class="form-control me-2 border-primary" type="text" name="search" placeholder="Cari berdasarkan Nama Akses" aria-label="Search" value="">
          <span class="btn btn-outline-primary" value="cari"><i class="fas fa-fw fa-search"></i></span>
        </form>
    </div>
    <br>
    
		<!-- Data -->
	  	<div class="table-responsive" wire:poll>
	<table class="table table">
		<thead class="table">
			<tr>
				<th>No</th>
				<th>Nama Role</th>
				<th>Akses Navigasi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; ?>
			@foreach ($accesss as $datas)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $datas->name_role }}</td>
					<td>{{ $datas->name_nav }}</td>
					<td>
						<button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#defaultModalupdateaccesss" wire:click.prevent="DetailData({{ $datas->id_access }})"><i class="fas fa-fw fa-pen"></i></button>
						
						<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#defaultModalDangeraccesss{{ $datas->id_access }}delete"><i class="fas fa-fw fa-trash"></i></button>
					</td>
				</tr>
			@endforeach


		</tbody>
	</table>
	  </div>
	  <hr>
	  {{ $accesss->links() }}
	  </div>
	</div>

	<!-- ------------------------------------------------------------------------------------------------------ -->
	<!-- Tambah Data -->
<!-- Modal -->
<div wire:ignore.self class="modal fade" id="defaultModalaccesss" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Akses</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	 <!-- Form -->
        <form wire:submit.prevent="SaveData()">
        @if (session('pesan'))
			<div class="alert alert-success">
				{{session('pesan')}}
			</div>
		@endif

	  <select class="form-select" aria-label="Default select example" name="id_role" wire:model="id_role">
	    <option selected>--- Nama Role ---</option>
	    @foreach ($roles as $datak)
	    <option value="{{$datak->id_role}}">{{$datak->name_role}}</option>
	    @endforeach
	  </select>
	  <br>
	  <select class="form-select" aria-label="Default select example" name="id_nav" wire:model="id_nav">
	    <option selected>--- role Akses ---</option>
	    @foreach ($navbars as $datak)
	    <option value="{{$datak->id_nav}}">{{$datak->name_nav}}</option>
	    @endforeach
	  </select>
	  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" wire:submit.prevent="SaveData()">Create</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- Tambah Data -->
<!-- ------------------------------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------------------------------ -->
	<!-- Ubah Data -->
<!-- Modal -->
<div wire:ignore.self class="modal fade" id="defaultModalupdateaccesss" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-pen"></i> Ubah Akses</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click.prevent="clearform()"></button>
      </div>
      <div class="modal-body">
      	 <!-- Form -->
        <form wire:submit.prevent="UpdateData()">
        @if (session('pesan'))
			<div class="alert alert-success">
				{{session('pesan')}}
			</div>
		@endif

	  <select class="form-select" aria-label="Default select example" name="id_role" wire:model="id_role">
	    <option selected>--- Nama Role ---</option>
	    @foreach ($roles as $datak)
	    <option value="{{$datak->id_role}}">{{$datak->name_role}}</option>
	    @endforeach
	  </select>
	  <br>
	  <select class="form-select" aria-label="Default select example" name="id_nav" wire:model="id_nav">
	    <option selected>--- role Akses ---</option>
	    @foreach ($navbars as $datak)
	    <option value="{{$datak->id_nav}}">{{$datak->name_nav}}</option>
	    @endforeach
	  </select>
	  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click.prevent="clearform()">Close</button>
        <button type="submit" class="btn btn-warning" wire:submit.prevent="UpdateData()">Update</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- Ubah Data -->
<!-- ------------------------------------------------------------------------------------------------------ -->

	<!-- ------------------------------------------------------------------------------------------------------ -->
	<!-- Delete Data -->
<!-- Modal -->
@foreach ($accesss as $datas)
<div wire:ignore.self class="modal fade" id="defaultModalDangeraccesss{{ $datas->id_access }}delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-trash"></i> {{ $datas->name_role }} Akses {{ $datas->name_nav }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus data ini ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <button type="button" class="btn btn-danger" wire:click.prevent="DeleteData({{ $datas->id_access }})" data-bs-dismiss="modal">Ya</button>
      </div>
    </div>
  </div>
</div>
@endforeach

	<!-- Delete Data -->
<!-- ------------------------------------------------------------------------------------------------------ -->
</div>


