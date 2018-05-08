<!DOCTYPE html>
<html>
<head>
	<title>Users </title>
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
	<div class="col-md-6">
		@if($errors)
            @foreach($errors->all() as $error)
                <small style="color:red">{{ $error }}</small><br/>
            @endforeach
        @endif
        @if(session()->has('message'))
            <h2 style="color:green">{{ session()->get('message') }}</h2><br/>
        @endif
		<form method="post" action="{{ route('create') }}">
			{{ csrf_field() }}
			<table class="table">
				<tr>
					<td>ID</td>
					<td><input type="text" name="id" placeholder="98a79d8a9af9a879fa" disabled class="form-control"></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td><input type="text" name="name" placeholder="Masukkan Nama..." class="form-control"></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><input type="text" name="alamat" placeholder="Masukkan Alamat..." class="form-control"></td>
				</tr>
				<tr>
					<td><button type="submit">Submit</button></td>
				</tr>
			</table>
		</form>

		<h2>Daftar User</h2>
		<table style="margin-top: 10px;" class="table">
			<thead>
				<td>ID Customer</td>
				<td>Nama</td>
				<td>Alamat</td>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->alamat }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>