<?php namespace Course\Http\Controllers\Admin;

use Course\Http\Requests;
use Course\Http\Controllers\Controller;

use Course\Http\Requests\CreateUserRequest;
use Course\Http\Requests\EditUserRequest;

use Course\User;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller {

	public function __construct()
	{
		$this->beforeFilter('@findUser', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	public function findUser(Route $route)
	{
		$this->user = User::findOrFail($route->getParameter('users'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{		
		$users = User::name($request->get('name'))->type($request->get('type'))->orderBy('id', 'DESC')->Paginate();
		return view('admin.users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateUserRequest $request)
	{			
		$user = User::create($request->all());		
		return \Redirect::route('admin.users.index');
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
		return view('admin.users.edit')->with('user', $this->user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditUserRequest $request, $id)
	{		
		$this->user->fill($request->all());
		$this->user->save();
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{	
		$this->user->delete();
		$message = $this->user->full_name . ' fue Eliminado';
		if ($request->ajax())
		{
			return response()->json([
				'id'		=>	$this->user->id,
				'message' 	=>	$message
			]);
		}
		Session::flash('message', $message);
		return redirect()->route('admin.users.index');
	}

}