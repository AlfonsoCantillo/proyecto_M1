$("#btnaprobar").click(function(){
	var op= confirm('¿Estaseguro que desea aprobar la compra?')
	if (op) {
		alert('Compra aprobada con éxito.');
	}else{
		alert('Pedido cancelado.');
	}

})

function agregarCarro(codigo,existencia){
	var existencia = parseInt(existencia);
	var cantidad = parseInt($('#cantidad').prop('value'));
	if ( cantidad <= 0 ) {
		alert('Cantidad no permitida.')
		$('#cantidad').val('1');
	}else if (cantidad > existencia) {
		alert('Cantidad no disponible en inventario.')
		$('#cantidad').val('1');
	}else{
		var op= confirm('¿Desea agregar este producto al carrito de compra?')
		if (op) {
			var dat = new FormData();
			dat.append('codigo', codigo);
			dat.append('cantidad', cantidad);
			dat.append('accion', 'AGREGAR_CARRO');
			$.ajax({
		    url: "gestionProductos.php",
		    type: 'POST', 
		    contentType: false,
		    data: dat, 
		    processData: false,
		    cache: false, 
		    success: function(r){ 
		    	alert('Producto agregado al carro de compras.');
		    	$("#carro").html(r);
		    },
		    error: function (jqXHR, exception){ // Si hay algún error.          
		      alert("Error consultando los productos.");
		    }
		  });
		}
			
	}	
}