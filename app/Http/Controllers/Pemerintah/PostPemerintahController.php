<?php

namespace App\Http\Controllers\Pemerintah;

use App\Models\Daerah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pemerintah;
use App\Models\RiwayatKerja;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PostPemerintahController extends Controller
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
            $pemerintah = Pemerintah::select('id', 'nama', 'jabatan', 'pendidikan_terakhir', 'status_kawin')->orderBy('updated_at', 'desc');
            return DataTables::of($pemerintah)
                ->addIndexColumn()
                ->addColumn('opsi', function ($row) {
                    return '<div class="btn-group">
                    <button type="button" class="btn btn-sm" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu border border-1">
                        <li><span
                                onclick="window.location.href=\'' . route('daerah-post.edit', $row->id) . '\'"
                                role="button"class="dropdown-item">Edit</span></li>
                        <li><span onclick="window.location.href=\'' . route('daerah.show', $row->slug) . '\'"
                                role="button"class="dropdown-item">Lihat</span></li>
                    </ul>
                </div>
                <form id="myForm" class="d-inline" action="' . route('daerah-post.destroy', $row->id) . '"
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
            'menu' => 'Perangkat Desa',
            'links' => [
                'url' => route('perangkat-desa.create'),
                'button' => 'Buat',
                'class' => 'btn-primary'
            ]
        ];
        return view('pemerintah.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'menu' => 'Perangkat Desa Baru',
            'links' => [
                'url' => route('perangkat-desa.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
        ];
        return view('pemerintah.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
