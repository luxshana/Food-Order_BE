<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthenticationController extends Controller
{
    /**
     * Register a new account.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|min:4',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'Confirm_password' => 'required|string|min:8',
        ]);

        try {
            $user = new User();
            $user->name      = $request->name;
            $user->email     = $request->email;
            $user->password  = Hash::make($request->password);
            $user->Confirm_password = Hash::make($request->Confirm_password);
            $user->save();

            return response()->json([
                'response_code' => 201,
                'status'        => 'success',
                'message'       => 'Successfully registered',
            ], 201);

        } catch (\Exception $e) {
            Log::error('Registration Error: ' . $e->getMessage());

            return response()->json([
                'response_code' => 500,
                'status'        => 'error',
                'message'       => 'Registration failed',
            ], 500);
        }
    }

    /**
     * Login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $otp  = rand(100000, 999999);

                $user->otp = $otp;
                $user->otp_expires_at = now()->addMinutes(10);
                $user->save();

                Log::info("Login OTP for {$user->email}: {$otp}");

                return response()->json([
                    'response_code' => 200,
                    'status'        => 'success',
                    'message'       => 'OTP sent successfully',
                    'user_id'       => $user->id,
                ]);
            }

            return response()->json([
                'response_code' => 401,
                'status'        => 'error',
                'message'       => 'Unauthorized',
            ], 401);

        } catch (\Exception $e) {
            Log::error('Login Error: ' . $e->getMessage());

            return response()->json([
                'response_code' => 500,
                'status'        => 'error',
                'message'       => 'Login failed',
            ], 500);
            
        }
    }

    /**
     * Get paginated user list (authenticated).
     */
    public function userInfo()
    {
        try {
            $users = User::latest()->paginate(10);

            return response()->json([
                'response_code'  => 200,
                'status'         => 'success',
                'message'        => 'Fetched user list successfully',
                'data_user_list' => $users,
            ]);
        } catch (\Exception $e) {
            Log::error('User List Error: ' . $e->getMessage());

            return response()->json([
                'response_code' => 500,
                'status'        => 'error',
                'message'       => 'Failed to fetch user list',
            ], 500);
        }
    }

   
    public function logOut(Request $request)
    {
        try {
            if (Auth::check()) {
                Auth::user()->tokens()->delete();

                return response()->json([
                    'response_code' => 200,
                    'status'        => 'success',
                    'message'       => 'Successfully logged out',
                ]);
            }

            return response()->json([
                'response_code' => 401,
                'status'        => 'error',
                'message'       => 'User not authenticated',
            ], 401);
        } catch (\Exception $e) {
            Log::error('Logout Error: ' . $e->getMessage());

            return response()->json([
                'response_code' => 500,
                'status'        => 'error',
                'message'       => 'An error occurred during logout',
            ], 500);
        }
    }


    /**
     * Verify the provided OTP.
     */
    public function verifyOtp(Request $request)
    {
       
        if (!$request->has('otp') && $request->has('otp1')) {
            $otp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4 . $request->otp5 . $request->otp6;
            $request->merge(['otp' => $otp]);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp'     => 'required|string|size:6',
        ]);

        try {
            $user_id = $request->user_id;
            $otp     = $request->otp;

            $user = User::where('id', $user_id)
                ->where('otp', $otp)
                ->first();

            if (!$user) {
                Log::warning("Verification failed: User ID {$user_id} with OTP {$otp} not found.");
                return response()->json([
                    'response_code' => 400,
                    'status'        => 'error',
                    'message'       => 'Invalid OTP',
                ], 400);
            }

            // Check expiration separately for better error messaging
            if ($user->otp_expires_at && $user->otp_expires_at->isPast()) {
                Log::warning("Verification failed: OTP for User ID {$user_id} has expired at {$user->otp_expires_at}. Current time: " . now());
                return response()->json([
                    'response_code' => 400,
                    'status'        => 'error',
                    'message'       => 'OTP has expired',
                ], 400);
            }

            Log::info("User {$user->email} verified successfully.");

            $user->is_verified = true;
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'response_code' => 200,
                'status'        => 'success',
                'message'       => 'Login successful',
                'token'         => $token,
                'user_info'     => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                ],
            ]);

        } catch (\Exception $e) {
            Log::error('Verify OTP Error: ' . $e->getMessage());

            return response()->json([
                'response_code' => 500,
                'status'        => 'error',
                'message'       => 'An error occurred during verification',
            ], 500);
        }
    }
}