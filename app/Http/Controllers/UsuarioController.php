<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Redirect;
use Session;
use Auth;
use Illuminate\Http\Request;

class UsuarioController extends Controller {

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
		$users = User::All();
		return view('usuario.index', compact('users'));
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
		return view('usuario.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$nick = User::where('us', '=', $request['us'])->get();
		if(sizeof($nick) > 0){
			//echo 'hay US';die;
			Session::flash('message-error', 'El nombre de usuario que intenta registrar ya existe');
		}
		else{
			//echo 'exito';die;
			$usu = User::create([
				'nombres' => $request['nombres'],
				'apellidos' => $request['apellidos'],
				'us' => $request['us'],
				'password' => $request['password'],
				'tipo' =>$request['tipo'],
				'anulado' => false,
				]);
		
		Session::flash('message', 'Usuario registrado correctamente');
		}
		return Redirect::to('/usuario');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$usuario = User::find(1);
		$codigo = $_GET['id'];
		if(\Hash::check($codigo, $usuario->password))
			$uni = array('res' => "OK");
		else
			$uni = array('res' => "ERROR");
		
		return response()->json($uni);
	}

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
        $user = User::find($id);
		return view('usuario.edit',['user'=>$user]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$user = User::find($id);
		
		$user->fill($request->all());
		if($request->anulado)
			$user['anulado'] = true;
		else
			$user['anulado'] = false;
		$user->save();
	
		Session::flash('message', 'Usuario actualizado correctamente');
		return Redirect::to('/usuario');
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
	
	public function campass(Request $request)
	{
		$user = User::find($request['use']);
		
		if($request['nuevap'] == $request['validarp']){

			if (\Hash::check($request['actualp'], $user->password)) {
				$user['password'] = $request['nuevap'];
				$user->save();
				echo 'bien';
				Session::flash('message', 'Contraseña cambiada correctamente');
				return Redirect::to('/ajustes');		
			}
			else{
				Session::flash('message-error', 'La contraseña vigente no coicide, intentelo nuevamente');
				return Redirect::to('/ajustes');
			}
		}
		else{
			Session::flash('message-error', 'La contraseña no coiciden, intentelo nuevamente');
			return Redirect::to('/ajustes');
		}
	
	}

}
