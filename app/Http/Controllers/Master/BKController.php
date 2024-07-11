<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\BKModel;
use App\Models\Master\JurusanModel;
use App\Models\Master\MediaModel;
use App\Models\Master\ProdiModel;
use App\Models\MKModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BKController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'MASTER.BK';
        $this->menuUrl   = url('master/bk');     // set URL untuk menu ini
        $this->menuTitle = 'Kelola Bahan Kajian';                       // set nama menu
        $this->viewPath  = 'master.bk.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Data Master', 'Bahan Kajian']
        ];

        $activeMenu = [
            'l1' => 'master',
            'l2' => 'master-bk',
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

        $data  = BKModel::bktampil();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }


    public function create(){
        $this->authAction('create', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Tambah ' . $this->menuTitle
        ];

        $prodi = ProdiModel::selectRaw('prodi_id, nama_prodi')->get();
        $mk = MKModel::selectRaw('mk_id, mk_nama')->get();

        return view($this->viewPath . 'action')
            ->with('page', (object) $page)
            ->with('prodi', $prodi)
            ->with('mk', $mk)
            ;
    }


    public function store(Request $request)
    {
        $this->authAction('create', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'prodi_id' => 'required|integer|exists:m_prodi,prodi_id',
                'mk_id' => 'required|integer|exists:m_mk,mk_id',
                'bk_kode' => 'required|string|max:100',
                'bk_deskripsi' => 'required|string|max:255',
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

            $res = BKModel::insertDatabk($request);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => ($res) ? $this->getMessage('insert.success') : $this->getMessage('insert.failed')
            ]);

        }

        return redirect('/');
    }

    public function edit($id)
{
    $this->authAction('update', 'modal');
    if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

    $page = [
        'url' => $this->menuUrl . '/' . $id,
        'title' => 'Edit ' . $this->menuTitle
    ];

    $data = BKModel::getDataForEdit($id);
    // Log::info('Data Retrieved: ', (array)$data);

    $prodi = ProdiModel::all();
    $mk = MKModel::all();

    return (!$data) ? $this->showModalError() :
        view($this->viewPath . 'action')
            ->with('page', (object)$page)
            ->with('id', $id)
            ->with('data', $data)
            ->with('prodi', $prodi)
            ->with('mk', $mk);
}



public function update(Request $request, $id)
{
    $this->authAction('update', 'json');
    if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

    if ($request->ajax() || $request->wantsJson()) {

        $rules = [
            'prodi_id' => 'required|integer|exists:m_prodi,prodi_id',
            'mk_id' => 'required|integer|exists:m_mk,mk_id',
            'bk_kode' => 'required|string|max:100',
            'bk_deskripsi' => 'required|string|max:255',
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

        $prodi_id = $request->input('prodi_id');
        $mk_id = $request->input('mk_id');
        $bk_kode = $request->input('bk_kode');
        $bk_deskripsi = $request->input('bk_deskripsi');

        $res = BKModel::updateData($id, $prodi_id, $mk_id, $bk_kode, $bk_deskripsi);

        return response()->json([
            'stat' => $res,
            'mc' => $res, // close modal
            'msg' => ($res) ? $this->getMessage('update.success') : $this->getMessage('update.failed')
        ]);
    }

    return redirect('/');
}


    public function show($id){
        $this->authAction('read', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = ProdiModel::find($id);
        $page = [
            'title' => 'Detail ' . $this->menuTitle
        ];

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'detail')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data);
    }


    public function confirm($id){
        $this->authAction('delete', 'modal');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = BKModel::find($id);

        return (!$data)? $this->showModalError() :
            $this->showModalConfirm($this->menuUrl.'/'.$id, [
                'Deskripsi' => $data->bk_deskripsi,
            ]);
    }

    public function destroy(Request $request, $id){
        $this->authAction('delete', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $res = BKModel::deleteData($id);

            return response()->json([
                'stat' => $res,
                'mc' => $res, // close modal
                'msg' => BKModel::getDeleteMessage()
            ]);
        }

        return redirect('/');
    }
}
