<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function __construct(){
        $this->menuCode  = 'SETTING.ACCOUNT';
        $this->menuUrl   = url('setting/account');
        $this->menuTitle = 'Akun Pengguna';
        $this->viewPath  = 'setting.account.';
    }

    public function index(){
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumb = [
            'title' => $this->menuTitle,
            'list'  => ['Akun Pengguna']
        ];

        $activeMenu = [
            'l1' => 'setting-account',
            'l2' => null,
            'l3' => null
        ];

        $page = [
            'url' => $this->menuUrl,
            'title' => $this->menuTitle
        ];

        return view($this->viewPath . 'index')
            ->with('breadcrumb', (object) $breadcrumb)
            ->with('activeMenu', (object) $activeMenu)
            ->with('page', (object) $page)
            ->with('allowAccess', $this->authAccessKey())
            ->with('user', Auth::user());
    }

    public function update(Request $request){
        $this->authAction('update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $user = Auth::user();
        $rules = [
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)]
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'stat' => false,
                'mc' => false,
                'msg' => 'terjadi kesalahan',
                'msgField' => $validator->errors()
            ]);
        }

        DB::beginTransaction();

        try {
            // Update username
            $user->username = $request->username;
            $user->updated_by = $user->user_id;
            $user->updated_at = now();
            $user->save();

            DB::commit();

            return response()->json([
                'stat' => true,
                'mc' => true,
                'msg' => 'Update berhasil'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'stat' => false,
                'mc' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function update_password(Request $request){
        $this->authAction('update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $user = Auth::user();
        $rules = [
            'password_old' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Password lama yang di-inputkan salah.');
                }
            }],
            'password' => ['required', 'confirmed', 'min:6', 'different:password_old']
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'stat' => false,
                'mc' => false,
                'msg' => 'terjadi kesalahan',
                'msgField' => $validator->errors()
            ]);
        }

        DB::beginTransaction();

        try {
            // Update password
            $user->password = Hash::make($request->password);
            $user->updated_by = $user->user_id;
            $user->updated_at = now();
            $user->save();

            DB::commit();

            return response()->json([
                'stat' => true,
                'mc' => true,
                'msg' => 'Update berhasil'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'stat' => false,
                'mc' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function update_avatar(Request $request){
        $this->authAction('update', 'json');
        if($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $user = Auth::user();
        $rules = [
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:125']
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'stat' => false,
                'mc' => false,
                'msg' => 'terjadi kesalahan',
                'msgField' => $validator->errors()
            ]);
        }

        DB::beginTransaction();

        try {
            // Update avatar
            if ($request->hasFile('image')) {
                if (!empty($user->avatar_dir)) {
                    Storage::disk('public')->delete($user->avatar_dir);
                }

                $imgName = time() . '-' . uniqid() . '.' . $request->image->extension();
                Storage::disk('public')->put('avatar/' . $imgName, file_get_contents($request->file('image')));

                $user->avatar_url = Storage::url('avatar/' . $imgName);
                $user->avatar_dir = 'avatar/' . $imgName;
            }

            $user->updated_by = $user->user_id;
            $user->updated_at = now();
            $user->save();

            DB::commit();

            return response()->json([
                'stat' => true,
                'mc' => true,
                'msg' => 'Update berhasil'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'stat' => false,
                'mc' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }
}
