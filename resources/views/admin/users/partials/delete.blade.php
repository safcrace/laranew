{!! Form::open(['route' => ['admin.users.destroy', $user], 'method' => 'DELETE']) !!}

	<button type="submit" onclick="return confirm('Seguro que desea eliminar el registro?')" class="btn btn-danger pull-right">Eliminar Usuario</button>

{!! Form::close() !!}