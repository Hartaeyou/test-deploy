@extends('layout.main')
@section('title', 'Tambah Data Kereta')
@section('content')
<h1 style="font-weight : bold; font-size : 22px"> Tambah Data Kereta</h1>
<hr class="mb-4">

    <form action="{{ route('kereta.store') }}" method="post">
        @csrf
        <div class="mb-3">
                    <label for="nama_kereta" style="font-weight : bold;  font-size : 15px; color : #6C6C6C" class="form-label">Nama Kereta</label>
                    <input type="text" class="form-control" name="nama_kereta" id="nama_kereta"  required>
                </div>
                <div class="mb-3">
                    <label for="kode_kereta" style="font-weight : bold;  font-size : 15px; color : #6C6C6C" class="form-label">Kode Kereta</label>
                    <input type="text" class="form-control" name="kode_kereta" id="kode_kereta"  required>
                </div>

                <div class="mb-3">
                    <label for="rute_id" style="font-weight : bold;  font-size : 15px; color : #6C6C6C" class="form-label">Pilih Rute</label>
                    <select class="form-select" aria-label="Default select example" name="rute_id" id="rute_id">
                        <option >Pilih Rute</option>
                        @foreach ($rutes as $rute)
                            <option value="{{ $rute->rute_id }}">
                                {{ $rute->rute_1 }} -  {{ $rute->rute_2 }}
                            </option>
                        @endforeach
                    </select>
                </div>
        <button class = "btn btn-md btn-orange" type="submit">Tambah Kereta</button>
    </form>
@endsection
