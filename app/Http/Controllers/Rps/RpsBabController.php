<?php

namespace App\Http\Controllers\Rps;

use App\Http\Controllers\Controller;
use App\Models\BabRps\BabMateriModel;
use App\Models\Dosen\DosenModel;
use App\Models\KaprodiModel;
use App\Models\KurikulumMKModel;
use App\Models\Rps\RpsBabModel;
use App\Models\Rps\RpsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RpsBabController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'RPS.KELOLABAB';
        $this->menuUrl   = url('rps/kelola_bab');     // set URL untuk menu ini
        $this->menuTitle = 'Kelola Bab RPS';                       // set nama menu
        $this->viewPath  = 'rps.kelola_bab.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['RPS', 'Kelola Bab Rps']
        ];

        $activeMenu = [
            'l1' => 'rps',
            'l2' => 'rps-kelola_bab',
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
        $data = RpsModel::find($id);

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['RPS', 'Kelola Bab Rps']
        ];

        $activeMenu = [
            'l1' => 'rps',
            'l2' => 'rps-kelola_bab',
            'l3' => null
        ];

        $page = [
            'url' => $this->menuUrl,
            'title' => 'Daftar '. $this->menuTitle
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

        
        $data = RpsBabModel::getRpsBab($id);

        return (!$data)? $this->showModalError() :
            view($this->viewPath . 'action')
                ->with('page', (object) $page)
                ->with('id', $id)
                ->with('data', $data);
    }


//     public function update(Request $request, $id){
//         $this->authAction('create || update', 'json');
//         if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

//         // cek untuk Insert/Update/Delete harus via AJAX
//         if ($request->ajax() || $request->wantsJson()) {

//             $rules = [
//                 'rps_id' => 'required|integer',
//                 'rps_bab.*' => 'required|integer',
//                 'sub_cpmk.*'=> 'nullable|string',
//                 'materi.*'=> 'nullable|string',
//                 'estimasi_waktu.*'=> 'nullable|string',
//                 'pengalaman_belajar.*'=> 'nullable|string',
//                 'indikator_penilaian.*'=> 'nullable|string',
//                 'bobot_penilaian.*'=> 'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
//                 'bentuk_pembelajaran.*' => 'nullable|string', // New validation rule
//             'metode_pembelajaran.*' => 'nullable|string' // New validation rule
//             ];

//             $validator = Validator::make($request->all(), $rules);

//             if ($validator->fails()) {
//                 return response()->json([
//                     'stat'     => false,
//                     'mc'       => false,
//                     'msg'      => 'Terjadi kesalahan.',
//                     'msgField' => $validator->errors()
//                 ]);
//             }

//            // Panggil fungsi spInsertOrUpdateRPS dari model RpsModel untuk melakukan transaksi database
//         $res = RpsBabModel::spInsertOrUpdateBab(
//             $request->input('rps_id'),
//             $request->input('rps_bab'),
//             $request->input('sub_cpmk'),
//             $request->input('materi'),
//             $request->input('estimasi_waktu'),
//             $request->input('pengalaman_belajar'),
//             $request->input('indikator_penilaian'),
//             $request->input('bobot_penilaian'),
//             $request->input('bentuk_pembelajaran'), // Additional input for bentuk_pembelajaran
//             $request->input('metode_pembelajaran') // Additional input for metode_pembelajaran
//         );

//         return response()->json([
//             'stat' => $res,
//             'mc' => $res, // close modal
//             'msg' => ($res) ? $this->getMessage('update.success') : $this->getMessage('update.failed')
//         ]);
//     }

//     return redirect('/');
// }

public function editBab($id,$bab_id){
    $this->authAction('create || update', 'modal');
    if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

    $page = [
        'url' => $this->menuUrl . '/'.$id,
        'title' => 'Edit ' . $this->menuTitle
    ];

    
    $data = RpsBabModel::getBabById($id,$bab_id);

    // Log untuk memastikan parameter diterima dengan benar
    Log::info('edit1 parameters:', ['id' => $id, 'bab_id' => $bab_id]);

    return (!$data)? $this->showModalError() :
        view($this->viewPath . 'bab_rps.acpertemuan')
            ->with('page', (object) $page)
            ->with('id', $id)
            ->with('data', $data);
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
            'metode_pembelajaran.*' => 'nullable|string'
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
            $request->input('bab_id'),
            $request->input('rps_bab'),
            $request->input('sub_cpmk'),
            $request->input('materi'),
            $request->input('estimasi_waktu'),
            $request->input('pengalaman_belajar'),
            $request->input('indikator_penilaian'),
            $request->input('bobot_penilaian'),
            $request->input('bentuk_pembelajaran'),
            $request->input('metode_pembelajaran')
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
