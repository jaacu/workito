
<div class="col-sm-3  text-dark ">
	<a href="{{ route('user',$user->id)}}" style="display: block; text-decoration: none;" class="m-2">
		<div class="rounded p-2 border  border-{{$user->getRoleColor()}}">
			<p class="text-dark">{{$user->name}}</p>
			<p><span class="text-{{$user->getRoleColor()}}">{{$user->getRoleString()}}</span></p>
		</div>
	</a>
</div>
