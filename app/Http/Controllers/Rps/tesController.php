<?php

namespace App\Http\Controllers\Rps;

use App\Http\Controllers\Controller;
use App\Models\Dosen\DosenModel;
use App\Models\KurikulumMKModel;
use App\Models\Rps\MediaModel;
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

        $data  = RpsModel::getMkRps();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function kelolaData($id)
    {
        // Ambil data berdasarkan ID
        $data = RpsModel::find($id);

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

        // Tampilkan view yang sesuai dengan data
        return view($this->viewPath . 'master_rps.kelola_data')
        ->with('data', $data)
        ->with('breadcrumb', (object) $breadcrumb)
        ->with('activeMenu', (object) $activeMenu)
        ->with('page', (object) $page)
        ->with('allowAccess', $this->authAccessKey());
    }

    // public function create(){
    //     $this->authAction('create || update', 'modal');
    //     if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

    //     $page = [
    //         'url' => $this->menuUrl,
    //         'title' => 'Tambah ' . $this->menuTitle
    //     ];

    //     $kaprodi = KaprodiModel::selectRaw("kaprodi_id, prodi_id, tahun")->get();
    //     $kurikulumk  = KurikulumMKModel::getMks();

    //     return view($this->viewPath . 'action')
    //         ->with('page', (object) $page)
    //         ->with('kaprodi', $kaprodi)
    //         ->with('kurikulumk', $kurikulumk);
    // }


    // public function store(Request $request){
    //     $this->authAction('create || update', 'json');
    //     if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

    //     if ($request->ajax() || $request->wantsJson()) {

    //         $rules = [
    //             'kaprodi_id' => 'required|integer',
    //             'kurikulum_mk_id' => 'required|integer',
    //             'deskripsi_rps' => 'required|string',
    //             'tanggal_penyusunan' => 'required|date',
    //         ];

    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'stat'     => false,
    //                 'mc'       => false,
    //                 'msg'      => 'Terjadi kesalahan.',
    //                 'msgField' => $validator->errors()
    //             ]);
    //         }

    //         $res = RpsModel::insertData($request);

    //         return response()->json([
    //             'stat' => $res,
    //             'mc' => $res, // close modal
    //             'msg' => ($res)? $this->getMessage('insert.success') : $this->getMessage('insert.failed')
    //         ]);

    //     }

    //     return redirect('/');
    // }

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

    public function edit1($id){
        
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


    public function update1(Request $request, $id){
        if (!$request->isMethod('post')) {
            return response()->json(['error' => 'Method not allowed'], 405);
        }
    
        Log::info('Method: ' . $request->method());
        Log::info('Request data: ' . json_encode($request->all()));
        
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
            $this->deletePengampu($request->input('elements_pengampu'));
        }

        if ($request->has('elements_pengembang')) {
            $this->deletePengembang($request->input('elements_pengembang'));
        }

        if ($request->has('elements_cpl_prodi')) {
            $this->deleteCplProdi($request->input('elements_cpl_prodi'));
        }

        if ($request->has('elements_cpmk')) {
            $this->deleteCpmk($request->input('elements_cpmk'));
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
    
    private function deleteMedia($mediaIds) {
        foreach ($mediaIds as $mediaId) {
            DB::table('d_rps_media')
                ->where('rps_media_id', $mediaId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
                // Logging untuk melihat ID yang dihapus dan status penghapusan
        // Log::info("Media ID: $mediaId, Deleted Status: " . ($deleted ? 'Success' : 'Failed'));
        }

        return true;

    }

    private function deletePustaka($pustakaIds) {
        foreach ($pustakaIds as $pustakaId) {
            DB::table('d_rps_pustaka')
                ->where('rps_pustaka_id', $pustakaId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
        }

        return true;

    }

    private function deletePengampu($PengampuIds) {
        foreach ($PengampuIds as $pengampuId) {
            DB::table('d_rps_pengampu')
                ->where('rps_pengampu_id', $pengampuId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
                // Logging untuk melihat ID yang dihapus dan status penghapusan
        // Log::info("Media ID: $mediaId, Deleted Status: " . ($deleted ? 'Success' : 'Failed'));
        }

        return true;

    }

    private function deletePengembang($PengembangIds) {
        foreach ($PengembangIds as $pengembangId) {
            DB::table('d_rps_pengembang')
                ->where('rps_pengembang_id', $pengembangId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
                // Logging untuk melihat ID yang dihapus dan status penghapusan
        // Log::info("Media ID: $mediaId, Deleted Status: " . ($deleted ? 'Success' : 'Failed'));
        }

        return true;

    }

    private function deleteCplProdi($CplProdiIds) {
        foreach ($CplProdiIds as $CplProdiId) {
            $deleted=DB::table('d_rps_cpl_prodi')
                ->where('cpl_prodi_id', $CplProdiId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
                // Logging untuk melihat ID yang dihapus dan status penghapusan
        
        }

        return true;
    }

    private function deleteCpmk($CplCpmkIds) {
        foreach ($CplCpmkIds as $CplCpmkId) {
            $deleted=DB::table('d_rps_cpmk')
                ->where('cpl_cpmk_id', $CplCpmkId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
                // Logging untuk melihat ID yang dihapus dan status penghapusan
       
        }

        return true;
    }

    private function deleteBk($CplBkIds) {
        foreach ($CplBkIds as $CplBkId) {
            $deleted=DB::table('d_rps_bk')
                ->where('mk_bk_id', $CplBkId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
                // Logging untuk melihat ID yang dihapus dan status penghapusan
        
        }

        return true;
    }
}
