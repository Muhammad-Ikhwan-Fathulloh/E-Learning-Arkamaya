<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="card border-light mb-3 bg-ku">
	  <div class="card-body">
	  	<div>
      <form class="d-flex" wire:poll>
          <input wire:model="search" class="form-control me-2 border-primary" type="text" name="search" placeholder="Cari berdasarkan Nama" aria-label="Search" value="">
          <span class="btn btn-outline-primary" value="cari"><i class="fas fa-fw fa-search"></i></span>
        </form>
    </div>
    <br>
	  
		<hr>
		<!-- Data -->
	  	<div class="table-responsive" wire:poll>
	<table class="table table">
		<thead class="table">
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Email</th>
				<th>Role</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; ?>
			@foreach ($users as $datas)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $datas->name }}</td>
					<td>{{ $datas->email }}</td>
					<td>
						  @if($datas->role == 1)
						  <p class="btn btn-danger text-white">Super Admin</p>
						  @elseif($datas->role == 2)
						  <p class="btn btn-warning text-white">Admin</p>
						  @elseif($datas->role == 3)
						  <p class="btn btn-success text-white">User</p>
						  @endif
					<!-- </td>
					<td> -->
						<div class="form-check form-switch" align="right">

						  @if($datas->role == 3)
						  <input class="form-check-input border-info" type="checkbox" name="model" id="mode1" wire:click.prevent="rolek({{ $datas->id_user }})">
						  
						  @elseif($datas->role == 2)
						  <input class="form-check-input border-info" type="checkbox" name="model" id="mode1" wire:click.prevent="rolek({{ $datas->id_user }})" checked>

						  @elseif($datas->role == 1)
						  <!-- <span>Super Admin</span> -->
						  @endif
						  
						</div>
					</td>
					<td>
						@if($datas->role == 1)
						  <span>Super Admin</span>
						@else
						@if($datas->status == 1)
						  <p class="btn btn-danger text-white">Active</p>
						@elseif($datas->status == 0)
						  <p class="btn btn-warning text-white">Passive</p>
						@endif
						<div class="form-check form-switch" align="right">
						  @if($datas->status == 0)
						  <input class="form-check-input border-info" type="checkbox" name="model" id="mode1" wire:click.prevent="statusk({{ $datas->id_user }})">
						  
						  @elseif($datas->status == 1)
						  <input class="form-check-input border-info" type="checkbox" name="model" id="mode1" wire:click.prevent="statusk({{ $datas->id_user }})" checked>

						  @endif
						</div>
						@endif
					</td>
					<td>
						@if($datas->role == 1)
						<span>Super Admin</span>
						@else
						<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#defaultModalDanger{{ $datas->id_user }}"><i class="fas fa-fw fa-trash"></i></button>
						@endif
					</td>
				</tr>
			@endforeach


		</tbody>
	</table>
	  </div>
	  <hr>
	  {{ $users->links() }}
	  </div>
	</div>

	<!-- ------------------------------------------------------------------------------------------------------ -->
	<!-- Hapus Data -->
<!-- Modal -->
@foreach ($users as $datas)
<div wire:ignore.self class="modal fade" id="defaultModalDanger{{ $datas->id_user }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-trash"></i> {{ $datas->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus data ini ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-danger" wire:click.prevent="deleteData({{ $datas->id_user }})" data-bs-dismiss="modal">Ya</button>
      </div>
    </div>
  </div>
</div>
@endforeach

	<!-- Hapus Data -->
<!-- ------------------------------------------------------------------------------------------------------ -->
</div>
