<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\megusta;

class megustaController extends Controller
{
    
    public function Crear(Request $request)
    {
        if ($request->has("usuario_id") && ($request->has("post_id") || $request->has("comentario_id"))) {
            $megusta = new megusta();
            $megusta->usuario_id = $request->post("usuario_id");
            
            if ($request->has("post_id")) {
                $megusta->post_id = $request->post("post_id");
            } else {
                $megusta->comentario_id = $request->post("comentario_id");
            }

            $megusta->save();
            return(redirect("listarLike"));
        }


        return response()->json(["error mesage" => "error al crear el megusta"]);
    }

    public function ListarTodas(Request $request)
    {
        #$megusta = megusta::all();
        $megusta = megusta::With("usuario") -> get();
        return view("listarLikes", ["megusta" => $megusta]);
    }

    public function ListarUna(Request $request, $id)
    {
        return megusta::findOrFail($id);
    }

    public function Modificar(Request $request)
    {
        $megusta = megusta::findOrFail($request -> post("id"));
        $megusta->usuario_id = $request->post("usuario_id");
        $megusta->comentario_id = $request->post("comentario_id");
        $megusta->post_id = $request->post("post_id");
        $megusta->save();
        return(redirect("listarLikes"));
    }

    public function MostrarFormularioDeModificar(Request $request, $id)
    {
        $megusta = megusta::findOrFail($id);
        return view("modificarLikes", ["megusta" => $megusta]);
    }

    public function Eliminar(Request $request, $id)
    {
        $megusta = megusta::findOrFail($id);
        $megusta->delete();
        return redirect("/listarLike");
    }
}
