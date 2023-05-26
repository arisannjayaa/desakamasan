<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class UploadImageController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->file());
        $file = $request->file('gambar');
        $fileName = hexdec(uniqid()) . '.' . $file->extension();
        $folder = uniqid() . '-' . now()->timestamp;
        $file->storeAs('files/tmp/' . $folder, $fileName);

        TemporaryFile::create([
            'folder' => $folder,
            'file' => $fileName
        ]);

        Session::push('image_folder', $folder);
        Session::push('image_filename', $fileName);

        return $fileName;
    }

    public function destroy(Request $request)
    {
        $isOld = $request->input('old_file');
        $isTemporary = $request->input('file_temporary');

        if ($isTemporary) {
            $db = TemporaryFile::where('file', $request->fileTemporary)->first();
            // dd($request);
            if($db) {
                // $temporaryFolder = Session::get('foto_folder');
                // $fileName = Session::get('foto_filename');
                $path = storage_path('/app/files/tmp/') . $db->folder . '/' . $db->file;
                // dd(File::exists($path));
                if (File::exists($path)) {
                    File::delete($path);
                    rmdir(storage_path('app/files/tmp/' . $db->folder));

                    TemporaryFile::where([
                        'folder' => $db->folder,
                        'file' => $db->file
                    ])->delete();

                    if(Session::has('image_folder')) {
                        Session::remove('image_folder');
                        Session::remove('image_filename');
                    }
                    return response()->json(['message' => 'File berhasil dihapus'], 200);
                } else {
                    return response()->json(['message' => 'File tidak tersedia'], 404);
                }
            }
        } else {
            $oldPath = str_replace(url('/storage'), '', $isOld);
            // Logika untuk menghapus file yang tidak ada dalam direktori temporary
            // Sesuaikan dengan kebutuhan aplikasi Anda
            // Contoh penghapusan file menggunakan Storage pada Laravel
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
                return response()->json(['message' => 'File berhasil dihapus'], 200);
            } else {
                return response()->json(['message' => 'File tidak ditemukan'], 404);
            }
        }
    }
}
