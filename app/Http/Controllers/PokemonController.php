<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class PokemonController extends Controller
{
    private $client;
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('home')->with(compact('user'));;
    }

    public function list_pokemons()
    {
        $response = $this->client->request('GET', 'pokemon?limit=100000&offset=0');
        $list_pokemons = json_decode($response->getBody());
        return response()->json($list_pokemons);
    }

    public function details_pokemons($name)
    {
        try {
            $response = $this->client->request('GET', 'pokemon/' . $name);
            $details_pokemons = json_decode($response->getBody());
            $map_details = array();
            #nombre
            $map_details["name"] = $name;
            #experiencia
            $map_details["base_experience"] = $details_pokemons->base_experience;
            #sprites
            $map_details["sprites"]["front"] =  $details_pokemons->sprites->front_default;
            $map_details["sprites"]["back"] =  $details_pokemons->sprites->back_default;
            #habilidades
            for ($i = 0; $i < count($details_pokemons->abilities); $i++) {
                $map_details["abilities"][$i] = $details_pokemons->abilities[$i]->ability->name;
            }
            #held_items
            for ($j = 0; $j < count($details_pokemons->held_items); $j++) {
                $map_details["held_items"][$j] = $details_pokemons->held_items[$j]->item->name;
            }
            #moves
            for ($j = 0; $j < count($details_pokemons->moves); $j++) {
                $map_details["moves"][$j] = $details_pokemons->moves[$j]->move->name;
            }
            #tipo
            for ($j = 0; $j < count($details_pokemons->types); $j++) {
                $map_details["types"][$j] = $details_pokemons->types[$j]->type->name;
            }

            return response()->json($map_details);
        } catch (\Exception $e) {
            Log::error("PokemonController/details_pokemons - No se puede obtener la info del pokemon" . Auth::user()->name . ' ' . $e->getMessage());
        }
    }

    public function favorites_pokemons(Request $request)
    {

        $id = Auth::user()->id;
        $name = $request->all()["name"];
        $result = Favorite::where("ref_api", $name)->get()->toArray();

        if (empty($result)) {
            Favorite::create([
                "id_usuario" => $id,
                "ref_api" => $name
            ]);
            return response()->json(["new" => true]);
        }else{
            Favorite::where("ref_api", $name)->delete();
            return response()->json(["new" => false]);
        }

    }

    public function get_pokemon($name)
    {
        return (!empty(Favorite::where("ref_api", $name)->get()->toArray()) ? true : false);
    }
}
