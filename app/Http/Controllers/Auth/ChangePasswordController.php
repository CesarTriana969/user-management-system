<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\EmailValidation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function __invoke(ChangePasswordRequest $request)
    {
        $passwordReset = EmailValidation::where([
            ['email', $request->email],
            ['code', $request->code],
        ])->first();

        if (isset($passwordReset)) {
            if($request->has('password')){
                $user = User::where('email', $passwordReset->email)->first();
                
                if(Hash::check($request->password, $user->password)){
                    return response()->json([
                        'success' => false,
                        'message' => 'The new password cannot be the same as the old password',
                        'errors' => [
                            'same_password' =>  [ 'The new password cannot be the same as the old password' ]
                        ]
                    ], 401);
                }
                
                $user->password = Hash::make($request->password);
                $user->save();

                $passwordReset->delete();
                // self::sendPasswordConfirmationMessage($user, $request->place, $request->device);

                return back()->withSuccess('Password changed successfully!');
            }else{
                return response()->json([
                    'success' => true,
                    'message' => 'Enter the password'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Invalid code.',
                'errors' => [
                    'code' =>  [ 'Invalid code.' ]
                ]
            ], 422);
        }
    }
}
