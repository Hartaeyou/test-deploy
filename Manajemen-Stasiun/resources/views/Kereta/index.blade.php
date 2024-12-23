@extends('layout.main')
@section('title', 'Daftar Kereta')
@section('content')

<style>
    /* Tabel Utama */
    table {
        border-spacing: 0 20px; /* Jarak antar baris */
        border-collapse: separate; /* Memastikan border-spacing bekerja */
        width: 100%;
    }


    table thead th {
        padding: 15px 10px; /* Padding di header */
        text-align: center;
        border: none; /* Hilangkan border */
        background-color: #F0F0F0 !important; /* Transparan hitam */
        color: #ACACAC !important;
        font-size: 15px;
    }


    /* Styling untuk tbody */
    table tbody tr {
        height: 85px; /* Tinggi baris */
        background-color: #000000; /* Latar belakang hitam */
    }

    table td {
        padding: 15px 10px; /* Padding dalam sel */
        text-align: center; /* Teks di tengah horizontal */
        vertical-align: middle; /* Teks di tengah vertikal */
        color: #ffffff; /* Warna teks putih */
        font-size: 17px;
    }

    
</style>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <h3>Daftar Kereta</h3>
            <hr>
        </div>
        <div class="col-md-2">
            <a href="{{ route('kereta.create') }}" class="btn btn-orange btn-md" style="margin-top: 20px;">Tambah Kereta</a>
        </div>
    </div>

    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kereta</th>
                <th>Kode</th>
                <th>Rute</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($keretas as $index => $kereta)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $kereta->nama_kereta }}</td>
                <td>{{ $kereta->kode_kereta }}</td>
                <td>{{ $kereta->rute ? $kereta->rute->rute_1 : '-' }} - {{ $kereta->rute ? $kereta->rute->rute_2 : '-' }}</td>
                <td>
                    <a type="button" class="btn btn-sm" style="color: #EE6B23" href="{{ route('kereta.edit', $kereta->kereta_id) }}"><i class="fa fa-pencil"></i></a>
                    <a type="button" class="btn btn-sm delete-button" style="color: #EE6B23" href="{{ route('kereta.delete', $kereta->kereta_id) }}" ><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{ $keretas->links() }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                // Ambil URL dari atribut href pada tombol
                const deleteUrl = this.getAttribute('href');

                // SweetAlert untuk konfirmasi
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke URL jika user menekan 'Ya, hapus!'
                        window.location.href = deleteUrl;
                    }
                });
            });
        });
    });
</script>
@endsection
