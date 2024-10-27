<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\CompanyProfile;
use App\Models\EmailValidation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResetPasswordCodeController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user){
            $otp = rand(100000, 999999);
            EmailValidation::updateOrCreate(
                ['email' => $user->email],
                [
                    'email' => $user->email,
                    'user_id' => $user->id,
                    'code' => $otp,
                    'expires_at' => Carbon::now()->addMinutes(120)
                ]
            );

            $company = CompanyProfile::first()            ;
            Mail::to($user->email)->send(new ResetPasswordMail($otp, $company));
            return response()->json([ 'success' => true,'message' => 'codigo correcto.'], 200);
        }else{
            return response()->json([
                'success' => false,
                "message" => "Mail no encontrado.",
                "errors" => [[
                    "status" => "404",
                    "title" => "Mail no encontrado.",
                    "detail" => "El mail ingresado no fue encontrado.",
                ]]
            ], 404);

        }
    }
}
