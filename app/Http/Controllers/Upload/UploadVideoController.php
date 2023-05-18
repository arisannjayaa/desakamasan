<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class UploadVideoController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->file());
        $file = $request->file('video');
        $fileName = hexdec(uniqid()) . '.' . $file->extension();
        $folder = uniqid() . '-' . now()->timestamp;
        Session::put('video_folder', $folder);
        Session::put('video_filename', $fileName);
        $file->storeAs('files/tmp/' . $folder, $fileName);

        TemporaryFile::create([
            'folder' => $folder,
            'file' => $fileName
        ]);

        return 'success';
    }

    public function destroy(TemporaryFile $temporaryFile)
    {
        $temporaryFolder = Session::get('video_folder');
        $fileName = Session::get('video_filename');
        $path = storage_path('app/files/tmp/') . $temporaryFolder . '/' . $fileName;
        // dd(File::exists($path));
        if (File::exists($path)) {
            File::delete($path);
            rmdir(storage_path('app/files/tmp/' . $temporaryFolder));

            $temporaryFile->where([
                'folder' => $temporaryFolder,
                'file' => $fileName
            ])->delete();

            return 'success';
        } else {
            return 'not found';
        }
    }
}
