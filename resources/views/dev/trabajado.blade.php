<div class="row">
	<div class=" col-sm-3 p-0">
		<div class="border text-dark text-center bg-light @if( Auth::user()->isDeveloper() ) border-dark  @endif m-2">
		<strong class="text-dark" style="font-size: 20px;">{{$dev->diasTrabajado}}</strong> <br>Dias
		</div>
	</div>
	<div class=" col-sm-3 p-0">
		<div class="border text-dark text-center bg-light @if( Auth::user()->isDeveloper() ) border-dark  @endif m-2">
		<strong class="text-dark" style="font-size: 20px;">{{$dev->horasTrabajado}}</strong><br>Horas
		</div>
	</div>
	<div class=" col-sm-3 p-0">
		<div class="border text-dark text-center bg-light @if( Auth::user()->isDeveloper() ) border-dark  @endif m-2">
		<strong class="text-dark" style="font-size: 20px;">{{$dev->minutosTrabajado}}</strong><br>Minutos 
		</div>
	</div>
	<div class=" col-sm-3 p-0">
		<div class="border text-dark text-center bg-light @if( Auth::user()->isDeveloper() ) border-dark  @endif m-2">
		<strong class="text-dark" style="font-size: 20px;">{{$dev->segundosTrabajado}}</strong><br>Segundos
		</div>
	</div>
</div>