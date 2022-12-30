<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('perfil.index');
    }
    public function store(Request $request)
    {
        //Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);
        //Cuando son mas de tres reglas de validacion se recomienda colocarlos en arreglo
        $this->validate($request,[
            'username' => ['required','unique:users,username,   '.auth()->user()->id,'min:3','max:20','not_in:twitter,editar-perfil'],
        ]);
        //Hay imagen??
        if($request->image){
            $imagen = $request->file('image');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000,1000);
    
            $imagenPath = public_path('perfiles') . '/' .$nombreImagen;
            $imagenServidor->save($imagenPath);
        }
        //Guardar cambios (actualizar)
         $usuario = User::find(auth()->user()->id);
         $usuario->username = $request->username;
         //Se sube imagen nueva ?? se mantiene la anterior ?? se coloca null
         $usuario->image = $nombreImagen ?? auth()->user()->image ?? null;
         $usuario->save();

        //Redireccionar al usuario
        return redirect()->route('posts.index',$usuario->username);
    }
}
