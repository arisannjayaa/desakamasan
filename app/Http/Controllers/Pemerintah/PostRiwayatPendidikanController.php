<?php

namespace App\Http\Controllers\Pemerintah;

use App\Http\Controllers\Controller;
use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;

class PostRiwayatPendidikanController extends Controller
{
    public function destroy(String $id)
    {
        RiwayatPendidikan::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menghapus data riwayat pendidikan'
        ]);
    }
}
