<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view()
{
    // Ambil data workshop dan vehicle dengan join
    $workshops = Workshop::select('workshops.*', 'vehicles.*')
        ->leftJoin('vehicles', 'workshops.vehicle_id', '=', 'vehicles.vehicle_id')
        ->orderBy('workshops.workshop_name', 'asc')
        ->get();

    // Lakukan proses penyensoran
    $workshops->transform(function ($workshop) {
        // Ambil nomor plat dari workshop
        $plateNumber = $workshop->plate_number;

        // Jika panjang nomor plat kurang dari 3 karakter, tidak lakukan penyensoran
        if (strlen($plateNumber) <= 2) {
            return $workshop; // Kembalikan workshop tanpa perubahan
        }

        // Pilih posisi acak untuk disensor, kecuali huruf pertama dan terakhir
        $positions = range(2, strlen($plateNumber) - 2); // Posisi yang bisa disensor

        // Ambil tiga posisi acak dari array $positions (disensor 3 huruf)
        $randomPositions = array_rand($positions, 3);

        // Bangun nomor plat yang disensor
        $censoredPlateNumber = [];
        for ($i = 0; $i < strlen($plateNumber); $i++) {
            if ($plateNumber[$i] == ' ') {
                // Jika karakter adalah spasi, tidak disensor
                $censoredPlateNumber[] = ' ';
            } elseif ($i == 0 || $i == strlen($plateNumber) - 1) {
                // Huruf pertama dan terakhir tidak disensor
                $censoredPlateNumber[] = $plateNumber[$i];
            } elseif (in_array($i, $randomPositions)) {
                // Posisi acak disensor
                $censoredPlateNumber[] = '*';
            } else {
                // Karakter lainnya tetap
                $censoredPlateNumber[] = $plateNumber[$i];
            }
        }

        // Gabungkan kembali array menjadi string
        $workshop->censored_plate_number = implode('', $censoredPlateNumber);

        return $workshop;
    });

    // Kirim data ke view
    return view('dashboard.index', compact('workshops'));
    }
}
