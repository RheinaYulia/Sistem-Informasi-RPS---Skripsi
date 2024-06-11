<?php

namespace App\Http\Controllers\Rps;

use App\Http\Controllers\Controller;
use App\Models\KaprodiModel;
use App\Models\KurikulumMKModel;
use App\Models\Rps\RpsBabModel;
use App\Models\Rps\RpsModel;
use App\Models\View\RpsView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RpsTampilController extends Controller
{
    
    public function __construct(){
        $this->menuCode  = 'RPS.RPS';
        $this->menuUrl   = url('rps/detail_rps');     // set URL untuk menu ini
        $this->menuTitle = 'RPS';                       // set nama menu
        $this->viewPath  = 'rps.detail_rps.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['RPS', ' RPS']
        ];

        $activeMenu = [
            'l1' => 'rps',
            'l2' => 'rps-detail_rps',
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
    
        // Ambil nilai create_by dari request (misalnya dari user session atau request parameter)
        $userId = $request->user()->user_id;
    
        $data = RpsModel::getRps($userId);
    
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

        $data  = RpsModel::get();
        $kaprodi = KaprodiModel::getKaprodiWithNamaDosen();
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
        $this->authAction('read', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = RpsModel::getRpsDescription($id);
        $mediaview = RpsModel::getRpsMedia($id);
        $bab = RpsBabModel::getRpsBab($id);

        $page = [
            'title' => 'Detail ' . $this->menuTitle
        ];

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'detail')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('mediaview', $mediaview)
                ->with('bab', $bab);
    }

    public function shows($id){
        $this->authAction('read', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = RpsModel::getRpsDescription($id);
        $mediaview = RpsModel::getRpsMedia($id);
        $bab = RpsBabModel::getRpsBab($id);

        $page = [
            'title' => 'Detail ' . $this->menuTitle
        ];

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'cetak-rps')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('mediaview', $mediaview)
                ->with('bab', $bab);
    }


    public function showi($id){
        $this->authAction('create || update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        
        // untuk set konten halaman web
        $page = [
            'url' => $this->menuUrl . '/' . $id . '/detail',
            'title' => 'Detail Hak Akses'
        ];
        
        $data = DB::select('CALL sp_get_rps_data(?)', array($id));


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
            'title' => 'Edit ' . $this->menuTitle
        ];

        $data  = RpsModel::find($id);
        
        $kaprodi = KaprodiModel::getKaprodiWithNamaDosen();
        $kurikulumk  = KurikulumMKModel::getMksWithSelected($data->kurikulum_mk_id);

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'action')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('kaprodi', $kaprodi)
            ->with('kurikulumk', $kurikulumk);
    }


    public function update(Request $request, $id){
        $this->authAction('update', 'json');
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

            $res = RpsModel::updateData($id, $request);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res)? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        }

        return redirect('/');
    }

    public function confirm($id)
{
    $this->authAction('delete', 'modal');
    if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

    $data = RpsModel::getRpsDelete($id);

    return (!$data) ? $this->showModalError() :
        $this->showModalConfirm($this->menuUrl . '/' . $id, [
            'Mata Kuliah' => $data->mk_nama,
            'Nama Dosen' => $data->nama_dosen,
            'Deskripsi' => $data->deskripsi_rps,
            'Tanggal Penyusunan' => $data->tanggal_penyusunan,
        ]);
}

    public function destroy(Request $request, $id){
        $this->authAction('delete', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $res = RpsModel::deleteData($id);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => RpsModel::getDeleteMessage()
            ]);
        }

        return redirect('/');
    }
}