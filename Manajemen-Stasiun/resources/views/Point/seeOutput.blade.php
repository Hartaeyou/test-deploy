@extends('layout.main')
@section('title', 'Daftar Stasiun')
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

<div class="container-fluid ">

    <div class="row">
        <div class="col-md-10">
            <h3>Daftar Stasiun</h3>
            <hr>
        </div>

        <div class="col-md-2 content-end">
            <a href="{{ route('formInputStasiun') }}" class="btn btn-orange btn-md" style="margin-top: 20px;">Tambah Stasiun</a>
        </div>
    
    </div>

    <table class="table">
        <!-- Header -->
        <thead>
            <tr>
                <th>Id Stasiun</th>
                <th>Nama</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
        </thead>
        <!-- Body -->
        <tbody>
            @foreach ($points as $key => $point)
            <tr>
                <td>{{ $point->point_id }}</td>
                <td>{{ $point->nama }}</td>
                <td>{{ $point->latitude }}</td>
                <td>{{ $point->longitude }}</td>
                <td class="text-center">
                    <!-- Edit Button -->
                    <a href="{{ route('formUpdateStasiun', $point->point_id) }}" style="color: #EE6B23"class="btn btn-sm">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <!-- Delete Button -->
                    <form action="{{ route('deleteStasiun', $point->point_id) }}" method="post" style="display:inline;" class="delete-form">
                        @csrf
                        <button style="color: #EE6B23" type="button" class="btn btn-sm delete-button">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{ $points->links() }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                // Ambil form yang sesuai
                const form = this.closest('form');

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
                        // Submit form jika user menekan 'Ya, hapus!'
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@endsection
