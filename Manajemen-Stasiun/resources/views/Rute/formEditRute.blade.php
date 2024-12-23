@extends('layout.main')
@section('title', 'Ubah Data Rute')
@section('css')
    <link rel="stylesheet" href="{{ URL('css/stationInfo.css') }}">
@endsection
@section('content')
<div class="container-fluid">
    <h1>Edit Rute: {{ $rute->rute_1 }} - {{ $rute->rute_2 }}</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="rute_1" class="form-label">Rute Awal</label>
                <input type="text" class="form-control" id="rute_1" name="rute_1" value="{{ $rute->rute_1 }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="rute_2" class="form-label">Rute Akhir</label>
                <input type="text" class="form-control" id="rute_2" name="rute_2" value="{{ $rute->rute_2 }}">
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="new_point" class="form-label">Tambah Stasiun</label>
        <select id="new_point" class="form-control">
            <option value="">Pilih Stasiun</option>
            @foreach ($availablePoints as $point)
                <option value="{{ $point->point_id }}">{{ $point->nama }}</option>
            @endforeach
        </select>
        <button type="button" id="add-point" class="btn btn-sm btn-secondary mt-2">Tambah</button>
    </div>

    <h3>Point (Stasiun) dalam Rute</h3>
    <table class="table table-bordered" id="points-table">
        <thead>
            <tr>
                <th>Id Point</th>
                <th>Nama Point</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rute->points as $point)
                <tr data-index="{{ $loop->index }}" data-id="{{ $point->point_id }}">
                    <td>{{ $point->point_id }}</td>
                    <td>{{ $point->nama }}</td>
                        <input type="hidden" class="form-control sequence-input" value="{{ $point->pivot->sequence }}" readonly>
                    <td>
                        <div class="move-buttons d-flex justify-content-center">
                            <button type="button" class="me-3 btn btn-sm btn-secondary move-up">
                                <i class="fa-solid fa-arrow-up"></i>
                            </button>
                            <button type="button" class="me-3 btn btn-sm btn-secondary move-down">
                                <i class="fa-solid fa-arrow-down"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger delete-point">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <button id="save-button" class="btn btn-primary">Simpan</button>
    <a href="{{ route('rute.index') }}" class="btn btn-secondary">Batal</a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tableBody = document.querySelector('#points-table tbody');
        const saveButton = document.getElementById('save-button');
        const namaRuteInput1 = document.getElementById('rute_1');
        const namaRuteInput2 = document.getElementById('rute_2');
        const newPointSelect = document.getElementById('new_point');
        const addPointButton = document.getElementById('add-point');

        // Fungsi untuk memperbarui urutan
        function updateSequence() {
            const rows = tableBody.querySelectorAll('tr');
            rows.forEach((row, index) => {
                const sequenceInput = row.querySelector('.sequence-input');
                sequenceInput.value = index + 1; // Perbarui urutan sesuai posisi
            });
        }

        // Tambah stasiun baru ke tabel
        addPointButton.addEventListener('click', () => {
            const selectedPointId = newPointSelect.value;
            const selectedPointName = newPointSelect.options[newPointSelect.selectedIndex].text;

            if (!selectedPointId) {
                alert('Pilih stasiun terlebih dahulu!');
                return;
            }

            // Tambahkan baris baru ke tabel
            const newRow = document.createElement('tr');
            newRow.setAttribute('data-id', selectedPointId);
            newRow.innerHTML = `
                <td>${selectedPointId}</td>
                <td>${selectedPointName}</td>
                <input type="hidden" class="form-control sequence-input" value="" readonly>
                <td>
                    <div class="d-flex justify-content-center">
                        <div class="move-buttons">
                            <button type="button" class="me-3 btn btn-sm btn-secondary move-up">
                                <i class="fa-solid fa-arrow-up"></i>
                            </button>
                            <button type="button" class="me-3 btn btn-sm btn-secondary move-down">
                                <i class="fa-solid fa-arrow-down"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger delete-point">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </td>
            `;
            tableBody.appendChild(newRow);

            // Perbarui urutan
            updateSequence();

            // Hapus stasiun dari dropdown
            newPointSelect.querySelector(`option[value="${selectedPointId}"]`).remove();
        });

        // Fungsi untuk menukar urutan
        function swapRows(row1, row2) {
            const sibling = row2.nextSibling;
            tableBody.insertBefore(row2, row1);
            tableBody.insertBefore(row1, sibling);
            updateSequence();
        }

        // Event listener tombol Naik
        tableBody.addEventListener('click', (e) => {
            if (e.target.classList.contains('move-up')) {
                const row = e.target.closest('tr');
                const previousRow = row.previousElementSibling;
                if (previousRow) {
                    swapRows(previousRow, row);
                }
            }
        });

        // Event listener tombol Turun
        tableBody.addEventListener('click', (e) => {
            if (e.target.classList.contains('move-down')) {
                const row = e.target.closest('tr');
                const nextRow = row.nextElementSibling;
                if (nextRow) {
                    swapRows(row, nextRow);
                }
            }
        });

        // Event listener tombol Hapus
        tableBody.addEventListener('click', (e) => {
            if (e.target.classList.contains('delete-point')) {
                const row = e.target.closest('tr');
                const pointId = row.getAttribute('data-id');

                // Tambahkan kembali ke dropdown
                const pointName = row.querySelector('td:first-child').textContent;
                const option = document.createElement('option');
                option.value = pointId;
                option.textContent = pointName;
                newPointSelect.appendChild(option);

                // Hapus baris
                row.remove();

                // Perbarui urutan
                updateSequence();
            }
        });

        // Event listener untuk tombol Simpan
        saveButton.addEventListener('click', async () => {
            // SweetAlert konfirmasi
            Swal.fire({
                title: 'Konfirmasi Simpan',
                text: 'Apakah Anda yakin ingin menyimpan perubahan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const rows = tableBody.querySelectorAll('tr');
                    const points = [];
                    rows.forEach((row) => {
                        const pointId = row.getAttribute('data-id');
                        const sequence = row.querySelector('.sequence-input').value;
                        points.push({ id: pointId, sequence });
                    });

                    // Data yang akan dikirim
                    const data = {
                        rute_1: namaRuteInput1.value,
                        rute_2: namaRuteInput2.value,
                        points: points
                    };

                    try {
                        // Kirim data ke backend menggunakan Fetch API
                        const response = await fetch("{{ route('rute.update', $rute->rute_id) }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify(data),
                        });

                        if (response.ok) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Data berhasil disimpan!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = "{{ route('rute.index') }}"; // Redirect setelah berhasil
                            });
                        } else {
                            const errorData = await response.json();
                            Swal.fire('Gagal', errorData.message || 'Terjadi kesalahan. Silakan coba lagi.', 'error');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        Swal.fire('Gagal', 'Terjadi kesalahan. Silakan coba lagi.', 'error');
                    }
                }
            });
        });
    });

</script>
@endsection
