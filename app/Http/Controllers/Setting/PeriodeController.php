<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Master\JurusanModel;
use App\Models\Setting\PeriodeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PeriodeController extends Controller
{
    public function __construct()
    {
        $this->menuCode  = 'SETTING.PERIODE';                // kode menu, sesuai dengan code di DB
        $this->menuUrl   = url('setting/periode');           // set URL untuk menu ini
        $this->menuTitle = 'Setting - Periode';              // set nama menu
        $this->viewPath  = 'setting.periode.';               // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index()
    {
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Setting', 'Periode']
        ];

        $activeMenu = [
            'l1' => 'setting',           
            'l2' => 'setting-periode',   
            'l3' => null                 
        ];

        $page = [
            'url' => $this->menuUrl,
            'title' => $this->menuTitle
        ];

        $this->setPeriodeSession();

        $periodes = PeriodeModel::select('periode_id', 'periode_name', 'periode_semester', 'is_active')->get();

        return view($this->viewPath . 'index2')
            ->with('breadcrumb', (object) $breadcrumb)
            ->with('activeMenu', (object) $activeMenu)
            ->with('page', (object) $page)
            ->with('periodes', $periodes)
            ->with('allowAccess', $this->authAccessKey());
    }

    public function update(Request $request)
    {
        $this->authAction('update', 'json');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {
            // Log the request data
            Log::info('Update Request Data: ', $request->all());

            $rules = [
                'periode_id' => 'required|integer|exists:m_periode,periode_id',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                // Log the validation errors
                Log::error('Validation Errors: ', $validator->errors()->toArray());

                return response()->json([
                    'stat'     => false,
                    'mc'       => false,
                    'msg'      => 'Terjadi kesalahan.',
                    'msgField' => $validator->errors()
                ]);
            }

            // Reset is_active to 0 for all periods
            PeriodeModel::where('is_active', 1)->update(['is_active' => 0]);

            // Log after resetting all periods
            Log::info('All periods reset to is_active = 0');

            // Set is_active to 1 for the selected period
            $periode = PeriodeModel::find($request->periode_id);
            if ($periode) {
                $periode->is_active = 1;
                $periode->save();

                // Log after updating the selected period
                Log::info('Updated Periode: ', $periode->toArray());

                return response()->json([
                    'stat' => true,
                    'mc' => true,
                    'msg' => 'Periode berhasil diubah.'
                ]);
            } else {
                // Log if periode is not found
                Log::error('Periode not found with ID: ' . $request->periode_id);

                return response()->json([
                    'stat' => false,
                    'mc' => false,
                    'msg' => 'Periode tidak ditemukan.'
                ]);
            }
        }

        return redirect('/');
    }
}