@extends('layout.main')
@section('title', 'Tambah Data Rute')
@section('content')
<div class="container-fluid">
    <h1>Buat Rute Baru</h1>

    <!-- Input untuk Nama Rute -->
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="rute_1" class="form-label">Rute Awal</label>
                <input type="text" class="form-control" id="rute_1" name="rute_1">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="rute_2" class="form-label">Rute Akhir</label>
                <input type="text" class="form-control" id="rute_2" name="rute_2" >
            </div>
        </div>
    </div>

    <!-- Daftar Point -->
    <h3>Point (Stasiun)</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Point</th>
                <th>latitude</th>
                <th>longitude</th>
                <th>Urutan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($points as $point)
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input point-checkbox" id="point_{{ $point->point_id }}" value="{{ $point->point_id }}">
                            <label class="form-check-label" for="point_{{ $point->point_id }}">{{ $point->nama }}</label>
                        </div>
                    </td>
                    <td>
                        {{$point->latitude}}
                    </td>
                    <td>
                        {{$point->longitude}}
                    </td>

                    <td>
                        <input type="number" class="form-control point-sequence" id="sequence_{{ $point->point_id }}" min="1" disabled>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button id="submit-button" class="btn btn-orange">Simpan</button>
    <a href="{{ route('rute.index') }}" class="btn btn-secondary">Batal</a>
</div>

<!-- JavaScript -->
<script>
    const checkboxes = document.querySelectorAll('.point-checkbox');

    // Fungsi untuk mengatur max urutan berdasarkan jumlah checkbox yang dicentang
    function updateSequenceLimits() {
        const checkedCheckboxes = document.querySelectorAll('.point-checkbox:checked');
        const checkedCount = checkedCheckboxes.length;

        // Update atribut max di setiap input urutan
        checkboxes.forEach(checkbox => {
            const sequenceInput = document.getElementById(`sequence_${checkbox.value}`);
            if (checkbox.checked) {
                sequenceInput.max = checkedCount; // Tetapkan max sesuai jumlah yang dicentang
            } else {
                sequenceInput.max = ''; // Kosongkan max jika tidak dicentang
            }
        });
    }

    // Event listener untuk setiap checkbox
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const sequenceInput = document.getElementById(`sequence_${this.value}`);
            if (this.checked) {
                sequenceInput.disabled = false; // Aktifkan input urutan
                sequenceInput.value = ''; // Kosongkan nilai input
            } else {
                sequenceInput.disabled = true;  // Nonaktifkan input urutan
                sequenceInput.value = '';       // Kosongkan nilai input
            }
            updateSequenceLimits(); // Update batas max setelah checkbox berubah
        });
    });

    // Submit Button Logic
    document.getElementById('submit-button').addEventListener('click', async function (e) {
        e.preventDefault();

        const namaRute1 = document.getElementById('rute_1').value;
        const namaRute2 = document.getElementById('rute_2').value;
        const selectedPoints = [];

        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                const sequenceInput = document.getElementById(`sequence_${checkbox.value}`);
                selectedPoints.push({
                    point_id: checkbox.value,
                    sequence: sequenceInput.value
                });
            }
        });

        // Validasi minimal 2 point dicentang
        if (selectedPoints.length < 2) {
            alert('Harap pilih minimal 2 point untuk membuat rute.');
            return;
        }

        // Validasi duplikasi urutan
        const sequences = selectedPoints.map(point => point.sequence);
        const uniqueSequences = new Set(sequences);
        if (sequences.length !== uniqueSequences.size) {
            alert('Tidak boleh ada urutan yang sama pada point yang dipilih.');
            return;
        }

        // Buat objek data untuk dikirim
        const data = {
            rute_1: namaRute1,
            rute_2: namaRute2,
            points: selectedPoints
        };

        try {
            const response = await fetch("{{ route('rute.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Data berhasil disimpan!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = "{{ route('rute.index') }}";
                });                
            } else {
                const errorData = await response.json();
                alert('Terjadi kesalahan: ' + (errorData.message || 'Silakan coba lagi.'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan. Silakan coba lagi.');
        }
    });
</script>
@endsection
