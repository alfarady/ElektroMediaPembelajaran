<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Kecamatan;
use App\Desa;
use App\Dusun;
use App\Kelas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            JWTAuth::factory()->setTTL(1440);
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email atau password salah',
                    'data' => [
                        'credentials' => 'Email atau password salah'
                    ]
                ], 403);
            }
            
            $user = User::where('email', $credentials['email'])
                    ->select([
                        'id',
                        'name',
                        'email',
                        'kelas_id'
                    ])
                    ->with(['kelas' => function($q) {
                        $q->select(['id', 'name']);
                    }])
                    ->first();

            if(!$user->hasRole('User')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Hanya user yang diperbolehkan',
                    'data' => [
                        'credentials' => 'Hanya user yang diperbolehkan'
                    ]
                ], 403);
            }

            $user->jwt = $token;
            $user->role = $user->getRoles()[0];
            unset($user->roles);
            
            return response()->json([
                'status' => true,
                'message' => 'Login berhasil',
                'data' => $user
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Email atau password salah',
                'data' => [
                    'credentials' => 'Email atau password salah'
                ]
            ], 403);
        }
    }

    public function register(Request $request)
    {
        $input = $request->only(['name', 'username', 'password', 'kelas_id']);

        if(User::where('email', $input['username'])->first()) {
            return response()->json([
                'status' => false,
                'message' => 'Username telah tersedia',
                'data' => []
            ], 500);
        }

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['username'],
            'password' => app('hash')->make($input['password']),
            'kelas_id' => $input['kelas_id']
        ]);

        $user->roles()->sync(2);
        
        JWTAuth::factory()->setTTL(1440);
        $token = JWTAuth::fromUser($user);
            
        $user = User::where('id', $user->id)
            ->select([
                'id',
                'name',
                'email',
                'kelas_id'
            ])
            ->with(['kelas' => function($q) {
                $q->select(['id', 'name']);
            }])
            ->first();

        $user->jwt = $token;
        
        return response()->json([
            'status' => true,
            'message' => 'Register berhasil',
            'data' => $user
        ]);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
 
            return response()->json([
                'status' => true,
                'message' => 'Logout berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Maaf, user tidak dapat logout',
                'data' => [
                    'token' => 'Token tidak berlaku'
                ]
            ], 500);
        }
    }

    public function getKelas()
    {
        $data = new Kelas();
        return $this->respondArray($data);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }
}