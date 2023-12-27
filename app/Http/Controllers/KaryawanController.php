<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
  
    public function getAllKaryawan()
    {
        $karyawan = Karyawan::all();
        return response()->json($karyawan, 200);
      
    }

    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return response()->json($karyawan, 200);
    }

    public function create()
    {
      
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|unique:karyawan,nik|max:10',
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required|date',
            'tanggal_bergabung' => 'required|date',
            'status' => 'required|in:Aktif,Resigned',
            'department' => 'required',
            'nomor_hp' => 'nullable',
        ]);
    
        $karyawan = new Karyawan();
        $karyawan->fill($validatedData);
        $karyawan->save();
    
        return response()->json(['message' => 'Karyawan berhasil ditambahkan'], 201);
    }
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $validatedData = $request->validate([
            'nik' => 'required|unique:karyawan,nik,'.$karyawan->id.'|max:10',
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required|date',
            'tanggal_bergabung' => 'required|date',
            'status' => 'required|in:Aktif,Resigned',
            'department' => 'required',
            'nomor_hp' => 'nullable',
        ]);

        $karyawan->update($validatedData);

        return response()->json(['message' => 'Karyawan berhasil diperbarui'], 200);
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return response()->json(['message' => 'Karyawan berhasil dihapus'], 200);
    }

    public function birthday()
    {
        $today = now();
        $karyawan = Karyawan::whereDay('tanggal_lahir', $today->day)
                           ->whereMonth('tanggal_lahir', $today->month)
                           ->get();
        
        return response()->json($karyawan, 200);
    }

}
