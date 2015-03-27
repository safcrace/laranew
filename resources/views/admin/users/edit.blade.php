@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Nuevo Usuario: {{ $user->first_name . ' ' . $user->last_name }}</div>

				<div class="panel-body">
						{!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'PUT']) !!}
						
							@include('admin.users.partials.fields')
							  
						  <button type="submit" class="btn btn-default">Actualizar Usuario</button>
						{!! Form::close() !!}	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection