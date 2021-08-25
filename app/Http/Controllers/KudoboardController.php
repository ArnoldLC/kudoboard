<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Kudoboard;

class KudoboardController extends Controller
{
    //

    public function create(Request $request) {
        if ( !Auth::check() ) {
            return response()->json([
                "errors" => "Usuario no autorizado"
            ], 401);
        }

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'receptor' => 'required',
            'titulo' => 'required'
        ]);

        if ( $validator->fails() ) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $kudoboard = [];
        $kudoboard['receptor'] = $request['receptor'];
        $kudoboard['titulo'] = $request['titulo'];
        $kudoboard['user_id'] = $user->id;
        $kudoboard = Kudoboard::create($kudoboard);
        return response()->json([
            "kudoboard" => $kudoboard
        ]);
    }

    public function getKudoboards() {
        if ( !Auth::check() ) {
            return response()->json([
                "errors" => "Usuario no autorizado"
            ], 401);
        }

        $user = Auth::user();
        
        $kudoboards = $user->kudoboards()->get()->toArray();

        return response()->json([
            "kudoboards" => $kudoboards
        ]);
    }

    public function editKudoboard(Request $request, $id) {
        if ( !Auth::check() ) {
            return response()->json([
                "errors" => "Usuario no autorizado"
            ], 401);
        }

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'receptor' => 'required',
            'titulo' => 'required'
        ]);

        if ( $validator->fails() ) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $kudoboard = Kudoboard::find($id);
        $kudoboard->titulo = $request['titulo'];
        $kudoboard->receptor = $request['receptor'];
        $kudoboard->save();

        return response()->json([
            'kudoboard' => $kudoboard
        ]);
    }

    public function getKudoboard($id) {
        if ( !Auth::check() ) {
            return response()->json([
                "errors" => "Usuario no autorizado"
            ], 401);
        }

        $user = Auth::user();
        $kudoboard = Kudoboard::find($id);

        return response()->json([
            'kudoboard' => $kudoboard
        ]);
    }

    public function deleteKudoboard($id) {
        if ( !Auth::check() ) {
            return response()->json([
                "errors" => "Usuario no autorizado"
            ], 401);
        }

        $user = Auth::user();
        $kudoboard = Kudoboard::find($id);
        $kudoboard->delete();

        return response()->json([
            "message" => "Kudoboard eliminado con éxito"
        ]);
    }
}
