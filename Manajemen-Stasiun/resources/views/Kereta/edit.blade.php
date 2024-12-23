@extends('layout.main')
@section('css')
    <link rel="stylesheet" href="{{ URL('css/stationInfo.css') }}">
@endsection
@section('title', 'Ubah Data Kereta')
@section('content')

    <h1 style="font-weight : bold; font-size : 22px">Ubah Data Kereta {{ $kereta->nama_kereta }}</h1>
    <hr>

    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('kereta.update', $kereta->kereta_id) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nama_kereta" style="font-weight : bold;  font-size : 15px; color : #6C6C6C" class="form-label">Nama Kereta</label>
                    <input type="text" class="form-control" name="nama_kereta" id="nama_kereta" value="{{ $kereta->nama_kereta }}" required>
                </div>
                <div class="mb-3">
                    <label for="kode_kereta" style="font-weight : bold;  font-size : 15px; color : #6C6C6C" class="form-label">Kode Kereta</label>
                    <input type="text" class="form-control" name="kode_kereta" id="kode_kereta" value="{{ $kereta->kode_kereta }}" required>
                </div>

                <div class="mb-3">
                    <label for="rute_id" style="font-weight : bold;  font-size : 15px; color : #6C6C6C" class="form-label">Pilih Rute</label>
                    <select class="form-select" aria-label="Default select example" name="rute_id" id="rute_id">
                        @if($kereta->rute)
                        <option value="{{ $kereta->rute_id }}">{{$kereta->rute->rute_1}} - {{$kereta->rute->rute_2}}</option>
                        @else
                        <option value="">Pilih Rute</option>
                        @endif
                        @foreach ($rutes as $rute)
                            <option value="{{ $rute->rute_id }}" {{ $kereta->rute_id == $rute->id ? 'selected' : '' }}>
                                {{ $rute->rute_1 }} - {{ $rute->rute_2 }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button class = "btn btn-md btn-orange" type="submit">Perbarui</button>
            </form>
        </div>

        <div class="col-md-4">
            <h4 class="text-center">Stasiun Pemberhentian Saat Ini</h4>

            <div class="station-timeline">
                <div class="d-flex justify-content-center align-items-center">
                @if ($kereta->rute && $kereta->rute->points->count())
                    <ul class="timeline">
                    @foreach ($kereta->rute->points as $point)
                    <li class="timeline-item active ">
                        <div class="circle">{{ $point->pivot->sequence }}</div>
                        <div class="station-name fw-bold"><span class="fw-bold">{{ $point->nama }}</span></div>
                    </li>
                    @endforeach
                    </ul>
                @else
                <p>Tidak ada point untuk rute ini.</p>
                @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const submitButton = form.querySelector('button[type="submit"]');

            submitButton.addEventListener('click', function (e) {
                e.preventDefault(); // Mencegah submit default

                // SweetAlert untuk konfirmasi
                Swal.fire({
                    title: 'Konfirmasi Edit',
                    text: 'Apakah Anda yakin ingin memperbarui data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, perbarui!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form jika user menekan 'Ya, perbarui!'
                        form.submit();
                    }
                });
            });
        });
    </script>

@endsection

