<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    /**
 * Change the password of the authenticated user.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse
 */
public function changePassword(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'current_password' => 'required|string|min:6',
        'new_password' => 'required|string|min:6|confirmed', // Pastikan konfirmasi password cocok
    ]);

    // Jika validasi gagal, kirimkan respons error
    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Input tidak valid',
            'errors' => $validator->errors()
        ], 400);
    }

    // Ambil user yang sedang terautentikasi
    $user = auth()->user();

    // Verifikasi kata sandi saat ini
    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Kata sandi saat ini salah.'
        ], 400);
    }

    // Update kata sandi ke yang baru
    $user->password = Hash::make($request->new_password);
    $user->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Kata sandi berhasil diubah.'
    ]);
}

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Jika validasi gagal, kirimkan respons error
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Input tidak valid',
                'errors' => $validator->errors()
            ], 400);
        }

        // Cek apakah email terdaftar di database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email tidak terdaftar'
            ], 404);
        }

        // Cek apakah password yang dimasukkan benar
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kata sandi yang anda masukan salah.'
            ], 400);
        }

        // Jika email dan password benar, buatkan token JWT
        if (!$token = auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 401);
        }

        // Kembalikan respons sukses dengan token
        return $this->respondWithToken($token, $user);
    }


    public function register()
    {
        $credentials = request(['name','email', 'password']);
        $credentials['password'] = bcrypt($credentials['password']);
        User::create($credentials);

        return response()->json('success');
    }

    public function getUserData()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not authenticated'
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }




    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,

                ]
            ]
        ]);
    }
}