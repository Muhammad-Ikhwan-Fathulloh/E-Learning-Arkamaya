<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="card border-light mb-3 bg-ku">
	  <div class="card-body">
	  	<h3 class="text-dark"><strong>role</strong></h3>
	  	<div>
      <form class="d-flex" wire:poll>
      		<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalroles"> <strong class="text-white"><i class="fas fa-fw fa-plus"></i></strong></button>
          <input wire:model="search" class="form-control me-2 border-primary" type="text" name="search" placeholder="Cari berdasarkan Nama Role" aria-label="Search" value="">
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
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; ?>
			@foreach ($roles as $datas)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $datas->name_role }}</td>
					<td>
						<button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#defaultModalupdateroles" wire:click.prevent="DetailData({{ $datas->id_role }})"><i class="fas fa-fw fa-pen"></i></button>
						
						<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#defaultModalDangerroles{{ $datas->id_role }}delete"><i class="fas fa-fw fa-trash"></i></button>
					</td>
				</tr>
			@endforeach


		</tbody>
	</table>
	  </div>
	  <hr>
	  {{ $roles->links() }}
	  </div>
	</div>

	<!-- ------------------------------------------------------------------------------------------------------ -->
	<!-- Tambah Data -->
<!-- Modal -->
<div wire:ignore.self class="modal fade" id="defaultModalroles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah roles</h5>
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

	  <div class="form-group">
	    <label class="text-dark" for="">Nama Role</label>
	    <input type="text" name="name_role" wire:model="name_role" class="form-control" placeholder="Masukkan Nama Role">
	    @error('name_role') <div class="alert alert-danger">{{ $message }}</div> @enderror
	  </div>
	  
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
<div wire:ignore.self class="modal fade" id="defaultModalupdateroles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-pen"></i> Ubah role</h5>
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

	  <div class="form-group">
	    <label class="text-dark" for="">Nama Role</label>
	    <input type="text" name="name_role" wire:model="name_role" class="form-control" placeholder="Masukkan Nama Role">
	    @error('name_role') <div class="alert alert-danger">{{ $message }}</div> @enderror
	  </div>
	  
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
@foreach ($roles as $datas)
<div wire:ignore.self class="modal fade" id="defaultModalDangerroles{{ $datas->id_roles }}delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-trash"></i> {{ $datas->name_role }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus data ini ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <button type="button" class="btn btn-danger" wire:click.prevent="DeleteData({{ $datas->id_role }})" data-bs-dismiss="modal">Ya</button>
      </div>
    </div>
  </div>
</div>
@endforeach

	<!-- Delete Data -->
<!-- ------------------------------------------------------------------------------------------------------ -->
</div>


