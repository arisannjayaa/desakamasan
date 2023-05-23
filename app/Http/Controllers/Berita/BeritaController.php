<?php

namespace App\Http\Controllers\Berita;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $temporaryFile;

    public function __construct()
    {
        $this->temporaryFile = new TemporaryFile();
    }

    public function index()
    {
        (Session::has('image_folder')) ? Session::remove('image_folder') : Session::remove('image_filename');

        if (request()->ajax()) {
            $berita = Berita::select('id', 'judul', 'gambar', 'deskripsi')->orderBy('created_at', 'desc');
            return DataTables::of($berita)
                ->addIndexColumn()
                ->editColumn('deskripsi', function($row) {
                    return '<span class="d-block text-truncate" style="max-width: 100px;">'.strip_tags($row->deskripsi).'</span>';
                })
                ->editColumn('judul', function($row) {
                    return '<span class="d-block" style="max-width: 200px;">'.$row->judul.'</span>';
                })
                ->editColumn('gambar', function($row) {
                    return '<img height="50" src="' . asset('/storage/berita') . '/' . $row->gambar . '" alt="">';
                })
                ->addColumn('opsi', function($row) {
                    return '<div class="btn-group">
                    <button type="button" class="btn btn-sm" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu border border-1">
                        <li><span
                                onclick="window.location.href=\''.route('berita.edit', $row->id) .'\'"
                                role="button"class="dropdown-item">Edit</span></li>
                        <li><span onclick="window.location.href="
                                role="button"class="dropdown-item">Lihat</span></li>
                    </ul>
                </div>
                <form id="formDelete"  class="d-inline" action="'.route('berita.destroy', $row->id) .'"
                    method="post">
                    '.method_field('DELETE').'
                    '.csrf_field().'
                    <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\')"><i
                            class="bi bi-trash-fill"></i></button>
                </form>';
                    })
                ->rawColumns(['opsi', 'deskripsi', 'gambar', 'judul'])
                ->toJson(true);
        }

        $data = [
            'menu' => 'Berita',
            'links' => [
                'url' => route('berita.create'),
                'button' => 'Buat',
                'class' => 'btn-primary'
            ],
            'berita' => Berita::all()
        ];
        return view('berita.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'menu' => 'Berita Baru',
            'links' => [
                'url' => route('berita.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
        ];
        return view('berita.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'slug' => 'required',
            'deskripsi' => 'required',
        ]);


        $temporary = $this->temporaryFile->getFileFolder();
        // dd($temporary);

        $path = storage_path() . '/app/files/tmp/' . $temporary->folder . '/' . $temporary->file;
        Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->file, 'public/berita' . '/' . $temporary->file);

        File::delete($path);
        rmdir(storage_path('app/files/tmp/') . $temporary->folder);
        $temporary->delete();

        Session::remove('image_folder');
        Session::remove('image_filename');

        Berita::create([
            'judul' => $request->input('judul'),
            'slug' => $request->input('slug'),
            'deskripsi' => $request->input('deskripsi'),
            'gambar' =>  $temporary->file
        ]);
        return redirect()->route('berita.index')->with('success', 'Berhasil menambahkan data berita');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'menu' => 'Berita Baru',
            'links' => [
                'url' => route('berita.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
            'berita' => Berita::findOrFail($id)
        ];
        return view('berita.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'slug' => 'required',
            'deskripsi' => 'required',
        ]);

        $berita = Berita::find($id);
        $temporary = $this->temporaryFile->getFileFolder();
        // dd($temporary);
        $path = ($temporary->folder == null) ? '' : storage_path() . '/app/files/tmp/' . $temporary->folder . '/' . $temporary->file;

        if(Session::has('image_folder')) {
            if(File::exists($path)){
                Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->file, 'public/berita' . '/' . $temporary->file);

                File::delete($path);
                rmdir(storage_path('app/files/tmp/') . $temporary->folder);
                $temporary->delete();
            }
            $pathOld = storage_path() . '/app/public/berita/' . $berita->gambar;
                if(File::exists($pathOld)) {
                    File::delete($pathOld);
                }
        }

        // dd($berita->gambar);
        // dd($temporary->file);
        // dd($request->gambar);
        $berita->judul = $request->input('judul');
        $berita->slug = $request->input('slug');
        $berita->deskripsi = $request->input('deskripsi');
        $berita->gambar = ($temporary->file == null) ? $berita->gambar : $temporary->file ;
        $berita->save();
        return redirect()->route('berita.index')->with('success', 'Berhasil memperbaharui data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $berita = Berita::find($id);
        $pathOld = storage_path() . '/app/public/berita/' . $berita->gambar;
        if(File::exists($pathOld)) {
            File::delete($pathOld);
        }
        $berita->delete();
        // return redirect()->route('berita.index')->with('success', 'Berhasil menghapus data');
        return response()->json([
            'status' => 200,
            'message' => 'Data berita berhasil dihapus!'
        ]);
    }
}
