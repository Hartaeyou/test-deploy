@extends('layout.main')
@section('title', 'Ubah Data Stasiun')
@section('content')
<div class="container-fluid">
    <h1 style="font-weight : bold; font-size : 22px">Ubah Data Stasiun {{ $updateForm->nama }}</h1>
    <form action="{{ route('updateStasiun', ['id' => $updateForm->point_id]) }}" method="post">
        @csrf
        <div class="mb-3 mt-5">
            <label for="Name" style="font-weight : bold;  font-size : 15px; color : #6C6C6C" class="form-label">Nama</label>
            <input type="text" class="form-control" name="Name" id="Name" aria-describedby="emailHelp" value="{{ $updateForm->nama }}">
        </div>

        <div class="mb-3">
            <label for="Longitude" style="font-weight : bold;  font-size : 15px; color : #6C6C6C" class="form-label">Longitude</label>
            <input type="text" class="form-control" name="Longitude" id="Longitude" aria-describedby="emailHelp" value="{{ $updateForm->longitude }}">
        </div>
        
        <div class="mb-3">
            <label for="Latitude" style="font-weight : bold; font-size : 15px; color : #6C6C6C" class="form-label">Latitude</label>
            <input type="text" class="form-control" name="Latitude" id="Latitude" aria-describedby="emailHelp" value="{{ $updateForm->latitude }}">
        </div>

        <div class="d-flex justify-content-end mt-2">
            <button type="submit" class="btn btn-md submit-button" style="background-color : #EE6B23; color : white">Submit</button>
        </div>    
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const submiButton = document.querySelectorAll('.submit-button');

        submiButton.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                // Ambil form yang sesuai
                const form = this.closest('form');

                // SweetAlert untuk konfirmasi
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Apakah anda ingin mengubah data Stasiun {{ $updateForm->nama }}?",
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
</script>
@endsection