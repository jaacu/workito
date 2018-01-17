@extends('layouts.app')

@section('content')
<div class="container">
	@include('debug')
	<div class="row my-2">
		<div class="col-sm-12 alert alert-info">
			<h1 class="alert-heading text-center">Firma los terminos y condiciones con la firma digital enviada tu correo para confirmar tu cuenta.</h1>	
		</div>
		<div class="col-sm-8 mx-auto my-3 p-2">
			<h2 class="text-center text-dark text-capitalize" ><label for="condiciones" > Terminos y Condiciones</label></h2>
			<textarea name="condiciones" id="" cols="30" rows="10" class="form-control text-justify" readonly>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra risus ac elementum sagittis. Aliquam consequat vestibulum sem vitae facilisis. Duis quis lobortis risus. Aenean a fringilla dui. Praesent tristique libero in arcu imperdiet pretium. Nam hendrerit quam auctor ligula finibus aliquam. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam tempor arcu in aliquam vehicula.

				Fusce eleifend lectus nec ornare ornare. Nulla id laoreet quam. Mauris accumsan quis diam ut sollicitudin. Suspendisse potenti. Nunc et vulputate neque. Duis augue metus, fringilla et mi quis, condimentum imperdiet turpis. Donec a mollis dui. Sed feugiat lacus non erat euismod malesuada. Nullam posuere porta mi, sit amet maximus nunc tempor blandit. Mauris suscipit, nulla vitae tincidunt condimentum, ligula dui ullamcorper orci, non interdum eros ante dictum quam. Aliquam vel dui laoreet, blandit purus in, ultrices turpis.

				Ut bibendum vulputate risus, ut hendrerit ante tristique id. Pellentesque hendrerit felis eu diam egestas mattis. Fusce a dui sapien. Aenean sollicitudin leo erat, eu consequat massa porttitor ac. Etiam bibendum orci sit amet placerat pharetra. Ut nunc est, posuere et felis a, condimentum varius metus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas vulputate nisl sit amet justo scelerisque tincidunt. Aliquam volutpat felis aliquet tempus pulvinar. Curabitur mi diam, venenatis in ullamcorper vel, convallis at ex. Nulla luctus risus id efficitur facilisis. Nulla fringilla tortor non dolor dignissim congue. Pellentesque nec sapien augue. Aliquam sit amet quam id felis placerat vestibulum non quis eros.

				Curabitur tortor augue, ultricies ut pellentesque at, lobortis ut urna. Vestibulum pharetra turpis in nibh fringilla viverra. Duis tempor, nulla vel vestibulum aliquam, sem velit volutpat lorem, et ullamcorper purus eros id purus. Aliquam interdum non massa ut venenatis. Proin a nunc non magna pharetra faucibus. Duis nec mauris quam. Mauris neque elit, dignissim ac purus nec, luctus maximus orci.

				Praesent turpis elit, elementum in lacus id, venenatis varius nisl. Nam nec libero lorem. Proin euismod, est et tincidunt feugiat, eros libero condimentum enim, sit amet egestas sem dui non lorem. Mauris eu semper sapien, a facilisis ex. Maecenas dapibus dignissim massa, nec ornare lorem consectetur dapibus. Pellentesque fermentum risus mi, id ultricies leo dictum non. Nam sem neque, elementum vitae mi id, rhoncus semper metus. Sed elementum in mi ornare lobortis. Aenean efficitur felis sed sapien molestie, nec dignissim metus tincidunt.
			</textarea>
		</div>
		<br>
		<div class="col-sm-6 p-2 mx-auto my-2 alert alert-info">
			<h7 class="alert-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra risus ac elementum sagittis. Aliquam consequat vestibulum sem vitae facilisis. Duis quis lobortis risus. Aenean a fringilla dui. </h7>
			<hr>
		</div>
		<div class="col-sm-12 my-4 p-2">
			<form action="{{ route('user.confirm') }}" method="post">
				{{ csrf_field()}}
				<div class="form-row my-2">
					<div class="text-center col-sm-8 mx-auto">
						<h5><label for="digital_sign">Firma Digital</label></h5>
						<input type="text" name="digital_sign" class="form-control text-center" required autofocus>

					</div>
				</div>
				<div class="form-row my-2">
					<div class="text-center col-sm-8 mx-auto">
						<button class="btn btn-lg btn-success" type="submit">
							Enviar
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection