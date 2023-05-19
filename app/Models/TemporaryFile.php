<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use stdClass;

class TemporaryFile extends Model
{
    use HasFactory;
    protected $table = 'temporary_file';
    protected $fillable = ['folder', 'file'];

    public function getFileFolder()
    {
        if(Session::has('image_folder')) {
            $temporaryFile = Session::get('image_filename');
            $temporaryFolder = Session::get('image_folder');
            return $this->where('folder', $temporaryFolder)
            ->where('file', $temporaryFile)
            ->first();
        } else {
           $temporary = new stdClass;
           $temporary->folder = null;
           $temporary->file = null;
           return $temporary;
        }
    }
}
