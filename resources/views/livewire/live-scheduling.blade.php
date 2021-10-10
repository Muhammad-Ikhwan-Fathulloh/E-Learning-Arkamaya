<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="card border-light mb-3 bg-ku">
	  <div class="card-body">
	  	<h3 class="text-dark"><strong>Aktivitas</strong></h3>
	  	<div>
      <form class="d-flex" wire:poll>
      		
          <input wire:model="search" class="form-control me-2 border-primary" type="text" name="search" placeholder="Cari berdasarkan Nama" aria-label="Search" value="">
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
				<th>Nama Mentor</th>
				<th>Judul Materi</th>
				<th>Kategori Materi</th>
				<th>Tanggal</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; ?>
			@foreach ($schedules as $datas)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $datas->id_material }}</td>
					<td>{{ $datas->id_mentor }}</td>
					<td>{{ $datas->start_date }}</td>
					<td>{{ $datas->finish_date }}</td>
					<td>{{ $datas->publish }}</td>
					<td>
						<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#defaultModalDangerschedules{{ $datas->id_schedule }}delete"><i class="fas fa-fw fa-trash"></i></button>
					</td>
				</tr>
			@endforeach


		</tbody>
	</table>
	  </div>
	  <hr>
	  {{ $schedules->links() }}
	  </div>
	</div>

	<!-- ------------------------------------------------------------------------------------------------------ -->
	<!-- Delete Data -->
<!-- Modal -->
@foreach ($schedules as $datas)
<div wire:ignore.self class="modal fade" id="defaultModalDangerschedules{{ $datas->id_schedule }}delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-trash"></i> {{ $datas->id_material }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus data ini ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <button type="button" class="btn btn-danger" wire:click.prevent="DeleteData({{ $datas->id_schedule }})" data-bs-dismiss="modal">Ya</button>
      </div>
    </div>
  </div>
</div>
@endforeach

	<!-- Delete Data -->
<!-- ------------------------------------------------------------------------------------------------------ -->
</div>


