<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailValidation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckEmailCodeController extends Controller
{
    public function __invoke(Request $request){
        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'code' => 'required|integer',
            ]
        );

        $emailValidation = EmailValidation::where([
            ['email', $request->email],
            ['code', $request->code],
            ['expires_at', '>', Carbon::now()],
        ])->first();

        if (isset($emailValidation)) {
            return response()->json([ 'success' => true,'message' => 'Correo y codigo correctos.'], 200);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'El código ingresado es inválido.'
            ], 422);
        }
    }

}
