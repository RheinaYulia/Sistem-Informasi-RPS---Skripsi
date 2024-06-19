<?php

namespace App\Http\Controllers\Rps;

use App\Http\Controllers\Controller;
use App\Models\KaprodiModel;
use App\Models\KurikulumMKModel;
use App\Models\Rps\RpsBabModel;
use App\Models\Rps\RpsModel;
use App\Models\View\RpsView;
use PDF as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RpsController extends Controller
{
    
    public function __construct(){
        $this->menuCode  = 'RPS.KELOLARPS';
        $this->menuUrl   = url('rps/kelola_rps');     // set URL untuk menu ini
        $this->menuTitle = 'Kelola RPS';                       // set nama menu
        $this->viewPath  = 'rps.kelola_rps.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['RPS', 'Kelola RPS']
        ];

        $activeMenu = [
            'l1' => 'rps',
            'l2' => 'rps-kelola_rps',
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
                'keterangan_rps' => 'nullable|string',
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

    // public function shows1($id){
    //     $this->authAction('read', 'modal');
    //     if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

    //     $data = RpsModel::getRpsDescription($id);
    //     $mediaview = RpsModel::getRpsMedia($id);
    //     $bab = RpsBabModel::getRpsBab($id);
    //     $pengembang = RpsModel::getPengembang($id);
    //     $cplprodi = RpsModel::getCplProdiview($id);
    //     $pengampuview = RpsModel::getRpsPengampuView($id);
    //     $cpmkview = RpsModel::getCpmkView($id);
    //     $bkview = RpsModel::getBkView($id);
    //     $pustaka = RpsModel::getRpsPustaka($id);

    //     $page = [
    //         'title' => 'Detail ' . $this->menuTitle
    //     ];

    //     $pdf = PDF::loadView($this->viewPath .'cetak-rps', compact(
    //         'page', 'id', 'data', 'mediaview', 'pengembang', 'cplprodi', 'pengampuview', 'cpmkview', 'bkview', 'pustaka', 'bab'
    //     ));

    //     return $pdf->download('RPS.pdf');
    // }

    // public function shows2($id){
    //     $this->authAction('read', 'modal');
    //     if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

    //     $data = RpsModel::getRpsDescription($id);
    //     $mediaview = RpsModel::getRpsMedia($id);
    //     $bab = RpsBabModel::getRpsBab($id);
    //     $pengembang = RpsModel::getPengembang($id);
    //     $cplprodi = RpsModel::getCplProdiview($id);
    //     $pengampuview = RpsModel::getRpsPengampuView($id);
    //     $cpmkview = RpsModel::getCpmkView($id);
    //     $bkview = RpsModel::getBkView($id);
    //     $pustaka = RpsModel::getRpsPustaka($id);

    //     $page = [
    //         'title' => 'Detail ' . $this->menuTitle
    //     ];

    //     $html = view($this->viewPath .'cetak-rps', compact(
    //         'page', 'id', 'data', 'mediaview', 'pengembang', 'cplprodi', 'pengampuview', 'cpmkview', 'bkview', 'pustaka', 'bab'
    //     ))->render();
    
    //     $mpdf = new \Mpdf\Mpdf([
    //         'orientation' => 'L'
    //     ]);
    //     $mpdf->WriteHTML($html);
    //     $mpdf->Output('RPS.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    // }



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
                'deskripsi_rps' => 'nullable|string',
                'tanggal_penyusunan' => 'required|date',
                'keterangan_rps'=>'nullable|string',
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