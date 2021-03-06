@unless( $proyecto->isTerminado() )
<script>
	$( document ).ready(function() {
		// alert('alochas');
		function mensaje(e){
			return e.returnValue = 'Tu tiempo trabajado no ha sido guardado, seguro que quieres abandonar la pagina?';
		};
//Fecha limite

var t = "{{ $proyecto->fecha_limite }}".split(/[- :]/);
var countDownDate = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
x = setInterval(function() {
	var now = new Date().getTime();
	var distance = countDownDate - now;

	days = Math.floor(distance / (1000 * 60 * 60 * 24));
	hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	seconds = Math.floor((distance % (1000 * 60)) / 1000);
	$('#limite').text(days + "d " + hours + "h "+ minutes + "m " + seconds + "s "); 
// document.getElementById("limite").innerHTML = days + "d " + hours + "h "+ minutes + "m " + seconds + "s ";
if ( distance < 0) {
// clearInterval(x);
$('#expiredBox').removeClass('d-none');
$('#expired').text('Ya paso la fecha limite de entrega de este proyecto.');

$('#limite').css('color','red');
// document.getElementById("limite").innerHTML = "EXPIRED";
}
}, 1000);

//Fin fecha limite

//Tiempo trabjado
@if( Auth::user()->isDeveloper() )
var bool = true;
var y;
var days2 = {{$dev->diasTrabajado}};
var hours2 = {{$dev->horasTrabajado}};
var minutes2 = {{$dev->minutosTrabajado}};
var seconds2 = {{$dev->segundosTrabajado}};
$('#trabajado').text(days2 + "d " + hours2 + "h "+ minutes2 + "m " + seconds2 + "s "); 

$("#boton").click(function() {
	bool = ! bool;
	if(!bool){
		y = setInterval(function() {
			seconds2++;
			if(seconds2 >= 60){
				seconds2 = 0;
				minutes2++;
			}
			if(minutes2 >= 60){
				minutes2 = 0;
				hours2++;
			}
			if(hours2 >= 24){
				hours2 = 0;
				days2++;
			}
			$('#trabajado').text(days2 + "d " + hours2 + "h "+ minutes2 + "m " + seconds2 + "s "); 
		}, 1000);
		alert('El tiempo corriendo.');
		$('#boton').text("Dejar de trabajar.");    
		window.addEventListener("beforeunload", mensaje);
	} else {
		clearInterval(y);
		$('#boton').text("Seguir trabajando."); 
		$.ajax({
// type: "POST",
url: '{{ route('dev.actualizar') }}',
// dataType: 'json',
data: { id: '{{ $dev->id }}' , diasTrabajado: days2 , horasTrabajado: hours2 , minutosTrabajado: minutes2 , segundosTrabajado: seconds2  },
success: function (result) {
	alert(result);
	window.removeEventListener("beforeunload",mensaje); 
},
error: function (error) {
	alert('Hubo un error al guardar el tiempo. Por favor intentalo de nuevo.');
}
});
// alert('clear setInterval.');

}

});
@endif
// console.log( "ready!" );
});
</script>
@endunless