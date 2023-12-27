<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function absenMasuk(Request $request)
    {
        $data = $request->validate([
            'id_karyawan' => 'required|numeric',
            // 'jam_masuk' => 'required|date_format:H:i:s',
            // 'jam_pulang' => 'required|date_format:H:i:s', // Assuming it follows the same time format
        ]);
            

        $tanggal = now()->format('Y-m-d');
        $jamMasukTelat = now()->format('H:i:s') > '07:45:00';

        $existingAbsensi = Absensi::where('id_karyawan', $data['id_karyawan'])
            ->whereDate('tanggal_absen', $tanggal)
            ->first();

        if ($existingAbsensi) {
            return response()->json(['message' => 'Karyawan sudah absen hari ini'], 400);
        }

        $absensi = new Absensi();
        $absensi->id_karyawan = $data['id_karyawan'];
        $absensi->tanggal_absen = $tanggal;
        $absensi->jam_masuk = now()->format('H:i:s');
        $absensi->telat = $jamMasukTelat;
        $absensi->save();

        return response()->json(['message' => 'Absensi masuk berhasil'], 200);
    }

    public function absenPulang(Request $request)
    {
        $data = $request->validate([
            'id_karyawan' => 'required|numeric',
        ]);

        $tanggal = now()->format('Y-m-d');

        $existingAbsensi = Absensi::where('id_karyawan', $data['id_karyawan'])
            ->whereDate('tanggal_absen', $tanggal)
            ->first();

        if (!$existingAbsensi) {
            return response()->json(['message' => 'Karyawan belum absen masuk hari ini'], 400);
        }

        $existingAbsensi->jam_pulang = now()->format('H:i');
        $existingAbsensi->durasi_kerja = now()->diffInMinutes($existingAbsensi->jam_masuk);
        $existingAbsensi->save();

        return response()->json(['message' => 'Absensi pulang berhasil'], 200);
    }
    public function getAbsenMasuk()
    {
        $absensi = Absensi::all();
        return response()->json($absensi, 200);
    }
}