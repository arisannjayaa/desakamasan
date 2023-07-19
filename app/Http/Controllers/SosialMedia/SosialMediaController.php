<?php

namespace App\Http\Controllers\SosialMedia;

use App\Models\SosialMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SosialMediaRequest;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SosialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Session::has('image_folder')) {
            Session::remove('image_folder');
            Session::remove('image_filename');
        }

        if (request()->ajax()) {
            $sosialMedia = SosialMedia::select('id', 'url', 'nama')->orderBy('updated_at', 'desc');
            return DataTables::of($sosialMedia)
                ->addIndexColumn()
                ->addColumn('opsi', function ($row) {
                    return '<div class="btn-group">
                    <button type="button" class="btn btn-sm" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu border border-1">
                        <li><span
                                onclick="window.location.href=\'' . route('sosial-media.edit', $row->id) . '\'"
                                role="button"class="dropdown-item">Edit</span></li>
                    </ul>
                </div>
                <form id="myForm" class="d-inline" action="' . route('sosial-media.destroy', $row->id) . '"
                    method="post">
                    ' . method_field('DELETE') . '
                    ' . csrf_field() . '
                    <button onclick="deleteData()" type="button" class="btn btn-sm btn-danger"
                    onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\')"><i
                            class="bi bi-trash-fill"></i></button>
                </form>';
                })
                ->rawColumns(['opsi'])
                ->toJson(true);
        }

        $data = [
            'menu' => 'Sosial Media',
            'links' => [
                'url' => route('sosial-media.create'),
                'button' => 'Buat',
                'class' => 'btn-primary'
            ]
        ];
        return view('sosialmedia.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mendefinikasi data yang perlu dikirimkan ke view
        $data = [
            'menu' => 'Sosial Media Baru',
            'links' => [
                'url' => route('sosial-media.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
        ];
        return view('sosialmedia.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SosialMediaRequest $request)
    {
        // Menyimpan data berita ke tabel berita
        SosialMedia::create([
            'nama' => $request->input('nama'),
            'url' => $request->input('url')
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menambahkan data sosial media'
        ]);
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
        // Mendefinikasi data yang perlu dikirimkan ke view
        $data = [
            'menu' => 'Sosial Media Edit',
            'links' => [
                'url' => route('sosial-media.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
            'sosial_media' => SosialMedia::findOrFail($id),
        ];

        return view('sosialmedia.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SosialMediaRequest $request, string $id)
    {
        // Mencari berita berdasarkan id
        $sosialMedia = SosialMedia::find($id);

        // Menyimpan data berita
        $sosialMedia->nama = $request->input('nama');
        $sosialMedia->url = $request->input('url');
        $sosialMedia->save();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil memperbaharui data sosial media'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari data berdasarkam id
        $sosialMedia = SosialMedia::find($id);
        $sosialMedia->delete();

        // Mengirim response dalam bentok json
        return response()->json([
            'status' => 200,
            'message' => 'Data sosial media berhasil dihapus!'
        ]);
    }
}
