<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use App\Models\Point;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    public function index(){
        $rutes = Rute::with(['points'])->paginate(5);
        return view('Rute.rute', compact('rutes'));
    }

    public function formCreate ()
    {
        $points = Point::all();
        return view('Rute.formCreateRute', compact('points'));
    }

    public function store (Request $request){
        $request->validate([
            'rute_1' => 'required|string|max:100',
            'rute_2' => 'required|string|max:100',
            'points' => 'nullable|array', // Harus array
            'points.*.point_id' => 'nullable|exists:point,point_id', // ID point harus valid
            'points.*.sequence' => 'required|integer|min:1', // Urutan harus angka positif
        ]);
        $rute = Rute::create([
            'rute_1' => $request->rute_1
            , 'rute_2' => $request->rute_2
        ]);

        foreach ($request->points as $point) {
            $rute->points()->attach($point['point_id'], ['sequence' => $point['sequence']]);
        }

        return redirect()->route('rute.index')->with('success', 'Rute berhasil dibuat.');
    }

    public function showDetail($id){
        $rute = Rute::with(['points'])->find($id);
        return view('Rute.showDetail', compact('rute'));
    }

    // edit rute
    public function edit($id){
        $rute = Rute::with('points')->findOrFail($id);
        $availablePoints = Point::whereNotIn('point_id', $rute->points->pluck('point_id'))->get();
    
        return view('Rute.formEditRute', compact('rute', 'availablePoints'));
    }

    public function update(Request $request, $id)
    {
        $rute = Rute::findOrFail($id);
        // Validasi input
        $request->validate([
            'rute_1' => 'required|string|max:100',
            'rute_2' => 'required|string|max:100',
            'points' => 'nullable|array',
            'points.*.point_id' => 'nullable|exists:point,point_id',
            'points.*.sequence' => 'nullable|integer|min:1'
        ]);

        // Update nama rute
        $rute->update(['rute_1' => $request->rute_1, 'rute_2' => $request->rute_2]);

        // Update urutan point pada rute
        $points = [];
        foreach ($request->points as $point) {
            $points[$point['id']] = ['sequence' => $point['sequence']];
        }
        $rute->points()->sync($points);

        return redirect()->route('rute.index')->with('success', 'Rute berhasil diperbarui!');
    }

    public function destroy ($id)
    {
        $rute = Rute::find($id);
        $rute->delete();
        return redirect()->route('rute.index')->with('success', 'Rute berhasil dihapus!');
    }
}
