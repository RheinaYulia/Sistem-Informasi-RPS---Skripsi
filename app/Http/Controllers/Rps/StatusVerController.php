<?php

namespace App\Http\Controllers\Rps;

use App\Http\Controllers\Controller;
use App\Models\KaprodiModel;
use App\Models\KurikulumMKModel;
use App\Models\Rps\RpsModel;
use App\Models\Rps\StatusModel;
use App\Models\Rps\StatusVerModel;
use App\Models\Rps\VerifikasiModel;
use App\Models\View\RpsView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StatusVerController extends Controller
{
    
    public function __construct(){
        $this->menuCode  = 'RPS.STATUSVER';
        $this->menuUrl   = url('rps/status_ver');     // set URL untuk menu ini
        $this->menuTitle = 'Ajukan Pengesahan RPS';                       // set nama menu
        $this->viewPath  = 'rps.status_ver.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['RPS', 'Status Sah']
        ];

        $activeMenu = [
            'l1' => 'rps',
            'l2' => 'rps-status_ver',
            'l3' => null
        ];

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Daftar '. $this->menuTitle
        ];

        return view($this->viewPath . 'index')
            ->with('breadcrumb', (object) $breadcrumb)
            ->with('activeMenu', (object) $activeMenu)
            ->with('page', (object) $page)
            ->with('allowAccess', $this->authAccessKey());
    }

    public function list(Request $request){
        $this->authAction('read', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $userId = $request->user()->user_id;
        $data  = StatusModel::getStatusVer($userId);

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function create(){
        $this->authAction('create || update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Tambah ' . $this->menuTitle
        ];

        $kaprodi = KaprodiModel::selectRaw("kaprodi_id, prodi_id, tahun")->get();
        $kurikulumk  = KurikulumMKModel::getMks();

        return view($this->viewPath . 'action')
            ->with('page', (object) $page)
            ->with('kaprodi', $kaprodi)
            ->with('kurikulumk', $kurikulumk);
    }


    public function store(Request $request){
        $this->authAction('create || update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'kaprodi_id' => 'required|integer',
                'kurikulum_mk_id' => 'required|integer',
                'deskripsi_rps' => 'required|string',
                'tanggal_penyusunan' => 'required|date',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'stat'     => false,
                    'mc'       => false,
                    'msg'      => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }

            $res = RpsModel::insertData($request);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res)? $this->getMessage('insert.success') : $this->getMessage('insert.failed')
            ]);

        }

        return redirect('/');
    }

    public function show($id){
        $this->authAction('create || update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        
        // untuk set konten halaman web
        $page = [
            'url' => $this->menuUrl . '/' . $id . '/detail',
            'title' => 'Detail Hak Akses'
        ];
        
        $data  = StatusModel::find($id);


        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'detail')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data);
    }

    public function menu_save(Request $request)
    {
        $this->authAction('create || update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        // cek untuk Insert/Update/Delete harus via AJAX
        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'rps_id' => 'required|integer',
                'jenis_media' => 'required|integer',
            'nama_media' => 'required|string',
            'dosen_id' => 'required|integer',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'stat'     => false,
                    'mc'       => false,
                    'msg'      => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }

           // Panggil stored procedure untuk insert atau update
        try {
            $results = DB::select('CALL sp_InsertOrUpdateRPS(?, ?, ?, ?)', [
                $request->input('rps_id'),
                $request->input('jenis_media'),
                $request->input('nama_media'),
                $request->input('dosen_id'),
            ]);
            $res = ($results) ? true : false;
            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res) ? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        } catch (\Exception $e) {
            // Tangani kesalahan jika panggilan stored procedure gagal
            return response()->json([
                'stat' => false,
                'mc' => false,
                'msg' => 'Terjadi kesalahan saat memproses data.'
            ]);
        }
    }
    return redirect('/');
}

    public function edit($id){
        $this->authAction('update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Ajukan Verifikasi '
        ];

        $data  = StatusModel::find($id);
        
        $kaprodi = KaprodiModel::selectRaw("kaprodi_id, prodi_id, tahun")->get();
        $kurikulumk  = KurikulumMKModel::getMks();
        $kurikulumkId = KurikulumMKModel::getMksId($id)->first(); // Ambil elemen pertama

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'action')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('kaprodi', $kaprodi)
            ->with('kurikulumk', $kurikulumk)
            ->with('kurikulumkId', $kurikulumkId);
    }


    public function update(Request $request, $id){
        $this->authAction('update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'verifikasi' => 'required|integer'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'stat'     => false,
                    'mc'       => false,
                    'msg'      => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }

            $res = StatusModel::updateData($id, $request);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res)? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        }

        return redirect('/');
    }
}