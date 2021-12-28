<?php

namespace App\Http\Controllers;

use App\Models\Capi;
use Laravel\Passport\Token;
use Illuminate\Http\Request;
use App\Http\Requests\CapiRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CapiResource;
use App\Http\Resources\CapiCollection;

class ApiCapiController extends Controller
{
    public function registrarCapi(Request $request)
    {
        /* Recuperar el Usuario */

        $user =  auth()->user()->name;
        $user_id =  auth()->user()->id;

        /* Token */
        $bearerToken = $request->bearerToken();
        $tokenParts = explode(".", $bearerToken);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);
        
        /* busqueda de credenciales */
        $client = Token::find($jwtPayload->jti)->client;
        $client_id = $client->id;
        $client_name = $client->name;
        $client_secret = $client->secret;

        //$secret_sigep = env('SECRET_KEY_SIGEP');

        $data = $request->data;
        return $request->ip();

        $data = json_encode($data);

        //$aux = openssl_encrypt($data, "AES-128-ECB", $secret_sigep);

        $data = openssl_decrypt($data, "AES-128-ECB", $client_secret);

        if($data != null)
        {
            return $data;
        }

        return "error";
        
        
        //dd($secret_sigep . ' - ' . $client_secret);

        /* Asignacion */

        $gestion = $request->gestion;
        $entidad = $request->entidad;
        $sisin = $request->sisin;
        $numeroC31 = $request->numeroC31;
        $fechaAprobacion = $request->fechaAprobacion;
        $montoTotal = $request->montoTotal;
        $detalle = $request->detalle;
        $objeto = $detalle[0];
        $fuente = $objeto['fuente'];

        /* procesamiento de la informacion */

        $data = DB::connection('mysql2')->select('call buscar(?)', array(2));
        $code_capi = $data[0];

        /* respuesta */

        return response()->json([
            'success' => true,
            'message' => 'Peticion Exitosa',
            'gestion' => 2021,
            'entidad' => 291,
            'sisin' => "0002345687",
            'code_capi' => $code_capi->usuario_id,
            'montoTotal' => 200,
            'status' => true
        ]);
    }
}
