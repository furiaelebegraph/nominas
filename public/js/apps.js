$(document).ready(function(){
	let formulario1 = $("#btn_cooll");
	formulario1.on('click',function(e){
		let dataForm = $('#mi_input').val();
		console.log(dataForm);
		e.preventDefault();
		$.ajax({
		    cache: false,
		    contentType: false,
		    processData: false,
		    type: 'get',
		    url: '/buscacolaborador?buscador='+dataForm,
		    success: function (data) {
		    	console.log(data);
		    	$('#llenar').html('');
			    	$.each(data, function(index){
						$('#llenar').append('<div class="col-12" id="colaborador">'+
				        data[index]['nombre']+
				        '<button class="btn btn-primary agregar_compa_colaborador" data-nombrecola='+data[index]['nombre'] +' data-idcola='+ data[index]['id'] +'> AGREGAR </button>'+
				        '</div>'
						);
			    	});
					$('.agregar_compa_colaborador').on('click', function(){
						let idDelCompita = $(this).data('idcola');
						let nombdreDelCompita = $(this).data('nombrecola');
						$('#nuevoCompita').append(' <input name="seller_id" placeholder='+nombdreDelCompita+' disable="disable" value='+idDelCompita+'>').fadeIn(2000);
						console.log(idDelCompita);
					});

			
			}
		});
	});




});