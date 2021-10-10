<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="card border-light mb-3 bg-ku">
	  <div class="card-body">
	  	<h3 class="text-dark"><strong>Navigasi</strong></h3>
	  	<div>
      <form class="d-flex" wire:poll>
          <input wire:model="search" class="form-control me-2 border-primary" type="text" name="search" placeholder="Cari berdasarkan Nama Navigasi" aria-label="Search" value="">
          <span class="btn btn-outline-primary" value="cari"><i class="fas fa-fw fa-search"></i></span>
        </form>
        <br>
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalnavbar"> <strong class="text-white">Tambah <i class="fas fa-fw fa-plus"></i></strong></button>
    </div>
    
    <br>
    
		<!-- Data -->
	  	<div class="table-responsive" wire:poll>
	<table class="table table">
		<thead class="table">
			<tr>
				<th>No</th>
				<th>Ikon Navigasi</th>
				<th>Nama Navigasi</th>
				<th>Tautan Navigasi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; ?>
			@foreach ($navbars as $datas)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $datas->icon_nav }}</td>
					<td>{{ $datas->name_nav }}</td>
					<td>{{ $datas->link_nav }}</td>
					<td>
						<button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#defaultModalupdatenavbar" wire:click.prevent="DetailData({{ $datas->id_navbar }})"><i class="fas fa-fw fa-pen"></i> Ubah</button>
						<hr>
						<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#defaultModalDangernavbar{{ $datas->id_navbar }}delete"><i class="fas fa-fw fa-trash"></i> Hapus</button>
					</td>
				</tr>
			@endforeach


		</tbody>
	</table>
	  </div>
	  <hr>
	  {{ $navbars->links() }}
	  </div>
	</div>

	<!-- ------------------------------------------------------------------------------------------------------ -->
	<!-- Tambah Data -->
<!-- Modal -->
<div wire:ignore.self class="modal fade" id="defaultModalnavbar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Navigasi</h5>
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
	    <label class="text-dark" for="">Ikon Navigasi</label>
	    <div class="row">
	    	<div class="col">
	    		<input type="text" name="icon_nav" wire:model="icon_nav" class="form-control" placeholder="Masukkan Ikon Navigasi">
	    	</div>
	    	<div class="col">
	    		<a href="https://feathericons.com/" class="btn btn-info"><strong class="text-white">Icon Feather</strong></a>
	    	</div>
	    </div>
	    @error('icon_nav') <div class="alert alert-danger">{{ $message }}</div> @enderror
	  </div>

	  <div class="form-group">
	    <label class="text-dark" for="">Nama Navigasi</label>
	    <input type="text" name="name_nav" wire:model="name_nav" class="form-control" placeholder="Masukkan Nama Navigasi">
	    @error('name_nav') <div class="alert alert-danger">{{ $message }}</div> @enderror
	  </div>

	  <div class="form-group">
	    <label class="text-dark" for="">Tautan Navigasi</label>
	    <input type="text" name="link_nav" wire:model="link_nav" class="form-control" placeholder="Masukkan Tautan Navigasi">
	    @error('link_nav') <div class="alert alert-danger">{{ $message }}</div> @enderror
	  </div>
	  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success" wire:submit.prevent="SaveData()">Buat</button>
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
<div wire:ignore.self class="modal fade" id="defaultModalupdatenavbar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-pen"></i> Ubah Navigasi</h5>
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
	    <label class="text-dark" for="">Ikon Navigasi</label>
	    <div class="row">
	    	<div class="col">
	    		<input type="text" name="icon_nav" wire:model="icon_nav" class="form-control" placeholder="Masukkan Ikon Navigasi">
	    	</div>
	    	<div class="col">
	    		<a href="https://feathericons.com/" class="btn btn-info"><strong class="text-white">Icon Feather</strong></a>
	    	</div>
	    </div>
	    @error('icon_nav') <div class="alert alert-danger">{{ $message }}</div> @enderror
	  </div>

	  <div class="form-group">
	    <label class="text-dark" for="">Nama Navigasi</label>
	    <input type="text" name="name_nav" wire:model="name_nav" class="form-control" placeholder="Masukkan Nama Navigasi">
	    @error('name_nav') <div class="alert alert-danger">{{ $message }}</div> @enderror
	  </div>

	  <div class="form-group">
	    <label class="text-dark" for="">Tautan Navigasi</label>
	    <input type="text" name="link_nav" wire:model="link_nav" class="form-control" placeholder="Masukkan Tautan Navigasi">
	    @error('link_nav') <div class="alert alert-danger">{{ $message }}</div> @enderror
	  </div>
	  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click.prevent="clearform()">Tutup</button>
        <button type="submit" class="btn btn-warning" wire:submit.prevent="UpdateData()">Ubah</button>
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
@foreach ($navbars as $datas)
<div wire:ignore.self class="modal fade" id="defaultModalDangernavbar{{ $datas->id_navbar }}delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-trash"></i> {{ $datas->name_nav }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus data ini ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <button type="button" class="btn btn-danger" wire:click.prevent="DeleteData({{ $datas->id_navbar }})" data-bs-dismiss="modal">Ya</button>
      </div>
    </div>
  </div>
</div>
@endforeach

	<!-- Delete Data -->
<!-- ------------------------------------------------------------------------------------------------------ -->

<script>
	window.livewire.on('defaultModalnavbar', ()=>{
		$('#defaultModalnavbar').modal('hide');
	});

	window.livewire.on('defaultModalupdatenavbar', ()=>{
		$('#defaultModalupdatenavbar').modal('hide');
	});
</script>
</div>


