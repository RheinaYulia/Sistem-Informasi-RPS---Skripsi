<?php

namespace App\Http\Controllers\Rps;

use App\Http\Controllers\Controller;
use App\Models\KaprodiModel;
use App\Models\KurikulumMKModel;
use App\Models\Rps\PengesahanModel;
use App\Models\Rps\RpsBabModel;
use App\Models\Rps\RpsModel;
use App\Models\View\RpsView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PengesahanController extends Controller
{
    
    public function __construct(){
        $this->menuCode  = 'PENGESAHAN.RPS';
        $this->menuUrl   = url('rps/pengesahan');     // set URL untuk menu ini
        $this->menuTitle = 'Pengesahan RPS';                       // set nama menu
        $this->viewPath  = 'rps.pengesahan.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['RPS', 'Pengesahan']
        ];

        $activeMenu = [
            'l1' => 'pengesahan',
            'l2' => 'pengesahan-rps',
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
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        // Ambil prodi_id dari pengguna yang sedang login
        $user = auth()->user(); // Pastikan Anda menggunakan mekanisme yang benar untuk mendapatkan user yang sedang login
        $user_id = $user->user_id;

        if ($user_id == 1) {
            // Ambil semua data tanpa filter prodi_id jika user_id adalah 1
            $data = PengesahanModel::getAllMkRpsSah();
        } else {
        $dosen = DB::table('d_dosen')->where('user_id', $user_id)->first();
        if (!$dosen) {
            return response()->json(['data' => []]); // Return empty data if no dosen record found
        }
    
        $kaprodi = DB::table('d_kaprodi')->where('dosen_id', $dosen->dosen_id)->first();
        if (!$kaprodi) {
            return response()->json(['data' => []]); // Return empty data if no kaprodi record found
        }
    
        $prodi_id = $kaprodi->prodi_id;
    
        $data = PengesahanModel::getMkRpsSah($prodi_id);
    }
    
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
        $this->authAction('read', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = RpsModel::getRpsDescription($id);
        $mediaview = RpsModel::getRpsMedia($id);
        $bab = RpsBabModel::getRpsBab($id);
        $pengembang = RpsModel::getPengembang($id);
        $cplprodi = RpsModel::getCplProdiview($id);
        $pengampuview = RpsModel::getRpsPengampuView($id);
        $cpmkview = RpsModel::getCpmkView($id);
        $bkview = RpsModel::getBkView($id);
        $pustaka = RpsModel::getRpsPustaka($id);
        $mksyarat = RpsModel::getRpsMkView($id);

        // Get show_percentage from session if available
    $show_percentage = session('show_percentage', []);


        $page = [
            'title' => 'Detail ' . $this->menuTitle
        ];

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'detail')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('mediaview', $mediaview)
                ->with('pengembang', $pengembang)
                ->with('cplprodi', $cplprodi)
                ->with('pengampuview', $pengampuview)
                ->with('cpmkview', $cpmkview)
                ->with('bkview', $bkview)
                ->with('pustaka', $pustaka)
                ->with('bab', $bab)
                ->with('mksyarat',$mksyarat)
                ->with('show_percentage', $show_percentage);
                ;
    }

    public function shows($id){
        $this->authAction('read', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = RpsModel::getRpsDescription($id);
        $mediaview = RpsModel::getRpsMedia($id);
        $bab = RpsBabModel::getRpsBab($id);
        $pengembang = RpsModel::getPengembang($id);
        $cplprodi = RpsModel::getCplProdiview($id);
        $pengampuview = RpsModel::getRpsPengampuView($id);
        $cpmkview = RpsModel::getCpmkView($id);
        $bkview = RpsModel::getBkView($id);
        $pustaka = RpsModel::getRpsPustaka($id);
        $mksyarat = RpsModel::getRpsMkView($id);


        $page = [
            'title' => 'Detail ' . $this->menuTitle
        ];

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'cetak-rps')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('mediaview', $mediaview)
                ->with('pengembang', $pengembang)
                ->with('cplprodi', $cplprodi)
                ->with('pengampuview', $pengampuview)
                ->with('cpmkview', $cpmkview)
                ->with('bkview', $bkview)
                ->with('pustaka', $pustaka)
                ->with('bab', $bab)
                ->with('mksyarat',$mksyarat)
                ;
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
            'title' => 'Proses Pengesahan'
        ];

        $data  = PengesahanModel::find($id);
        
        $kaprodi = KaprodiModel::selectRaw("kaprodi_id, prodi_id, tahun")->get();
        $kurikulumkId = KurikulumMKModel::getMksId($id)->first();

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'action')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data)
                ->with('kaprodi', $kaprodi)
            ->with('kurikulumkId', $kurikulumkId);
    }


    public function update(Request $request, $id){
        $this->authAction('update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'pengesahan' => 'required|integer',
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

            $res = PengesahanModel::updateData($id, $request);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res)? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        }

        return redirect('/');
    }
}