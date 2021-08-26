<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\SharedKudoboard;
use App\Models\Kudoboard;
use App\Models\User;

class SharedKudoboardController extends Controller
{
    //
    public function getSharedKudoboards() {
        if ( !Auth::check() ) {
            return response()->json([
                'errors' => 'Usuario no autenticado'
            ]);
        }

        $user = Auth::user();

        $sharedKudoboards = $user->sharedKudoboards()->with('kudoboard')->get()->toArray();

        return response()->json([
            'shared_kudoboards' => $sharedKudoboards
        ]);
    }

    public function getSharedKudoboard($id) {
        if ( !Auth::check() ) {
            return response()->json([
                'errors' => 'Usuario no autenticado'
            ]);
        }

        $user = Auth::user();

        $sharedKudoboard = $user->sharedKudoboards()->where('kudoboard_id', $id)->with('kudoboard',)->get();

        $kudos = Kudoboard::find($id)->kudos()->with('user')->get()->toArray();

        return response()->json([
            'shared_kudoboard' => $sharedKudoboard[0],
            'kudos' => $kudos
        ]);
    }
}
