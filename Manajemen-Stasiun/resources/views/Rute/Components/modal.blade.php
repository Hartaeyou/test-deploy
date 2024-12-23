<!-- Tombol Mata -->

@if($rute->points->count() == 0)
<button type="button" class="btn btn-sm" style="color: #EE6B23;" disabled>
    <i class="fa-regular fa-eye"></i>
</button>
@else
<button type="button" class="btn btn-sm" style="color: #EE6B23;" data-bs-toggle="modal"
    data-bs-target="#ruteModal{{ $rute->rute_id }}">
    <i class="fa-regular fa-eye"></i>
</button>
@endif

<!-- Modal Unik untuk Setiap Baris -->
<div class="modal fade" id="ruteModal{{ $rute->rute_id }}" tabindex="-1"
    aria-labelledby="modalLabel{{ $rute->rute_id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{ $rute->rute_id }}">Nama Rute: {{ $rute->nama_rute }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                <h5 class="text-start">Point (Stasiun) dalam Rute</h5>
                    <ul class="list-group">
                        @foreach($rute->points as $point)
                            <li class="list-group-item">{{ $point->pivot->sequence }}. {{ $point->nama }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button> -->
                <a type="button" class="btn btn-sm btn-warning" href="{{ route('rute.editPage', ['id' => $rute->rute_id]) }}">Edit</a>
                <a type ="button" class="btn btn-sm btn-danger delete-button" href="{{ route('rute.delete', ['id' => $rute->rute_id]) }}">Hapus Rute</a>
                <!-- Tombol Hapus -->
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
