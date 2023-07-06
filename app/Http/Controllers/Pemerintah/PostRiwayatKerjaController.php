<?php

namespace App\Http\Controllers\Pemerintah;

use App\Http\Controllers\Controller;
use App\Models\RiwayatKerja;

class PostRiwayatKerjaController extends Controller
{
    public function destroy(String $id)
    {
        RiwayatKerja::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menghapus data riwayat kerja'
        ]);
    }
}
