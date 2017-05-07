<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Producto;
use App\Ingreso;
use App\Egreso;
use App\Ingdeta;
use App\User;
use Auth;
use Session;
use Redirect;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('index');
	}

	public function bienvenido()
	{
		if(!Auth::user())
			return Redirect::to('/');

		return view('bienvenido');
	}

	public function bienadmin()
	{
		if(!Auth::user())
			return Redirect::to('/');

		if(Auth::user()->tipo!='admin'){
			return Redirect::to('logout');
		}

		$total = User::All()->count();
		$anulados = (User::where('vigente',FALSE)->count()/$total)*100;
		$admin = (User::where('tipo', 'admin')->count()/$total)*100;
		$almacen = (User::where('tipo', 'almacen')->count()/$total)*100;
		$solicitud = (User::where('tipo', 'solicitud')->count()/$total)*100;
		
		$unidads = Unidad::All()->count();
		$catprog = Categoria::where('vigente',TRUE)->count();
		$partidas = Partida::where('vigente',TRUE)->count();
		$ip = getHostByName(getHostName());

		$gestion = date('Y');
		for($i = 1; $i <= 12; $i++){
	        $mes = \DB::table('conectados')->whereRaw('extract(month from created_at) = ? and extract(year from created_at) = ?', [$i, $gestion])->count();
	        $totConec[$i-1] = $mes;
        }

        $conecNow = Conectado::where('estado','CONECTADO')->count();
        $conecAll = Conectado::count();
		return view('bienadmin', compact('totConec', 'conecNow', 'conecAll', 'total','anulados','admin','almacen','solicitud','catprog','partidas'));
	}
	
	public function bienalmacen()
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
		$solicitudes = \DB::table('solicituds')
			->join('users', 'users.id', '=', 'solicituds.user_id')
            ->select('solicituds.numero', 'solicituds.fecha_solicitud', 'users.us')
        	->where('solicituds.anulado','=',false)
        	->whereNotIn('solicituds.id', $lista)
        	->orderBy('solicituds.id', 'desc')
        	->limit(5)
            ->get();
        $total = Solicitud::where('anulado', FALSE)->count(); 
        if($total == 0)
        	$total = 1; 
        $ate = Solicitud::where('estado','ATENDIDO')->where('anulado',FALSE)->count()/$total*100;
        $pen = Solicitud::where('estado', 'PENDIENTE')->where('anulado', FALSE)->count()/$total*100;
        $rec = Solicitud::where('estado', 'RECHAZADO')->where('anulado', FALSE)->count()/$total*100;

        $ing = array();
        $ing[0] = Ingreso::where('anulado', FALSE)->where('fecha_ingreso','>=',date('Y').'-01-01')->where('fecha_ingreso','<',date('Y').'-04-01')->count();
        $ing[1] = Ingreso::where('anulado', FALSE)->where('fecha_ingreso','>=',date('Y').'-04-01')->where('fecha_ingreso','<',date('Y').'-07-01')->count();
        $ing[2] = Ingreso::where('anulado', FALSE)->where('fecha_ingreso','>=',date('Y').'-07-01')->where('fecha_ingreso','<',date('Y').'-10-01')->count();
        $ing[3] = Ingreso::where('anulado', FALSE)->where('fecha_ingreso','>=',date('Y').'-10-01')->where('fecha_ingreso','<=',date('Y').'-12-31')->count();

        $egr = array();
        $egr[0] = Egreso::where('anulado', FALSE)->where('fecha_egreso','>=',date('Y').'-01-01')->where('fecha_egreso','<',date('Y').'-04-01')->count();
        $egr[1] = Egreso::where('anulado', FALSE)->where('fecha_egreso','>=',date('Y').'-04-01')->where('fecha_egreso','<',date('Y').'-07-01')->count();
        $egr[2] = Egreso::where('anulado', FALSE)->where('fecha_egreso','>=',date('Y').'-07-01')->where('fecha_egreso','<',date('Y').'-10-01')->count();
        $egr[3] = Egreso::where('anulado', FALSE)->where('fecha_egreso','>=',date('Y').'-10-01')->where('fecha_egreso','<=',date('Y').'-12-31')->count();
        
        $soli = array();
        $soli[0] = Solicitud::where('anulado', FALSE)->where('fecha_solicitud','>=',date('Y').'-01-01')->where('fecha_solicitud','<',date('Y').'-04-01')->count();
        $soli[1] = Solicitud::where('anulado', FALSE)->where('fecha_solicitud','>=',date('Y').'-04-01')->where('fecha_solicitud','<',date('Y').'-07-01')->count();
        $soli[2] = Solicitud::where('anulado', FALSE)->where('fecha_solicitud','>=',date('Y').'-07-01')->where('fecha_solicitud','<',date('Y').'-10-01')->count();
        $soli[3] = Solicitud::where('anulado', FALSE)->where('fecha_solicitud','>=',date('Y').'-10-01')->where('fecha_solicitud','<=',date('Y').'-12-31')->count();

        
        //$query = Ingdeta::selectRaw('ingreso_id, sum(costo_total) as tot')
	    //->where('itemid', $id)
	    //->groupBy('ingreso_id')
	    //->lists('tot', 'ingreso_id');
	    
        //$mes = Ingreso::where('anulado', FALSE)->where('fecha_ingreso', '>=', Carbon::now()->month('10'))->get();;
        //$mes = Carbon::now()->month(9);
        for($i = 1; $i <= 12; $i++){
	        $mes = \DB::table('ingresos')->whereRaw('extract(month from fecha_ingreso) = ?', [$i])->where('anulado',FALSE)->select('id')->get();
	        $totMes = 0;
	        foreach ($mes as $me){
	        	$totParcial = Ingdeta::where('ingreso_id',$me->id)->sum('costo_total');
		    	$totMes = $totMes + $totParcial;
	        }
	        $totGestion[$i-1] = $totMes;
        }
        //echo '<pre>';print_r($sol);die;
		return view('bienalmacen', compact('solicitudes', 'ate', 'pen', 'rec', 'ing', 'egr', 'soli', 'totGestion'));
	}
	public function biensolicitud()
	{
		if(!Auth::user())
			return Redirect::to('/');

		if(Auth::user()->tipo!='solicitud'){
			return Redirect::to('logout');
		}
		
		$productos = Producto::where('vigente','=',true)->select('id', 'descripcion', 'unidad')->get();
		$disponible = array();
		foreach($productos as $prod){
			$total = Ingdeta::where('producto_id',$prod->id)->where('anulado', false)->sum('cantidad')-
					 Soldeta::where('producto_id',$prod->id)->where('anulado', false)->sum('cantidad_despachada');
			//echo $total;
			$fila = [$prod->id, $prod->descripcion, $prod->unidad, (string)$total];
			$disponible[] = $fila;
		}	

		for($i = 1; $i <= 12; $i++){
			$mes = \DB::table('solicituds')->whereRaw('extract(month from fecha_solicitud) = ?', [$i])->where('anulado',FALSE)->where('user_id',Auth::user()->id)->select('id')->get();
			$solMes = 0;
			foreach ($mes as $me){
				$solParcial = Soldeta::where('solicitud_id',$me->id)->count();
				$solMes = $solMes + $solParcial;
			}
			$solGestion[$i-1] = $solMes;
		}

		$totals = Solicitud::where('anulado', FALSE)->where('user_id',Auth::user()->id)->count();
		if($totals == 0){
			$totals = 1;
		}
		//echo $totals;die;
		$ates = Solicitud::where('estado','ATENDIDO')->where('anulado',FALSE)->where('user_id',Auth::user()->id)->count()/$totals*100;
		$pens = Solicitud::where('estado', 'PENDIENTE')->where('anulado', FALSE)->where('user_id',Auth::user()->id)->count()/$totals*100;
		$recs = Solicitud::where('estado', 'RECHAZADO')->where('anulado', FALSE)->where('user_id',Auth::user()->id)->count()/$totals*100;

		//print_r($totals);die;
		return view('biensolicitud', compact('disponible', 'solGestion', 'ates', 'pens', 'recs'));
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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(LoginRequest $request)
	{
		if(Auth::attempt(['us' => $request['usuario'], 'password' => $request['pass']])){
			
			switch(Auth::user()->tipo){
				case 'almacen': return Redirect::to('bienalmacen');break;
				case 'admin': return Redirect::to('bienvenido');break;
				case 'solicitud': return Redirect::to('biensolicitud');break;
			}
			//return Redirect::to('bienvenido');
		}
		
		Session::flash('message-error', 'Datos incorrectos, intente nuevamente');
		return Redirect::to('/');
	}
	
	public function ajustes()
	{
		if(!Auth::user())
			return Redirect::to('/');

		return view('ajustes');
	}

	public function logout()
	{
		
		Auth::logout();
		return Redirect::to('/');
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
		//
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


}
