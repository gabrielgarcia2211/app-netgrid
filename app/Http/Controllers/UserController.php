<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
}
