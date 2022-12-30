<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {   //No permite mostrar ninguno de los metodos si el usuario no esta autenticado
        //
        $this->middleware('auth')->except(['show','index']);
    }

    public function index(User $user)
    {   //Retorno una vista y envio en valor de una varibale del Modelo User
        $posts = Post::where('user_id',$user->id)->latest()->paginate(8);
        return view('dashboard',[
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required'
        ]);

        //Guardar registros
        // Post::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'image' => $request->image,
        //     'user_id' =>auth()->user()->id
        // ]);

        //Segunda forma de guadar registros
        // $post = new Post;
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->image = $request->image;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        //Tercer forma de guardar registros ||con relacion cualquiera es mejor
        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' =>auth()->user()->id
        ]);

        return redirect()->route('posts.index',auth()->user()->username);    
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show',[
                'post' => $post,
                'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        //Eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->image);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        return redirect()->route('posts.index',auth()->user()->username);
    }
}
