<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_card_number' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'ID Card Number or Password incorrect'
                ], 401);
            }

            $idCardNumber = $request->id_card_number;
            $password = $request->password;

            $user = User::where('id_card_number', $idCardNumber)->where('password', md5($password))->first();

            if ($user) {
                if (md5($idCardNumber) === $user->password) {
                    Auth::login($user);

                    $token = md5($idCardNumber);
                    $cekRegional = DB::table('indonesia_provinces')
                        ->where('id', $user->province_id)
                        ->first();
                    $cekDistrict = DB::table('indonesia_cities')
                        ->where('id', $user->district_id)
                        ->first();
                    $updateToken = DB::table('users')->where('id', $user->id)->update([
                        'token' => $token
                    ]);
                    return response()->json([
                        'name' => $user->name,
                        'born_date' => $user->{'born-date'},
                        'gender' => $user->gender,
                        'address' => $user->address,
                        'token' => $token,
                        'regional' => [
                            'id' => $cekRegional->id,
                            'province' => $cekRegional->name,
                            'district' => $cekDistrict->name,
                        ],
                    ]);
                }
            }

            return response()->json([
                'message' => 'ID Card Number or Password incorrect'
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'ID Card Number or Password incorrect'
            ], 401);
        }
    }

    public function logout()
    {
        try {
            $user = Auth::guard('api')->user();
            $user->update(['token' => '']);

            return response()->json([
                'message' => 'Logout success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Logout failed'
            ], 401);
        }
    }
}
