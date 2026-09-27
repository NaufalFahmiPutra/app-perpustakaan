@extends('layouts.app')

@section('title', 'edit anggota')

@section('content')
	<h1>Edit Anggota</h1>
	<p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar anggota</a></p>

	<form action="{{ route('members.update', $members->id) }}" method="POST">
		@csrf
		@method('PUT')

		<label for="nama">Nama</label>
		<input type="text" name="nama" id="nama" value="{{ old('nama', $members->nama) }}">
		@error('nama')
			<div class="error">{{ $message }}</div>
		@enderror

		<label for="nim">NIM</label>
		<input type="text" name="nim" id="nim" value="{{ old('nim', $members->nim) }}">
		@error('nim')
			<div class="error">{{ $message }}</div>
		@enderror

		<label for="email">Email</label>
		<input type="email" name="email" id="email" value="{{ old('email', $members->email) }}">
		@error('email')
			<div class="error">{{ $message }}</div>
		@enderror

		<label for="nomor_telepon">Nomor Telepon</label>
		<input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $members->nomor_telepon) }}">
		@error('nomor_telepon')
			<div class="error">{{ $message }}</div>
		@enderror

		<label for="alamat">Alamat</label>
		<input name="alamat" id="alamat" value="{{ old('alamat', $members->alamat) }}">
		@error('alamat')
			<div class="error">{{ $message }}</div>
		@enderror

		<label for="status">Status</label>
		<select name="status" id="status">
			<option value="aktif" @selected(old('status', $members->status) === 'aktif')>Aktif</option>
			<option value="nonaktif" @selected(old('status', $members->status) === 'nonaktif')>Nonaktif</option>
		</select>
		@error('status')
			<div class="error">{{ $message }}</div>
		@enderror

		<button type="submit" class="btn">Perbarui</button>
	</form>
@endsection
