<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dato;
use Auth;
use DB;

class DatoController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')) {
            //Consulta los Datos y crea el paginador (10 registros por página).
            $datos = DB::table('datos')->where('status', NULL)->simplePaginate(10);
            return view('index', compact('datos'));
        } else {
            return redirect('/datos/create');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasRole('admin')) {
            return redirect('/datos');
        } else {
            $id_user = Auth::id();
            
            $verificar = Dato::where('user_id', $id_user)->where('status', NULL)->get();

            if (count($verificar) > 0) {
                return redirect('/datos/show');
            } else {
                return view('create');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'nombre.required' => 'El Nombre es un campo requerido.',
            'nombre.max' =>'El nombre no puede ser mayor a :max caracteres.',
            'nombre.min' =>'El nombre no puede ser menor a :min caracteres.',
            'apellido.required' => 'El Apellido es un campo requerido.',
            'apellido.max' =>'El nombre no puede ser mayor a :max caracteres.',
            'apellido.min' =>'El nombre no puede ser menor a :min caracteres.',            
            'email.required' =>'El Correo Electrónico es un campo requerido.', 
            'email.email' =>'Debes Ingresar un Correo Electrónico Válido.', 
            'imagen.required' => 'La Imágen es un campo requerido.',
            'imagen.image' => 'La Imágen debe ser una imágen.',
            'imagen.mimes' => 'La Imágen debe ser un archivo de tipo: jpeg, png, jpg, gif, svg.',
            'imagen.max' =>'El tamaño de la Imágen no puede ser mayor a :max Kb.',
            'descripcion.required' =>'La Descripción es un campo requerido.', 
            'descripcion.max' =>'La Descripción no puede ser mayor a :max caracteres.',
        ];

        $request->validate([
            'nombre' => 'required|min:2|max:20',
            'apellido' => 'required|min:2|max:20',
            'email' => 'required|email',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500',
            'descripcion' => 'required|max:2000',
        ], $messages);

        $id_user = Auth::id();
        $img = $request->file('imagen');

        $nombre_img = $img->getClientOriginalName();

        $datos = new Dato([
            'user_id' => $id_user,
            'nombre' => $request->get('nombre'),
            'apellido' => $request->get('apellido'),
            'email' => $request->get('email'),
            'telefono' => $request->get('telefono'),
            'imagen' => $nombre_img,
            'descripcion' => $request->get('descripcion')
        ]);

        \Storage::disk('local')->put($nombre_img,  \File::get($img));

        $datos->save();
   
        return redirect('/datos/create')->with('success', 'Los Datos han sido guardados de manera exitosa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('verificado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datos = Dato::findOrFail($id);
        return view('edit', compact('datos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datos = Dato::FindOrFail($id);
        if ($request->hasFile('imagen')) {
            $img = $request->file('imagen');
            $nombre_img = $img->getClientOriginalName(); 
            $img->move(public_path().'/storage/', $nombre_img);         
            $datos->imagen = $nombre_img; 
        }
        
        $datos->update();
        return redirect('/datos')->with('success', 'Los Datos han sido modificados de manera exitosa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $datos = Dato::where('id', $id)->first();
        $datos->status = 0;
        $datos->save();

        return redirect('/datos')->with('success', 'Los Datos han sido eliminados');
    }
}
