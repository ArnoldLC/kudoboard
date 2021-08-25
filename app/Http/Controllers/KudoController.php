<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Kudo;
use App\Models\Kudoboard;

class KudoController extends Controller
{
    //
    public function createKudo(Request $request, $id) {
        if ( !Auth::check() ) {
            return response()->json([
                "errors" => "Usuario no autenticado"
            ]);
        }
        
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'descripcion' => 'required'
        ]);

        if ( $validator->fails() ) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $kudo = [];
        $kudo['descripcion'] = $request['descripcion'];
        $kudo['user_id'] = $user->id;
        $kudo['kudoboard_id'] = $id;

        $kudo = Kudo::create($kudo);
        return response()->json([
            "kudo" => $kudo
        ]);
    }

    public function getKudos($id) {
        if ( !Auth::check() ) {
            return response()->json([
                "errors" => "Usuario no autenticado"
            ]);
        }
        
        $user = Auth::user();

        $kudoboard = Kudoboard::find($id);
        $kudos = $kudoboard->kudos()->with('user')->get()->toArray();

        return response()->json([
            "kudos" => $kudos
        ]);
    }

    public function editarKudo(Request $request, $kudo_id) {
        if ( !Auth::check() ) {
            return response()->json([
                "errors" => "Usuario no autenticado"
            ]);
        }

        $user = Auth::user();

        if ( !Kudo::find($kudo_id) ) {
            return response()->json([
                "errors" => "El kudo no existe"
            ], 404);
        }

        $kudo = Kudo::find($kudo_id);

        if ( $user->id !== (int)$kudo->user_id) {
            return response()->json([
                "errors" => "Usted no ha creado este kudo"
            ]);
        }

        $kudo['descripcion'] = $request['descripcion'];
        $kudo->save();

        return response()->json([
            "kudo" => $kudo
        ]);
    }

    public function deleteKudo($kudo_id) {
        if ( !Auth::check() ) {
            return response()->json([
                "errors" => "Usuario no autenticado"
            ]);
        }

        $kudo = Kudo::find($kudo_id);
        $kudo->delete();
        
        return response()->json([
            "message" => "Kudo eliminado con éxito"
        ]);
    }
}
