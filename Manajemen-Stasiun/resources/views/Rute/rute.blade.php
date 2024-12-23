@extends('layout.main')
@section('title', 'Daftar Rute')
@section('content')

<style>
    /* Tabel Utama */
    #ruteTable {
        border-spacing: 0 20px;
        border-collapse: separate;
        width: 100%;
    }

    #ruteTable thead th {
        padding: 15px 10px;
        text-align: center;
        border: none;
        background-color: #F0F0F0 !important;
        color: #ACACAC !important;
        font-size: 15px;
    }

    #ruteTable tbody tr {
        height: 85px;
        background-color: #000000;
    }

    #ruteTable td {
        padding: 15px 10px;
        text-align: center;
        vertical-align: middle;
        color: black;
        font-size: 17px;
    }

</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <h3>Daftar Rute</h3>
            <hr>
        </div>
        <div class="col-md-2">
            <a href="{{ route('formCreateRute') }}" class="btn btn-orange btn-md" style="margin-top: 20px;">Tambah Rute</a>
        </div>
    </div>

    <!-- Table -->
    <table id="ruteTable" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Rute</th>
                <th>Jumlah Stasiun</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rutes as $rute)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $rute->rute_1 }} - {{ $rute->rute_2 }}</td>
                <td>{{ $rute->points->count() }}</td>
                <td>
                    @include('Rute.Components.modal')
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $rutes->links() }}
    </div>
</div>

<!-- Bootstrap JS dan Popper.js -->
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
