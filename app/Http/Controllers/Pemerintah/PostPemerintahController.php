<?php

namespace App\Http\Controllers\Pemerintah;

use App\Models\Pemerintah;
use App\Models\RiwayatKerja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\PerangkatDesaRequest;
use App\Models\RiwayatPendidikan;
use App\Models\TemporaryFile;

class PostPemerintahController extends Controller
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
                                onclick="window.location.href=\'' . route('perangkat-desa.edit', $row->id) . '\'"
                                role="button"class="dropdown-item">Edit</span></li>
                        <li><span onclick="window.location.href=\'' . route('perangkat-desa.show', $row->id) . '\'"
                                role="button"class="dropdown-item">Lihat</span></li>
                    </ul>
                </div>
                <form id="myForm" class="d-inline" action="' . route('perangkat-desa.destroy', $row->id) . '"
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
    public function store(PerangkatDesaRequest $request)
    {
        // Mengambil temporary file dari session
        $temporary = $this->temporaryFile->getFileFolder();

        // Mendefinisikan lokasi direktori asal file dan melakukan pemindahan file
        $path = storage_path() . '/app/files/tmp/' . $temporary->folder . '/' . $temporary->file;
        Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->file, 'public/perangkat-desa' . '/' . $temporary->file);

        // Menghapus file dari lokasi direktori
        File::delete($path);
        try {
            rmdir(storage_path('app/files/tmp/') . $temporary->folder);
            $temporary->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }

        // Menyimpan data berita ke tabel berita
        try {
            $pemerintah =  Pemerintah::create([
                'nama' => $request->input('nama'),
                'jabatan' => $request->input('jabatan'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'status_kawin' => $request->input('status_kawin'),
                'jumlah_anak' => $request->input('jumlah_anak'),
                'pendidikan_terakhir' => $request->input('pendidikan_terakhir'),
                'pendidikan_terakhir' => $request->input('pendidikan_terakhir'),
                'alamat' => $request->input('alamat'),
                'foto' =>  ($temporary->file) ? $temporary->file : null,
            ]);

            foreach ($request->input('perusahaan_organisasi') as $key => $row) {
                $riwayaKerja = new RiwayatKerja();
                $riwayaKerja->id_pemerintah = $pemerintah->id;
                $riwayaKerja->perusahaan_organisasi = $row;
                $riwayaKerja->tahun_mulai = $request->input('tahun_mulai')[$key];
                $riwayaKerja->tahun_selesai = $request->input('tahun_selesai')[$key];
                $riwayaKerja->save();
            }

            foreach ($request->input('tahun_lulus') as $key => $row) {
                $riwayatPendidikan = new RiwayatPendidikan();
                $riwayatPendidikan->id_pemerintah = $pemerintah->id;
                $riwayatPendidikan->jenjang = $request->input('jenjang')[$key];
                $riwayatPendidikan->institusi = $request->input('institusi_pendidikan')[$key];
                $riwayatPendidikan->tahun_lulus = $request->input('tahun_lulus')[$key];
                $riwayatPendidikan->save();
            }
        } catch (\Throwable $th) {
            throw $th;
        }

        // Mengarahkan url ke rute berita dengan method index dan mengirimkan session
        // return redirect()->route('berita.index')->with('success', 'Berhasil menambahkan data berita');
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menambahkan data perangkat desa'
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
            'menu' => 'Berita Edit',
            'links' => [
                'url' => route('berita-post.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
            'perangkat_desa' => Pemerintah::findOrFail($id),
        ];
        return view('pemerintah.edit', $data);
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
