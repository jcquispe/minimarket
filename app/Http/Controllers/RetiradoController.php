<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Producto;
use App\Retirado;
use Redirect;
use Session;
use Auth;
use DateTime;

use Illuminate\Http\Request;

class RetiradoController extends Controller {

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
		
		$retirados = \DB::table('retirados as r')
			            ->join('productos as p', 'p.id', '=', 'r.producto_id')
			            ->join('users as u', 'u.id', '=', 'r.user_id')
			            ->select('r.id', 'r.retirado', 'r.fecha_retirado', 'p.codigo', 'p.descripcion', 'r.cantidad', 'r.motivo', 'u.us')
			            ->where('r.anulado',false)
			            ->get();
		//echo'<pre>';print_r($retirados);die;
		return view('retirado.index', compact('retirados'));
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
		$retirado = $this->obtieneCodigo();
		$productos = Producto::where('anulado',FALSE)->where('version',0)->get();
		return view('retirado.create', compact('productos', 'retirado'));
	}
	
	public function obtieneCodigo(){
		$ges = (string)date('Y');
		$codigo = $this->maximoCodigo();
		$venta = $ges."R".($codigo+1);
		return $venta;
	}
	
	public function maximoCodigo(){
		$ges = (string)date('Y');
		$codigo = \DB::table('retirados')->whereRaw('extract(year from fecha_retirado) = ?', [$ges])->max('cod');
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
		$max = $this->maximoCodigo();
		$retirado = $this->obtieneCodigo();
		
		$retirado = Retirado::create([
					'cod' => $max+1,
					'retirado' => $retirado,
					'fecha_retirado' => date('Y-m-d H:i:s'),
					'producto_id' => $request['codigor'],
					'cantidad' => $request['cantidad'],
					'motivo' => $request['motivo'],
					'anulado' => false,
					'user_id' => Auth::user()->id
					]);
		
		Session::flash('message', 'Producto retirado correctamente');
		return Redirect::to('/retirado');
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
		$reti = Retirado::find($id);
		return view('retirado.edit', compact('reti'));
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
		$retirado = Retirado::find($request['idi']);
		$retirado->anulado = TRUE;
		$retirado->fecha_anulado = date('Y-m-d H:i:s');
		$retirado->motivo_anulado = $request['motivo'];
		
		$retirado->save();
		Session::flash('message', 'Retiro de productos anulado correctamente');
		return Redirect::to('/retirado');
	}

}
