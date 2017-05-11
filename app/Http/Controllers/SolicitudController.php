<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Solicitud;
use App\Producto;
use App\Ingdeta;
use App\Soldeta;
use App\Categoria;
use Redirect;
use Session;
use Auth;
use Illuminate\Http\Request;

class SolicitudController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!Auth::user())
			return Redirect::to('/');

		if(Auth::user()->tipo!='solicitud'){
			return Redirect::to('logout');
		}
		$solicitudes = Solicitud::where('user_id','=',Auth::user()->id)->where('anulado',FALSE)->get();
		return view('solicitud.index', compact('solicitudes'));
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
		$venta = $this->obtieneCodigo();
		$productos = Producto::where('anulado',FALSE)->where('version',0)->get();
		return view('solicitud.create', compact('productos', 'venta'));
	}
	
	public function obtieneCodigo(){
		$ges = (string)date('Y');
		$codigo = $this->maximoCodigo();
		$venta = $ges."V".($codigo+1);
		return $venta;
	}
	
	public function maximoCodigo(){
		$ges = (string)date('Y');
		$codigo = \DB::table('egresos')->whereRaw('extract(year from fecha_egreso) = ?', [$ges])->max('cod');
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
		$num=0;
		$sol = Solicitud::create([
			
					'numero' => Solicitud::All()->max('numero')+1,
					'fecha_solicitud' => date('Y-m-d H:i:s'),
					'anulado' => false,
					'fecha_anulado' => null,
					'motivo_anulado' => '',
					'user_id' => Auth::user()->id,
					'categoria_id' => $request['categoria'],
					'estado' => 'PENDIENTE'
					]);
		while($request['producto'.$num]!=null){
			Soldeta::create([
				'solicitud_id' => $sol->id,
				'producto_id' => $request['producto'.$num],
				'cantidad_solicitada' => $request['solicitado'.$num],
				'cantidad_despachada' => 0,
				'anulado' => false
				]);	
			$num++;	
		}
		
		Session::flash('message', 'Solicitud registrada correctamente');
			return Redirect::to('/solicitud/documento?cod='.$sol->id);
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
		$solic = Solicitud::find($id);
		return view('solicitud.edit', compact('solic'));
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
		$solicitud = Solicitud::find($request['cod']);
		$solicitud->anulado = TRUE;
		$solicitud->fecha_anulado = date('Y-m-d H:i:s');
		$solicitud->motivo_anulado = $request['motivo'];
		$solicitud->estado = 'ANULADO';
		
		$soldetas = Soldeta::where('solicitud_id',$request['cod'])->get();
		//echo '<PRE>';print_r($soldetas);die;
		foreach($soldetas as $sold){
			$sold->anulado = TRUE;
			$sold->save();
		}

		//$soldetas->save();

		$solicitud->save();
		Session::flash('message', 'Solicitud anulada');
		return Redirect::to('/solicitud');
	}

	public function documento(){
		//$partidas = Partida::find($id);
		$id = $_GET['cod'];
		$solicitud = \DB::table('solicituds')->where('solicituds.id',$id)
					->join('categorias','categorias.id', '=', 'solicituds.categoria_id')
					->get();
		$solicitud = $solicitud[0];
		$detalles = \DB::table('soldetas')->where('soldetas.solicitud_id',$id)
				   ->join('productos', 'productos.id','=','soldetas.producto_id')
				   ->select('soldetas.id', 'productos.partida_cod as codigo', 'productos.descripcion', 'productos.unidad', 'soldetas.cantidad_solicitada', 'soldetas.cantidad_despachada')
				   ->get();
		
		//echo'<pre>';print_r($detalles);die;
		return view('solicitud.documento', compact('solicitud', 'detalles'));
		
	}

}
