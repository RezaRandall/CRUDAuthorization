<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Talentytica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<!-- JQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

	<!-- Font Awesome -->
	<script src="https://kit.fontawesome.com/07befcf964.js" crossorigin="anonymous"></script>

	<!-- external JS -->
	<script type="text/javascript" src="{{ asset('asset/js/common.js')}}"></script>

	<!-- external css -->
	<link href="{{ asset('asset/css/common.css')}}" rel="stylesheet" type="text/css" />

  </head>
  <body>
	<!-- NAVBAR -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-light gradient-custom">
		<div class="container">
		<h3 class="pt-1 mb-1" style="color: #FFFFFF !important;">Talentytica</h3>
			<ul class="navbar-nav ms-auto">
			@auth
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #FFFFFF !important;">
					  Welcome, {{ auth()->user()->name }}
				  </a>
				  <ul class="dropdown-menu">
					  <li>
						<form action="/logout" method="POST">
							@csrf
							<button type="submit" class="dropdown-item">
								<i class="fa-solid fa-right-from-bracket"></i>
								Logout
							</button>
						</form>
					</li>							
				  </ul>
				</li>
			@else
				<li class="nav-item">
					<a href="/" class="nav-link" role="button" >
						<i class="bi bi-box-arrow-in-right"></i>Login
					</a>
				</li>
			@endauth
			</ul>
		</div>
	</nav>

	<!-- Hearder Table Show -->
	<div class="container mt-2">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row pt-1 mb-1">
						<div class="col-auto pt-1 mb-1">
							<h5 class="float-start">Manage Peserta</h5>							
							@can('admin')
							<h6 class="sidebar-heading justify-content-between align-items-center">
								<span>Administrator</span>
							</h6>
							@endcan
						</div>						
						@can('admin')
						<div class="col-auto ms-auto mt-3">
							<button type="button" class="btn btn-success" id="add" data-bs-toggle="modal" data-bs-target="#addPesertaModal">
								<i class="fa-solid fa-user-plus"></i> 
								<span>Add New Peserta</span>
							</button>
						</div>
						@endcannot
					</div>
				</div>
				<table class="table table-bordered text-black mb-0 table-hover">
					<thead class="text-center">
						<tr>
							<th rowspan="2" class="align-middle">Name</th>
							<th rowspan="2" class="align-middle">Email</th>
							<th colspan="4" class="align-middle">Nilai</th>
							<th rowspan="2" class="align-middle">Action</th>
						</tr>
                        <tr>
                            <th>X</th>
                            <th>Y</th>
                            <th>Z</th>
                            <th>W</th>
                        </tr>
					</thead>
                    @foreach($pes as $ps)
					<tbody>
						<tr>
							<td>{{ $ps->nama }}</td>
							<td>{{ $ps->email }}</td>
							<td>{{ $ps->xVal }}</td>
							<td>{{ $ps->yVal }}</td>
							<td>{{ $ps->zVal }}</td>
							<td>{{ $ps->wVal }}</td>
							<td class="text-center">
								<a data-toggle="modal" id="info" data-id='{{ $ps->id }}'>
									@csrf
									@method('GET')
									<i class="fa-solid fa-circle-info fa-xl px-2" style="color: #ff0000;"></i>
								</a>								
								@can('admin')
                                <a data-toggle="modal" id="edit" data-id='{{ $ps->id }}'>
									<i class="fa-regular fa-pen-to-square fa-xl px-2" style="color: #93b635;"></i>
								</a>
								@endcan								
								@can('admin')
								<a href="/nilaiPeserta/{{$ps->id}}" >
									@csrf
									@method('DELETE')
									<i class="fa-solid fa-trash-can fa-xl px-2" type="submit" onclick="return confirm('Are you sure you want to delete this item?');"></i>
								</a> 
								@endcan
							</td>
						</tr>
					</tbody>
                    @endforeach
				</table>
				<div class="clearfix">
                    <div class="hint-text">Showing <b>{{ $pes->perPage() }}</b> out of <b>{{ $pes->total() }}</b> entries</div>
                    <div class="d-flex justify-content-end">
                        {!! $pes->links() !!}
                    </div>
                </div>
			</div>
		</div>
	</div>

	<!-- Add Modal Peserta -->
	<div class="modal fade" id="addPesertaModal" tabindex="-1" aria-labelledby="addModalLable" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form action="{{ route('nilaiPeserta.store') }}" method="POST" id="addPesertaForm">
				@csrf
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Add Peserta</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control nama {{ $errors->has('nama') ? 'is-invalid' : '' }}" name="nama" 
							value="{{old('nama')}}" autofocus required>
							<div class="alert errorName" style="color:red;display:none"></div>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control email {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" 
							value="{{old('email')}}" autofocus required> 
							<div class="alert emailError" style="color:red;display:none"></div>
						</div>
						<div class="form-group">
							<div class="row md-form mb-5">
								<div class="col-md-6">
									<label>Nilai X</label>
									<input id="xVal" type="number" class="form-control" name="xVal"  data-toggle="tooltip" data-placement="top" title="Nilai X range 1 - 33" required>
								</div>
								<div class="col-md-6">
									<label>Nilai Y</label>
									<input id="yVal" type="number" class="form-control" name="yVal"  data-toggle="tooltip" data-placement="top" title="Nilai X range 1 - 23" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row md-form mb-5">
								<div class="col-md-6">
									<label>Nilai Z</label>
									<input id="zVal" type="number" class="form-control" name="zVal"  data-toggle="tooltip" data-placement="top" title="Nilai X range 1 - 18" required>
								</div>
								<div class="col-md-6">
									<label>Nilai W</label>
									<input id="wVal" type="number" class="form-control" name="wVal"  data-toggle="tooltip" data-placement="top" title="Nilai X range 1 - 13" required>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary submitBtn" id="saveChangesBtn">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Info Peserta Modal -->
	<div class="modal fade" id="infoPesertaModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="infoModalLabel">Info Peserta</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div>
							<label>Name</label>
						</div>
						<div>
							<input  id="infoName" name="nama"  type="text" class="form-control" required readonly>
						</div>
					</div>
					<div class="form-group">
						<div>
							<label>Email</label>
						</div>
						<div>
							<input  id="infoEmail" name="email" type="email" class="form-control" required readonly>
						</div>
					</div>
					<div class="form-group" hidden>
						<div>
							<label>Intelegensi</label>
						</div>
						<div>
							<input  id="infoIntelegensi" name="intelegensi" type="text" class="form-control" required readonly>
						</div>
					</div>
					<div class="form-group" hidden>
						<div>
							<label>Ability</label>
						</div>
						<div>
							<input id="infoNumerical" name="numerical" type="text" class="form-control" required readonly>
						</div>
					</div>
					<div class="form-group mt-2">
						<table class="table table-bordered border-primary" id="tableInfo">
							<thead>
								<tr>
									<th scope="col" class="bg-success text-white w-25">Aspek</th>
									<th scope="col" id='id1'>1</th>
									<th scope="col"	id='id2'>2</th>
									<th scope="col"	id='id3'>3</th>
									<th scope="col"	id='id4'>4</th>
									<th scope="col"	id='id5'>5</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row" class="bg-success text-dark bg-opacity-25">Aspek Intelegensi</th>
									<td id="intelegensi1"></td>
									<td id="intelegensi2"></td>
									<td id="intelegensi3"></td>
									<td id="intelegensi4"></td>
									<td id="intelegensi5"></td>
								</tr>
								<tr>
									<th scope="row" class="bg-success text-dark bg-opacity-25">Aspek Numerical Ability</th>
									<td id="numerical1"></td>
									<td id="numerical2"></td>
									<td id="numerical3"></td>
									<td id="numerical4"></td>
									<td id="numerical5"></td>
								</tr>
							</tbody>
						</table>
    	            </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Edit Peserta Modal -->
	<div class="modal fade" id="editPesertaModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form id="update-user-form" action="{{ route('nilaiPeserta.update', $ps->id) }}" method="POST"> <!-- nilaiPeserta/update/{{ $ps->id }} -->
				@csrf
				@method('PUT')
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="editModalLabel">Edit Peserta</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input  id="id" name="id" type="hidden" class="form-control" readonly >
							<input type="text" class="form-control namaEdit" name="nama" id="nama" required >
							<span class="errorName" style="color:red;display:none;">Nama harus memiliki minimal 3 karakter</span>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control emailEdit" name="email" id="email" required >
							<span class="emailError" style="color:red;display:none;">Email tidak valid</span>
						</div>
						<div class="form-group">
							<div class="row md-form mb-5">
								<div class="col-md-6">
									<label>Nilai X</label>
									<input id="xVal" type="number" class="form-control" name="xVal"  data-toggle="tooltip" data-placement="top" title="Nilai X range 1 - 33" required>
								</div>
								<div class="col-md-6">
									<label>Nilai Y</label>
									<input id="yVal" name="yVal" type="number" class="form-control" required data-toggle="tooltip" data-placement="top" title="Nilai X range 1 - 23" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row md-form mb-5">
								<div class="col-md-6">
									<label>Nilai Z</label>
									<input id="zVal" name="zVal"  type="number" class="form-control" required data-toggle="tooltip" data-placement="top" title="Nilai X range 1 - 18" required>
								</div>
								<div class="col-md-6">
									<label>Nilai W</label>
									<input id="wVal" name="wVal"  type="number" class="form-control" required data-toggle="tooltip" data-placement="top" title="Nilai X range 1 - 13" required>
								</div>
							</div>
						</div>
						<div class="form-group" hidden>
							<div class="row md-form mb-5">
								<div class="col-md-6">
									<label>Intelegensi</label>
									<input id="intelegensiVal" name="intelegensiVal"  type="number" class="form-control" required data-placement="top" readonly>
								</div>
								<div class="col-md-6">
									<label>Numerical</label>
									<input id="numericalVal" name="numericalVal"  type="number" class="form-control" required  data-placement="top" readonly>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary submitBtnEdit">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

  </body>
</html>