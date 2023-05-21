<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


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
        $db = TemporaryFile::where('file', $request->image)->first();
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
                return 'deleted';
            } else {
                return 'not found';
            }
        }
    }
}
