<?php

namespace App\Http\Controllers\Daerah;

use App\Models\Daerah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class DaerahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        (Session::has('image_folder')) ? Session::remove('image_folder') : Session::remove('image_filename');

        if (request()->ajax()) {
            $daerah = Daerah::select('id', 'foto', 'nama', 'alamat', 'fasilitas', 'kategori')->orderBy('created_at', 'desc');
            return DataTables::of($daerah)
                ->addIndexColumn()
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
                <form class="d-inline" action="'.route('berita.destroy', $row->id) .'"
                    method="post">
                    '.method_field('DELETE').'
                    '.csrf_field().'
                    <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\')"><i
                            class="bi bi-trash-fill"></i></button>
                </form>';
                    })
                ->rawColumns(['opsi'])
                ->toJson(true);
        }

        $data = [
            'menu' => 'Daerah',
            'links' => [
                'url' => route('daerah.create'),
                'button' => 'Buat',
                'class' => 'btn-primary'
            ],
            'daerah' => Daerah::all()
        ];
        return view('daerah.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'menu' => 'Daerah Baru',
            'links' => [
                'url' => route('daerah.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
        ];
        return view('daerah.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
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
