<?php

namespace App\Http\Controllers\Rps;

use App\Http\Controllers\Controller;
use App\Models\BabRps\BabMateriModel;
use App\Models\Dosen\DosenModel;
use App\Models\KurikulumMKModel;
use App\Models\Master\MediaModel as MasterMediaModel;
use App\Models\Master\MediaModel;
use App\Models\Master\PustakaModel;
use App\Models\Rps\RpsBabModel;
use App\Models\Rps\RpsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RPSdetailController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'RPS.KELOLAMASTER';
        $this->menuUrl   = url('rps/kelola_master');     // set URL untuk menu ini
        $this->menuTitle = 'Kelola Master';                       // set nama menu
        $this->viewPath  = 'rps.kelola_master.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['RPS', 'Kelola Master']
        ];

        $activeMenu = [
            'l1' => 'rps',
            'l2' => 'rps-kelola_master',
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
    
        $data = RpsModel::getMkRps($userId);
    
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function listbab(Request $request,$id){
        $this->authAction('read', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data  = RpsBabModel::getBab($id);

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function kelolaData($id)
    {
        // Ambil data berdasarkan ID
        $data = RpsModel::getRpsDescription($id);

        $breadcrumb = [
            'title' => 'Kelola '.$data->mk_nama,
            'list'  => ['RPS', 'Kelola '.$data->mk_nama]
        ];

        $activeMenu = [
            'l1' => 'rps',
            'l2' => 'rps-kelola_master',
            'l3' => null
        ];

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Daftar Pertemuan '.$data->mk_nama,
        ];

        // Tampilkan view yang sesuai dengan data
        return view($this->viewPath . 'bab_rps.kelola_data')
        ->with('data', $data)
        ->with('id', $id)
        ->with('breadcrumb', (object) $breadcrumb)
        ->with('activeMenu', (object) $activeMenu)
        ->with('page', (object) $page)
        ->with('allowAccess', $this->authAccessKey());
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
        
        $this->authAction('create || update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];
        $cpl = RpsModel::getCplProdi($id);
        $cpmk = RpsModel::getCpmk($id);
        $data = RpsModel::getRpsData($id);
        $pengampu = DosenModel::selectRaw('dosen_id, nama_dosen')->get();
        $rpsDescription = RpsModel::getRpsDescription($id);
        $mediaview = RpsModel::getRpsMedia($id);
        $pustakaview = RpsModel::getRpsPustaka($id);
        $pengampuview = RpsModel::getRpsPengampu($id);
        $pengembangview = RpsModel::getRpsPengembang($id);
        $selectCpl = RpsModel::getSelectedCplProdi($id);
        $bk = RpsModel::getBk($id);
        $selectCpmk = RpsModel::getSelectedCpmk($id);
        $selectBk = RpsModel::getSelectedBk($id);
       

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'action')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('cpl', $cpl)
                ->with('selectCpl', $selectCpl)
                ->with('selectCpmk', $selectCpmk)
                ->with('cpmk',$cpmk)
                ->with('bk', $bk)
                ->with('selectBk', $selectBk)
                ->with('mediaview', $mediaview)
                ->with('pustakaview', $pustakaview)
                ->with('pengampu', $pengampu)
                ->with('pengampuview',$pengampuview)
                ->with('pengembangview', $pengembangview)
                ->with('rpsDescription', $rpsDescription)
                ;
    }

    public function update(Request $request, $id){

        
        $this->authAction('create || update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'rps_id' => 'required|integer',
                'jenis_media.*' => 'nullable|integer',
                'nama_media.*' => 'nullable|string',
                'dosen_pengampu_id.*' => 'required|integer',
                'cpl_prodi_id.*' => 'required|integer',
                'cpl_cpmk_id.*' => 'required|integer',
                'mk_bk_id.*' => 'required|integer',
                'dosen_pengembang_id.*' => 'required|integer',
                'jenis_pustaka.*' => 'nullable|integer',
                'referensi.*' => 'nullable|string',
                'elements_to_remove.*' => 'nullable|integer',
                'elements_to_remove1.*' => 'nullable|integer',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'stat' => false,
                    'mc' => false,
                    'msg' => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }

            // Hapus data dari d_rps_media berdasarkan ID yang diterima
        if ($request->has('elements_to_remove')) {
            $this->deleteMedia($request->input('elements_to_remove'));
        }

        // Hapus data dari d_rps_media berdasarkan ID yang diterima
        if ($request->has('elements_pustaka')) {
            $this->deletePustaka($request->input('elements_pustaka'));
        }

        if ($request->has('elements_pengampu')) {
            $this->deletePengampu($request->input('elements_pengampu'), $request->input('rps_id'));
        }
        

        if ($request->has('elements_pengembang')) {
            $this->deletePengembang($request->input('elements_pengembang'), $request->input('rps_id'));
        }

        if ($request->has('elements_cpl_prodi')) {
            $this->deleteCplProdi($request->input('elements_cpl_prodi'));
        }

        if ($request->has('elements_cpmk')) {
            $this->deleteCpmk($request->input('elements_cpmk'), $request->input('rps_id'));
        }

        if ($request->has('elements_bk')) {
            $this->deleteBk($request->input('elements_bk'));
        }
    
            // Panggil fungsi spInsertOrUpdateRPS dari model RpsModel untuk melakukan transaksi database
            $res = RpsModel::spInsertOrUpdateRPS(
                $request->input('rps_id'),
                $request->input('jenis_media'),
                $request->input('nama_media'),
                $request->input('dosen_pengampu_id'),
                $request->input('cpl_prodi_id'),
                $request->input('cpl_cpmk_id'),
                $request->input('mk_bk_id'),
                $request->input('dosen_pengembang_id'),
                $request->input('jenis_pustaka'),
                $request->input('referensi')
            );
           
            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res) ? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
            
        }
    
        return redirect('/');
    }

    public function editPustaka($id){
        
        $this->authAction('create || update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];

        $data = RpsModel::getRpsData($id);
        $pustaka = PustakaModel::selectRaw('pustaka_id,jenis_pustaka,referensi')->whereNull('deleted_at')->get();
        $pustakaview = RpsModel::getRpsPustaka($id);
       

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'master_rps.acpustaka')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('pustaka', $pustaka)
                ->with('pustakaview', $pustakaview)
                ;
    }

    public function updatePustaka(Request $request, $id) {
        $this->authAction('create || update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'rps_id' => 'required|integer',
                'pustaka_utama_id.*' => 'required|integer',
                'pustaka_pendukung_id.*' => 'required|integer',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'stat' => false,
                    'mc' => false,
                    'msg' => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }
    
            if ($request->has('elements_pustaka')) {
                $this->deletePustaka($request->input('elements_pustaka'), $request->input('rps_id'));
            }
    
            $pustakaIds = array_merge(
                $request->input('pustaka_utama_id', []),
                $request->input('pustaka_pendukung_id', [])
            );
    
            $res = RpsModel::spPustaka(
                $request->input('rps_id'),
                $pustakaIds
            );
    
            return response()->json([
                'stat' => $res,
                'mc' => $res,
                'msg' => ($res) ? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        }
    
        return redirect('/');
    }
    

    public function editMedia($id){
        
        $this->authAction('create || update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];

        $data = RpsModel::getRpsData($id);
        $media = MediaModel::selectRaw('media_id,jenis_media,nama_media')->whereNull('deleted_at')->get();
        $mediaview = RpsModel::getRpsMedia($id);
       

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'master_rps.acmedia')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('media', $media)
                ->with('mediaview', $mediaview)
                ;
    }

    public function updateMedia(Request $request, $id) {
        $this->authAction('create || update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'rps_id' => 'required|integer',
                'software.*' => 'required|integer',
                'hardware.*' => 'required|integer',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'stat' => false,
                    'mc' => false,
                    'msg' => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }
    
            if ($request->has('elements_media')) {
                $this->deleteMedia($request->input('elements_media'), $request->input('rps_id'));
            }
    
            $mediaIds = array_merge(
                $request->input('software', []),
                $request->input('hardware', [])
            );
    
            $res = RpsModel::spMedia(
                $request->input('rps_id'),
                $mediaIds
            );
    
            return response()->json([
                'stat' => $res,
                'mc' => $res,
                'msg' => ($res) ? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        }
    
        return redirect('/');
    }

    public function editPengampu($id){
        
        $this->authAction('create || update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];
        $data = RpsModel::getRpsData($id);
        $pengampu = DosenModel::selectRaw('dosen_id, nama_dosen')->get();
        $rpsDescription = RpsModel::getRpsDescription($id);
        $pengampuview = RpsModel::getRpsPengampu($id);
       

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'master_rps.acpengampu')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('pengampu', $pengampu)
                ->with('pengampuview', $pengampuview)
                ->with('rpsDescription', $rpsDescription)
                ;
    }

    public function updatePengampu(Request $request, $id){

        
        $this->authAction('create || update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'rps_id' => 'required|integer',
                'dosen_pengampu_id.*' => 'required|integer',
                'elements_to_remove.*' => 'nullable|integer',
                'elements_to_remove1.*' => 'nullable|integer',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'stat' => false,
                    'mc' => false,
                    'msg' => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }
        

        if ($request->has('elements_pengampu')) {
            $this->deletePengampu($request->input('elements_pengampu'), $request->input('rps_id'));
        }
    
            // Panggil fungsi spInsertOrUpdateRPS dari model RpsModel untuk melakukan transaksi database
            $res = RpsModel::spPengampu(
                $request->input('rps_id'),
                $request->input('dosen_pengampu_id'),
            );
           
            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res) ? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
            
        }
    
        return redirect('/');
    }

    public function editMkSyarat($id){
        
        $this->authAction('create || update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];
        $data = RpsModel::getRpsData($id);
        $pengampu = DosenModel::selectRaw('dosen_id, nama_dosen')->get();
        $pengampuview = RpsModel::getRpsPengampu($id);
       

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'master_rps.acpengampu')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('pengampu', $pengampu)
                ->with('pengampuview', $pengampuview)
                ;
    }

    public function updateMkSyarat(Request $request, $id){

        
        $this->authAction('create || update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'rps_id' => 'required|integer',
                'dosen_pengampu_id.*' => 'required|integer',
                'elements_to_remove.*' => 'nullable|integer',
                'elements_to_remove1.*' => 'nullable|integer',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'stat' => false,
                    'mc' => false,
                    'msg' => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }
        

        if ($request->has('elements_pengampu')) {
            $this->deletePengampu($request->input('elements_pengampu'), $request->input('rps_id'));
        }
    
            // Panggil fungsi spInsertOrUpdateRPS dari model RpsModel untuk melakukan transaksi database
            $res = RpsModel::spPengampu(
                $request->input('rps_id'),
                $request->input('dosen_pengampu_id'),
            );
           
            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res) ? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
            
        }
    
        return redirect('/');
    }

    

    public function edit1($id){
        
        $this->authAction('create || update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];
        $data = RpsModel::getRpsData($id);
        $pengampu = DosenModel::selectRaw('dosen_id, nama_dosen')->get();
        $rpsDescription = RpsModel::getRpsDescription($id);
        $pengembangview = RpsModel::getRpsPengembang($id);
       

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'master_rps.acpengembang')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('pengampu', $pengampu)
                ->with('pengembangview', $pengembangview)
                ->with('rpsDescription', $rpsDescription)
                ;
    }

    public function update1(Request $request, $id){

        
        $this->authAction('create || update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'rps_id' => 'required|integer',
                'dosen_pengembang_id.*' => 'required|integer',
                'elements_to_remove.*' => 'nullable|integer',
                'elements_to_remove1.*' => 'nullable|integer',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'stat' => false,
                    'mc' => false,
                    'msg' => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }
        

        if ($request->has('elements_pengembang')) {
            $this->deletePengembang($request->input('elements_pengembang'), $request->input('rps_id'));
        }
    
            // Panggil fungsi spInsertOrUpdateRPS dari model RpsModel untuk melakukan transaksi database
            $res = RpsModel::spPengembang(
                $request->input('rps_id'),
                $request->input('dosen_pengembang_id'),
            );
           
            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res) ? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
            
        }
    
        return redirect('/');
    }

    public function editCPMK($id){
        
        $this->authAction('create || update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];
        $cpmk = RpsModel::getCpmk($id);
        $data = RpsModel::getRpsData($id);
        $selectCpmk = RpsModel::getSelectedCpmk($id);
       

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'master_rps.accpmk')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('selectCpmk', $selectCpmk)
                ->with('cpmk',$cpmk)
                ;
    }

    public function updateCPMK(Request $request, $id){

        
        $this->authAction('create || update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'rps_id' => 'required|integer',
                'cpl_cpmk_id.*' => 'required|integer',
                'elements_to_remove.*' => 'nullable|integer',
                'elements_to_remove1.*' => 'nullable|integer',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'stat' => false,
                    'mc' => false,
                    'msg' => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }

        if ($request->has('elements_cpmk')) {
            $this->deleteCpmk($request->input('elements_cpmk'), $request->input('rps_id'));
        }
            // Panggil fungsi spInsertOrUpdateRPS dari model RpsModel untuk melakukan transaksi database
            $res = RpsModel::spCPMK(
                $request->input('rps_id'),
                $request->input('cpl_cpmk_id'),
            );
           
            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res) ? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
            
        }
    
        return redirect('/');
    }


    public function editCplProdi($id){
        
        $this->authAction('create || update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];
        $cpl = RpsModel::getCplProdi($id);
        $data = RpsModel::getRpsData($id);
        $selectCpl = RpsModel::getSelectedCplProdi($id);
       

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'master_rps.accplprodi')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('cpl', $cpl)
                ->with('selectCpl', $selectCpl)
                ;
    }

    public function updateCplProdi(Request $request, $id){

        
        $this->authAction('create || update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'rps_id' => 'required|integer',
                'cpl_prodi_id.*' => 'required|integer',
                'elements_to_remove.*' => 'nullable|integer',
                'elements_to_remove1.*' => 'nullable|integer',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'stat' => false,
                    'mc' => false,
                    'msg' => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }

        if ($request->has('elements_cpl_prodi')) {
            $this->deleteCplProdi($request->input('elements_cpl_prodi'), $request->input('rps_id'));
        }
            // Panggil fungsi spInsertOrUpdateRPS dari model RpsModel untuk melakukan transaksi database
            $res = RpsModel::spCplProdi(
                $request->input('rps_id'),
                $request->input('cpl_prodi_id'),
            );
           
            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res) ? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
            
        }
    
        return redirect('/');
    }

    public function editBK($id){
        
        $this->authAction('create || update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];
        $data = RpsModel::getRpsData($id);
        $bk = RpsModel::getBk($id);
        $selectBk = RpsModel::getSelectedBk($id);
       

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'master_rps.acbk')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('bk', $bk)
                ->with('selectBk', $selectBk)
                ;
    }

    public function updateBk(Request $request, $id){

        
        $this->authAction('create || update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'rps_id' => 'required|integer',
                'mk_bk_id.*' => 'required|integer',
                'elements_to_remove.*' => 'nullable|integer',
                'elements_to_remove1.*' => 'nullable|integer',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'stat' => false,
                    'mc' => false,
                    'msg' => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }

        if ($request->has('elements_bk')) {
            $this->deleteBk($request->input('elements_bk'), $request->input('rps_id'));
        }
    
            // Panggil fungsi spInsertOrUpdateRPS dari model RpsModel untuk melakukan transaksi database
            $res = RpsModel::spBk(
                $request->input('rps_id'),
                $request->input('mk_bk_id'),
            );
           
            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res) ? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
            
        }
    
        return redirect('/');
    }


    
    
    private function deleteMedia($mediaIds, $rpsId) {
        foreach ($mediaIds as $mediaId) {
           $deleted= DB::table('d_rps_media')
                ->where('rps_media_id', $mediaId)
                ->where('rps_id', $rpsId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
                // Logging untuk melihat ID yang dihapus dan status penghapusan
        Log::info("Media ID: $mediaId, Deleted Status: " . ($deleted ? 'Success' : 'Failed'));
        }

        return true;

    }

    private function deletePustaka($pustakaIds, $rpsId) {
        foreach ($pustakaIds as $pustakaId) {
            DB::table('d_rps_pustaka')
                ->where('rps_pustaka_id', $pustakaId)
                ->where('rps_id', $rpsId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
        }

        return true;

    }

    private function deletePengampu($PengampuIds, $rpsId) {
        foreach ($PengampuIds as $pengampuId) {
            DB::table('d_rps_pengampu')
                ->where('dosen_id', $pengampuId)
                ->where('rps_id', $rpsId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
        }
        return true;
    }
    private function deletePengembang($PengembangIds, $rpsId) {
        foreach ($PengembangIds as $pengembangId) {
            DB::table('d_rps_pengembang')
                ->where('dosen_id', $pengembangId)
                ->where('rps_id', $rpsId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
        }
        return true;
    }

    private function deleteCplProdi($CplProdiIds, $rpsId) {
        foreach ($CplProdiIds as $CplProdiId) {
            // Update the d_rps_cpl_prodi table
            $deleted = DB::table('d_rps_cpl_prodi')
                ->where('cpl_prodi_id', $CplProdiId)
                ->where('rps_id', $rpsId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
    
            // If the deletion is successful, proceed to update the related d_rps_cpmk entries
            if ($deleted) {
                // Get all cpl_cpmk_id related to the deleted cpl_prodi_id from t_cpl_cpmk
                $cplCpmkIds = DB::table('t_cpl_cpmk')
                    ->where('cpl_prodi_id', $CplProdiId)
                    ->pluck('cpl_cpmk_id');
    
                // Update the d_rps_cpmk table where cpl_cpmk_id is in the retrieved list
                DB::table('d_rps_cpmk')
                    ->whereIn('cpl_cpmk_id', $cplCpmkIds)
                    ->update([
                        'deleted_at' => now(),
                        'deleted_by' => auth()->user()->id
                    ]);
            }
        }
    
        return true;
    }
    

    private function deleteCpmk($CplCpmkIds, $rpsId) {
        foreach ($CplCpmkIds as $CplCpmkId) {
            $deleted=DB::table('d_rps_cpmk')
                ->where('cpl_cpmk_id', $CplCpmkId)
                ->where('rps_id', $rpsId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
                // Logging untuk melihat ID yang dihapus dan status penghapusan
       
        }

        return true;
    }

    private function deleteBk($CplBkIds, $rpsId) {
        foreach ($CplBkIds as $CplBkId) {
            $deleted=DB::table('d_rps_bk')
                ->where('mk_bk_id', $CplBkId)
                ->where('rps_id', $rpsId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
                // Logging untuk melihat ID yang dihapus dan status penghapusan
        
        }

        return true;
    }

    //=================================================================
    //================================================================
    //=========================== BAB ===============================

    public function editBab($id,$bab_id){
        $this->authAction('create || update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];
    
        
        $data = RpsBabModel::getBabById($id,$bab_id);
        $subcpmk = RpsBabModel::getSubCpmk($id);
        $subcpmkrps = RpsBabModel::getRpsSubCpmk($id,$bab_id);
        $materi = RpsModel::getBkView($id);
    
        // Log untuk memastikan parameter diterima dengan benar
        Log::info('edit1 parameters:', ['id' => $id, 'bab_id' => $bab_id]);
    
        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'bab_rps.acpertemuan')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('subcpmk', $subcpmk)
                ->with('subcpmkrps', $subcpmkrps)
                ->with('materi', $materi)
                ;
    }
    
    
    public function updateBab(Request $request, $id)
    {
        $this->authAction('create || update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        // cek untuk Insert/Update/Delete harus via AJAX
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'rps_id' => 'required|integer',
                'bab_id.*' => 'required|integer',
                'rps_bab.*' => 'required|integer',
                'sub_cpmk.*' => 'nullable|string',
                'materi.*' => 'nullable|string',
                'estimasi_waktu.*' => 'nullable|string',
                'pengalaman_belajar.*' => 'nullable|string',
                'indikator_penilaian.*' => 'nullable|string',
                'bobot_penilaian.*' => 'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
                'bentuk_pembelajaran.*' => 'nullable|string',
                'metode_pembelajaran.*' => 'nullable|string',
                'cpmk_detail_id.*' => 'nullable|integer',
                'kriteria_penilaian.*' => 'nullable|string',
                'bentuk_penilaian.*' => 'nullable|string',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'stat' => false,
                    'mc' => false,
                    'msg' => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }
    
            // Panggil fungsi spInsertOrUpdateRPS dari model RpsModel untuk melakukan transaksi database
            $res = RpsBabModel::spInsertOrUpdateBab(
                $request->input('rps_id'),
                $request->input('cpmk_detail_id'),
                $request->input('bab_id'),
                $request->input('rps_bab'),
                $request->input('sub_cpmk'),
                $request->input('materi'),
                $request->input('estimasi_waktu'),
                $request->input('pengalaman_belajar'),
                $request->input('indikator_penilaian'),
                $request->input('bobot_penilaian'),
                $request->input('bentuk_pembelajaran'),
                $request->input('metode_pembelajaran'),
                $request->input('kriteria_penilaian'),
                $request->input('bentuk_penilaian')
            );
    
            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => $res ? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        }
    
        return redirect('/');
    }
    
    public function editBabMateri($id,$bab_id){
        $this->authAction('create || update', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        $page = [
            'url' => $this->menuUrl . '/'.$id,
            'title' => 'Edit ' . $this->menuTitle
        ];
    
        
        $data = RpsBabModel::getBabMateri($id,$bab_id);
    
        // Log untuk memastikan parameter diterima dengan benar
        Log::info('edit1 parameters:', ['id' => $id, 'bab_id' => $bab_id]);
    
        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'bab_rps.acbabmateri')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data);
    }
    
    
    public function updateBabMateri(Request $request, $id)
    {
        $this->authAction('create || update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'bab_id' => 'required|integer',
                'judul_materi' => 'nullable|string',
                'file_url' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip',
                'file_dir' => 'nullable|string',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'stat' => false,
                    'mc' => false,
                    'msg' => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }
    
            $data = $request->except(['_token', '_method']);
            if ($request->hasFile('file_url')) {
                $file = $request->file('file_url');
                $originalFileName = $file->getClientOriginalName();
                $path = $file->storeAs('uploads', $originalFileName, 'public');
                $data['file_url'] = $path;
            } else {
                // Jika tidak ada file yang diunggah, gunakan nilai lama dari database
                $existingData = BabMateriModel::find($id);
                $data['file_url'] = $existingData->file_url;
            }
    
            $res = RpsBabModel::spBabMateri(
                $request->input('bab_id'),
                $request->input('judul_materi'),
                $data['file_url'], 
                $request->input('file_dir')
            );
    
            return response()->json([
                'stat' => $res,
                'mc' => $res,
                'msg' => $res ? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        }
    
        return redirect('/');
    }
}
