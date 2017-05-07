<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ingreso;
use App\Ingdeta;
use App\Producto;
use Redirect;
use Session;
use Auth;
use DateTime;
use Illuminate\Http\Request;

class IngresoController extends Controller {

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
		
		/*$ingresos = \DB::table('ingresos as i')
			            ->join('unidads as u', 'u.id', '=', 'i.unidad_id')
			            ->join('proveedors as p', 'p.id', '=', 'i.proveedor_id')
			            ->join('categorias as c', 'c.id', '=', 'i.categoria_id')
			            ->select('i.id', 'i.cod', 'i.fecha_ingreso', 'u.denominacion', 'c.cat_prog', 'p.razon_social', 'p.nit', 'i.factura', 'i.observacion','i.inventario_id')
			            ->where('i.anulado', '=', FALSE)
			            ->get();*/
		$ingresos = Ingreso::where('anulado', FALSE)->get();
		return view('ingreso.index', compact('ingresos'));
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$productos = Producto::where('anulado',FALSE)->where('version',0)->get();
		/*$ges = (string)date('Y');
		$codigo = \DB::table('ingresos')->whereRaw('extract(year from fecha_ingreso) = ?', [$ges])->max('cod');
		if(!$codigo)
			$codigo = 0;
		$compra = $ges."C-".($codigo+1);*/
		$compra = $this->obtieneCodigo();
		return view('ingreso.create', compact('productos','compra'));
	}

	public function obtieneCodigo(){
		$ges = (string)date('Y');
		$codigo = $this->maximoCodigo();
		$compra = $ges."C".($codigo+1);
		return $compra;
	}
	
	public function maximoCodigo(){
		$ges = (string)date('Y');
		$codigo = \DB::table('ingresos')->whereRaw('extract(year from fecha_ingreso) = ?', [$ges])->max('cod');
		if(!$codigo)
			$codigo = 0;
		return $codigo;
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$num = 0;
		$max = $this->maximoCodigo();
		$compra = $this->obtieneCodigo();
		$ing = Ingreso::create([
					'cod' => $max+1,
					'compra' =>$compra,
					'fecha_ingreso' => $request['fecha'],
					'observacion' => $this->acentos(strtoupper($request['observacion'])),
					'anulado' => false,
					//'fecha_anulado' => $request['fecha'],
					//'motivo_anulado' => '',
					'user_id' => Auth::user()->id,
					'proveedor' => $this->acentos(strtoupper($request['proveedor'])),
					'total' => $request['total'],
					'factura' => $request['factura'],
					]);
		
		
		while($request['codigo'.$num]!=null){
			Ingdeta::create([
				'ingreso_id' => $ing->id,
				'producto_id' => $request['codigo'.$num],
				'cantidad' => $request['cantidad'.$num],
				'costo_unidad' => $request['costou'.$num],
				'costo_total' => $request['costou'.$num]*$request['cantidad'.$num],
				'anulado' => false
				]);	
			$num++;	
		}
		
		Session::flash('message', 'Ingreso registrado correctamente');
		return Redirect::to('/ingreso');

		
		
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ingre = Ingreso::find($id);
		return view('ingreso.edit', compact('ingre'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

	public function anular(Request $request)
	{
		$ingreso = Ingreso::find($request['idi']);
		$ingreso->anulado = TRUE;
		$ingreso->fecha_anulado = date('Y-m-d H:i:s');
		$ingreso->motivo_anulado = $request['motivo'];
		
		$ingdetas = Ingdeta::where('ingreso_id',$request['idi'])->get();
		//echo '<PRE>';print_r($soldetas);die;
		foreach($ingdetas as $ingd){
			$ingd->anulado = TRUE;
			$ingd->save();
		}

		//$soldetas->save();

		$ingreso->save();
		Session::flash('message', 'Compra anulada correctamente');
		return Redirect::to('/ingreso');
	}
	
	public function documento(){
		//$partidas = Partida::find($id);
		$id = $_GET['cod'];
		$ingreso = \DB::table('ingresos')->where('ingresos.id',$id)
				   ->join('proveedors', 'proveedors.id','=','ingresos.proveedor_id')
				   ->join('categorias', 'categorias.id','=','ingresos.categoria_id')
				   ->join('unidads','unidads.id','=','ingresos.unidad_id')
				   ->join('users','users.id','=','ingresos.user_id')
				   ->select('ingresos.id', 'ingresos.cod', 'ingresos.fecha_ingreso', 'ingresos.observacion', 'ingresos.factura', 'unidads.denominacion', 'categorias.cat_prog', 'categorias.cat_prog_desc', 'proveedors.razon_social', 'proveedors.nit', 'users.us')
				   ->get();
		$ingreso = $ingreso[0];
		$detalles = \DB::table('ingdetas')->where('ingdetas.ingreso_id',$id)
				   ->join('productos', 'productos.id','=','ingdetas.producto_id')
				   ->select('ingdetas.id', 'productos.partida_cod as codigo', 'productos.descripcion', 'productos.unidad', 'ingdetas.cantidad', 'ingdetas.costo_unidad', 'ingdetas.costo_total')
				   ->get();
		
		//echo'<pre>';print_r($ingreso);
		//echo'<pre>';print_r($detalles);die;
		return view('ingreso.documento', compact('ingreso', 'detalles'));
		
	}
	
	public function acentos($val)
	{
		$res = str_replace(['á','é','í','ó','ú','ñ'],['Á','É','Í','Ó','Ú','Ñ'],$val);
		return $res; 
	}

}