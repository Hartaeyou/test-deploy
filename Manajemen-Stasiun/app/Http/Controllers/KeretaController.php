<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use App\Models\Kereta;
use Illuminate\Http\Request;

class KeretaController extends Controller
{
    public function index()
    {
        $keretas = Kereta::with(['rute'])->paginate(5);
        return view('Kereta.index', compact('keretas'));
    }

    public function create()
    {
        $rutes = Rute::all();
        return view('Kereta.create', compact('rutes'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kereta' => 'required|string|max:255',
            'kode_kereta' => 'required|string|unique:kereta,kode_kereta',
            'rute_id' => 'required|exists:rute,rute_id',
        ]);

        // Simpan data ke database
        Kereta::create([
            'nama_kereta' => $request->nama_kereta,
            'kode_kereta' => $request->kode_kereta,
            'rute_id' => $request->rute_id,
        ]);

        return redirect()->route('kereta.index')->with('success', 'Kereta berhasil ditambahkan!');
    }

    // edit kereta
    public function formEdit ($id)
    {
        $kereta = Kereta::with('rute.points')->findOrFail($id); // Eager loading rute dan points
        $rutes = Rute::with('points')->get(); // Ambil semua rute dengan points
        return view('Kereta.edit', compact('kereta', 'rutes'));
    }

    public function update(Request $request, $id){

    $kereta = Kereta::findOrFail($id);

    // Validasi input
    $request->validate([
        'nama_kereta' => 'required|string|max:255',
        'kode_kereta' => 'required|string|unique:kereta,kode_kereta,'.$id.','.$kereta->getKeyName(),
        'rute_id' => 'required|exists:rute,rute_id',
    ]);

    // Update data ke database
    $kereta->nama_kereta = $request->nama_kereta;
    $kereta->kode_kereta = $request->kode_kereta;
    $kereta->rute_id = $request->rute_id;
    $kereta->save();

    return redirect()->route('kereta.index')->with('success', 'Kereta berhasil diperbarui!');
    }
    

    public function destroy ($id)
    {
        $kereta = Kereta::find($id);
        $kereta->delete();
        return redirect()->route('kereta.index')->with('success', 'Kereta berhasil dihapus!');
    }

}
