<?php

namespace App\Http\Controllers\Kakel;

use App\Http\Controllers\Controller;
use App\Models\Dosen\DosenModel;
use App\Models\Kakel\KakelModel;
use App\Models\KaprodiModel;
use App\Models\KurikulumMKModel;
use App\Models\Rps\RpsBabModel;
use App\Models\Rps\RpsModel;
use App\Models\View\RpsView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF as PDF;
use Yajra\DataTables\Facades\DataTables;

class KakelController extends Controller
{
    
    public function __construct(){
        $this->menuCode  = 'KAKEL.AKTIVASI';
        $this->menuUrl   = url('kakel/aktivasi');     // set URL untuk menu ini
        $this->menuTitle = 'Aktivasi Kakel';                       // set nama menu
        $this->viewPath  = 'kakel.aktivasi.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['KAKEL', 'Aktivasi Kakel']
        ];

        $activeMenu = [
            'l1' => 'kakel',
            'l2' => 'kakel-aktivasi',
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
    
        $data = KakelModel::getListKakel();
    
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    

    public function create() {
        $this->authAction('create || update', 'modal');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        $page = [
            'url' => $this->menuUrl,
            'title' => 'Tambah ' . $this->menuTitle
        ];
    
        $dosenData = KakelModel::getdosenkakel();
    
        return view($this->viewPath . 'action')
            ->with('page', (object) $page)
            ->with('dosenData', $dosenData);
    }
    


    public function store(Request $request) {
        $this->authAction('create || update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();
    
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'is_kakel' => 'required|array',
                'is_kakel.*' => 'in:0,1',
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
    
            $is_kakel = $request->input('is_kakel');
    
            KakelModel::updateIsKakel($is_kakel);
    
            return response()->json([
                'stat' => true,
                'mc' => true, // close modal if successful
                'msg' => $this->getMessage('insert.success')
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

    public function edit($id)
{
    $this->authAction('update', 'modal');
    if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

    $page = [
        'url' => $this->menuUrl . '/' . $id,
        'title' => 'Edit ' . $this->menuTitle
    ];

    $data = KakelModel::getEditKakel($id);
    $allMataKuliah = KakelModel::getAllMataKuliah();
    $allDosen = KakelModel::getAllDosen();
    $selectedMataKuliah = KakelModel::getSelectedKakelMK($id);

    $periode = session('periode');

    if (!$data) {
        $data = (object)[
            'm_kakel_id' => $id,
            'dosen_id' => null,
            'kurikulum_mk_id' => null,
            'jabatan' => null
        ];
    }

    return view($this->viewPath . 'action')
        ->with('page', (object) $page)
        ->with('id', $id)
        ->with('data', $data)
        ->with('allMataKuliah', $allMataKuliah)
        ->with('allDosen', $allDosen)
        ->with('selectedMataKuliah', $selectedMataKuliah)
        ->with('periode', $periode);
}


    public function update(Request $request, $id)
    {
        $this->authAction('create || update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'dosen_id' => 'required|integer',
                'kurikulum_mk_id' => 'nullable|array',
                'kurikulum_mk_id.*' => 'integer',
                'elements_kakel1' => 'nullable|array',
                'elements_kakel1.*' => 'integer'
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

            // Tambahkan periode_id dari sesi ke dalam request
            $periode = session('periode');
            if ($periode && isset($periode->periode_id)) {
                $request->merge(['periode_id' => $periode->periode_id]);
            }

            if ($request->has('elements_kakel1')) {
                KakelModel::deleteKakelMK($request->input('elements_kakel1'), $id);
            }

            $res = KakelModel::updateDataKakel($id, $request);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res) ? $this->getMessage('update.success') : $this->getMessage('update.failed')
            ]);
        }

        return redirect('/');
    }
}