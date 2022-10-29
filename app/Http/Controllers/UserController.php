<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    private $client;
    private $route_sprites_frontend = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/dream-world/";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->client  = new \GuzzleHttp\Client(['base_uri' => env('API_ENDPOINT')]);
    }

    public function edit_user(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'address' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'city' => 'nullable|string',
        ]);

        try {
            $id = Auth::user()->id;
            # seteamos los nuevos valores
            $user_edit = User::find($id);
            $user_edit->name = $request->all()["name"];
            $user_edit->email = $request->all()["email"];
            $user_edit->address = $request->all()["address"];
            $user_edit->birthdate = $request->all()["birthdate"];
            $user_edit->city = $request->all()["city"];

            $user_edit->save();

            # respuesta de la solicitud     
            Alert::success('Exito', 'Informacion actualizada');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error("UserController/edit_user - No se pudo actualizar el usuario" . Auth::user()->name . ' ' . $e->getMessage());
        }
    }

    public function pdf_favorites()
    {
       
        $favorities = Favorite::where('id_usuario', Auth::user()->id)->get();

        #mapeo de urls para las imagenes 
        $data = [];
        foreach ($favorities as $key => $favority) {
            $name = $favority->ref_api;

            $response = $this->client->request('GET', 'pokemon/' . $name);
            $id_pokemon = json_decode($response->getBody())->id;

            $data["info"][$key]["name"] = $name;
            $data["info"][$key]["sprites"]["f"] = $this->route_sprites_frontend . $id_pokemon . '.svg';
        }

        $now = date('Y-m-d-His');
        $fileName = "$now" . "_favoritos.pdf";

        $dompdf = PDF::loadView('reports/pokemon', $data);

        $dompdf->set_paper('letter', 'landscape');
        //$dompdf->setPaper([0, 0, 141.732,  283, 465]); //x inicio, y inicio, ancho final, alto final

        # Retornamos el archivo
        return $dompdf->download($fileName);
    }
}
