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
							'<div class="row m-t-30">'+
								'<div class="col-10">'+
				        			data[index]['nombre']+
				        		'</div>'+
								'<div class="col-2 agregar_quitar">'+
				        			'<button class="btn btn-primary agregar_compa_colaborador" data-nombrecola='+data[index]['nombre'] +' data-idcola='+ data[index]['id'] +'> AGREGAR </button>'+
				        		'</div>'+
				        	'</div>'+
				        '</div>'
						);
			    	});
					$('.agregar_compa_colaborador').on('click', function(){
						let idDelCompita = $(this).data('idcola');
						let nombdreDelCompita = $(this).data('nombrecola');
						$('#nuevoCompita').html('');
						$('#nuevoCompita').append(' <input name="seller_id" class="form-control" placeholder='+nombdreDelCompita+' readonly value="">').fadeIn(2000);
						quitarponer();
					});



			
			}
		});
	});

	function quitarponer(){
		console.log('lala');
		$('.agregar_quitar').html('');
		$('.agregar_quitar').html('<button class="btn btn-danger quitar_compa_colaborador"> QUITAR </button>');
		$('.quitar_compa_colaborador').on('click', function(){
			$('#nuevoCompita').html('');
			$('#nuevoCompita').append(' <input name="seller_id" class="form-control" placeholder="Colaborador" readonly value="">').fadeIn(2000);
			$('#llenar').html("");
		});
	}


});