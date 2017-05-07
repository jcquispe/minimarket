<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Egdeta;
use App\Egreso;
use App\Soluser;
use Redirect;
use Session;
use Auth;
use DateTime;
use Illuminate\Http\Request;

class EgresoController extends Controller {

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
		
		$egresos = \DB::table('egresos as e')
			            ->join('users as u', 'u.id', '=', 'e.user_id')
			            ->join('solusers as s', 's.id', '=', 'e.soluser_id')
			            ->select('e.id', 'e.venta', 'e.total', 'e.fecha_egreso', 's.ci', 'u.us')
			            ->where('e.anulado',false)
			            ->get();
		return view('egreso.index', compact('egresos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
		//echo '<pre>';print_r($request['codigo0']);die;
		$soluser = Soluser::where('ci', $request['cinit'])->where('nombre',$request['nombre'])->where('anulado',FALSE)->get();
		//echo "res".!empty((array) $soluser);die;
		if ($soluser->isEmpty()){
			$soluact = Soluser::where('ci', $request['cinit'])->where('anulado',FALSE)->get();
			if(!$soluact->isEmpty()){
				foreach($soluact as $act){
					$act['anulado'] = TRUE;
					$act->save();
				}
			}
			$soluser = Soluser::create([
				'nombre' => $this->acentos(strtoupper($request['nombre'])),
				'ci' => $request['cinit'],
				'anulado' => false
				]);
		}
		else{
			$soluser = $soluser[0];
		}
		$num = 0;
		$max = $this->maximoCodigo();
		$venta = $this->obtieneCodigo();
		$eg = Egreso::create([
					'cod' => $max+1,
					'venta' => $venta,
					'fecha_egreso' => date('Y-m-d H:i:s'),
					'total' => $request['total'],
					'pagado' =>$request['pagado'],
					'observacion' => $this->acentos(strtoupper($request['observacion'])),
					'anulado' => false,
					//'fecha_anulado' => null,
					'user_id' => Auth::user()->id,
					'soluser_id' => $soluser->id
					]);
		
		if($request['total']==0){
			$eg->autorizado = 1;
			$eg->save();
		}
		
			while($request['codigo'.$num]!=null){
				Egdeta::create([
					'egreso_id' => $eg->id,
					'producto_id' => $request['codigo'.$num],
					'cantidad' => $request['cantidad'.$num],
					'unidad' => $request['unidad'.$num],
					'costo_unidad' => $request['costov'.$num],
					'costo_vendido' => $request['costou'.$num],
					'costo_total' => $request['costou'.$num]*$request['cantidad'.$num],
					'anulado' => false
					]);	
				$num++;	
			}
		
		Session::flash('message', 'Venta registrada correctamente');
		/*return Redirect::to('/egreso/documento?cod='.$eg->id);*/
		return Redirect::to('/egreso');
	
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
		$egre = Egreso::find($id);
		return view('egreso.edit', compact('egre'));
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
		$egreso = Egreso::find($request['idi']);
		$egreso->anulado = TRUE;
		$egreso->fecha_anulado = date('Y-m-d H:i:s');
		$egreso->motivo_anulado = $request['motivo'];
		
		$egdetas = Egdeta::where('egreso_id',$request['idi'])->get();
		//echo '<PRE>';print_r($soldetas);die;
		foreach($egdetas as $egd){
			$egd->anulado = TRUE;
			$egd->save();
		}

		//$soldetas->save();

		$egreso->save();
		Session::flash('message', 'Venta anulada correctamente');
		return Redirect::to('/egreso');
	}
	
	public function solicitudes()
	{
		if(!Auth::user())
			return Redirect::to('/');

		if(Auth::user()->tipo!='almacen'){
			return Redirect::to('logout');
		}
		$egresos = \DB::table('egresos')->select('solicitud_id')->get();
		$lista = array();
		foreach($egresos as $egr){
			$lista[] = $egr->solicitud_id;
		}
		//echo '<pre>';print_r($lista);die;
		$solicitudes = \DB::table('solicituds')
			->join('users', 'users.id', '=', 'solicituds.user_id')
			->join('categorias', 'categorias.id', '=', 'solicituds.categoria_id')
            ->select('solicituds.id', 'solicituds.numero', 'solicituds.fecha_solicitud', 'users.us', 'categorias.cat_prog')
        	->where('solicituds.anulado','=',false)
        	->whereNotIn('solicituds.id', $lista)
        	->orderBy('solicituds.id', 'desc')
            ->get();
		return view('egreso.solicitudes', compact('solicitudes'));
	}

	public function documento(){
		//$partidas = Partida::find($id);
		$id = $_GET['cod'];
		$egreso = Egreso::find($id);

		$soluser = Soluser::find($egreso->soluser_id);
		
		$detalles = \DB::table('egdetas')->where('egdetas.egreso_id',$id)
				   ->join('productos', 'productos.id','=','egdetas.producto_id')
				   ->select('egdetas.id', 'productos.codigo', 'productos.descripcion', 'productos.imagen', 'productos.unidad', 'egdetas.cantidad', 'egdetas.costo_vendido', 'egdetas.costo_total')
				   ->get();
		//$egreso = $egreso[0];
		//echo'<pre>';print_r($soluser);die;
		return view('egreso.documento', compact('egreso', 'soluser', 'detalles'));
		
	}
	
	public function acentos($val)
	{
		$res = str_replace(['á','é','í','ó','ú','ñ'],['Á','É','Í','Ó','Ú','Ñ'],$val);
		return $res; 
	}

}
