<?php namespace App\Http\Controllers;

use App\Categoria;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Producto;
use Redirect;
use Session;
use Auth;
use Illuminate\Http\Request;
use \Input as Input;

class InsumoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!Auth::user())
			return Redirect::to('/');

		if(Auth::user()->tipo!='admin'){
			return Redirect::to('logout');
		}
		$insumos = Producto::where('anulado', FALSE)->where('version',0)->get();
		return view('insumo.index', compact('insumos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!Auth::user())
			return Redirect::to('/');

		if(Auth::user()->tipo!='admin'){
			return Redirect::to('logout');
		}
		
		return view('insumo.create');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$producto = Producto::create([
					'codigo' => strtoupper($request['codigo']),
					'codigo2' => strtoupper($request['codigo2']),
					'codigo3' => strtoupper($request['codigo3']),
					'descripcion' => $this->acentos(strtoupper($request['descripcion'])),
					'unidad' => $request['unidad'],
					'precio_compra' => $request['precio_compra'],
					'precio_venta' => $request['precio_venta'],
					'version' => 0,
					'anulado' => false,
					]);
		
		if ($request->hasFile('imagen')) {
            $file = Input::file('imagen');
            $nombre = $producto->id.'.' . $file->getClientOriginalExtension();
			$file->move('productos', $nombre);
			$producto->imagen = $nombre;
			$producto->save();
		}
		Session::flash('message', 'Producto registrado correctamente');
		return Redirect::to('/insumo');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$par = $_GET['id'];
		//$part = Partida::find($par);
		$productos = Producto::where('anulado', FALSE)->where('version',0)->get();
		if($productos){
			$res = array();
			foreach($productos as $pro){
				$aux = array(
					'id' => $pro->id,
					'codigo' => $pro->descripcion
					);
			$res[] = $aux;
			}
			return response()->json($res);
		}
		else{
			return response()->json('');
		}
	}
	
	/*public function medida($id)
	{
		$id = $_GET['id'];
		$unidad = Producto::find($id);
		echo $unidad;die;
		$uni = array(
				'medida' => $unidad->unidad
			);
		return response()->json($uni);
		
	}*/

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(!Auth::user())
			return Redirect::to('/');
		
		if(Auth::user()->tipo!='admin'){
			return Redirect::to('logout');
		}
        $producto = Producto::find($id);
		return view('insumo.edit',['producto'=>$producto]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//echo $request->hasFile('imagen');die;
		$prod_actual = Producto::find($id);
		$producto = Producto::where('codigo',$prod_actual->codigo);
		
		$version = $producto->max('version');
		//echo'<pre>';print_r($version);die;
		$imagen = $prod_actual->imagen;
		$prod_actual['version'] = $version+1;
		$prod_actual->save();
		
		$nuevo = Producto::create([
				'codigo' => strtoupper($request['codigo']),
				'descripcion' => $this->acentos(strtoupper($request['descripcion'])),
				'unidad' => $request['unidad'],
				'precio_compra' => $request['precio_compra'],
				'precio_venta' => $request['precio_venta'],
				'version' => 0,
				'anulado' => false,
				]);
		
		if($request->anulado){
			$nuevo['anulado'] = true;	
		}
		
		if ($request->hasFile('imagen')) {	
            $file = Input::file('imagen');
            $nombre = $nuevo->id.'.' . $file->getClientOriginalExtension();
			$file->move('productos', $nombre);
			$nuevo->imagen = $nombre;
		}
		else{
			$nuevo->imagen = $imagen;
		}
		$nuevo->save();
		
		Session::flash('message', 'Producto actualizado correctamente');
		return Redirect::to('/insumo');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	
	public function acentos($val)
	{
		$res = str_replace(['á','é','í','ó','ú','ñ'],['Á','É','Í','Ó','Ú','Ñ'],$val);
		return $res; 
	}

}
