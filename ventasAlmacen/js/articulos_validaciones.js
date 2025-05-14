//LIMPIAR CELDA CATEGORIA
		$('#btnLimpiarArticulo').click(function(){
                $('#frmArticulos')[0].reset();
            });

            function agregaDatosArticulo(idarticulo){
            $.ajax({
                type:"POST",
                data:"idart=" + idarticulo,
                url:"../procesos/articulos/obtenDatosArticulo.php",
                success:function(r){
                    
                    dato=jQuery.parseJSON(r);
                    $('#idArticulo').val(dato['id_producto']);
                    $('#categoriaSelectU').val(dato['id_categoria']);
                    $('#nombreU').val(dato['nombre']);
                    $('#descripcionU').val(dato['descripcion']);
                    $('#cantidadU').val(dato['cantidad']);
                    $('#precioU').val(dato['precio']);

                }
            });
        }

        function eliminaArticulo(idArticulo){
            alertify.confirm('¿Desea eliminar este articulo?', function(){ 
                $.ajax({
                    type:"POST",
                    data:"idarticulo=" + idArticulo,
                    url:"../procesos/articulos/eliminarArticulo.php",
                    success:function(r){
                        if(r==1){
                            $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
                            alertify.success("Eliminado con exito!!");
                        }else{
                            alertify.error("No se pudo eliminar :(");
                        }
                    }
                });
            }, function(){ 
                alertify.error('Cancelo !')
            });
        }
    $(document).ready(function () {

        // Validaciones en tiempo real para formulario de actualización
        $('#nombreU').on('input', function () {
            this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '').substring(0, 20);
        });

        $('#descripcionU').on('input', function () {
            this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '').substring(0, 50);
        });

        $('#cantidadU').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 3);
        });

        $('#precioU').on('input', function () {
            let val = this.value.replace(/[^0-9.]/g, '');
            if ((val.match(/\./g) || []).length > 1) {
                val = val.substring(0, val.lastIndexOf('.'));
            }
            if (val.includes('.')) {
                let parts = val.split('.');
                parts[0] = parts[0].substring(0, 4);
                parts[1] = parts[1].substring(0, 2);
                val = parts.join('.');
            } else {
                val = val.substring(0, 4);
            }
            this.value = val;
        });

        // Evento al hacer clic en Actualizar
        $('#btnActualizaarticulo').click(function () {
            let categoria = $('#categoriaSelectU').val();
            let nombre = $('#nombreU').val().trim();
            let descripcion = $('#descripcionU').val().trim();
            let cantidad = $('#cantidadU').val().trim();
            let precio = $('#precioU').val().trim();

            if (categoria === 'A' || nombre === '' || descripcion === '' || cantidad === '' || precio === '') {
                alertify.alert("Todos los campos son obligatorios.");
                return false;
            }

            let datos = $('#frmArticulosU').serialize();

            $.ajax({
                type: "POST",
                data: datos,
                url: "../procesos/articulos/actualizaArticulos.php",
                success: function (r) {
                    if (r == 1) {
                        $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
                        alertify.success("Actualizado con éxito :D");
                    } else {
                        alertify.error("Error al actualizar :(");
                    }
                }
            });
        });

    });

$(document).ready(function(){

    function validarNombre(nombre) {
        const regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{1,20}$/;
        return regex.test(nombre);
    }

    function validarDescripcion(descripcion) {
        const regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s]{1,50}$/;
        return regex.test(descripcion);
    }

    function validarCantidad(cantidad) {
        const regex = /^[0-9]{1,3}$/;
        return regex.test(cantidad);
    }

    function validarPrecio(precio) {
        const regex = /^\d{1,4}(\.\d{1,2})?$/;
        return regex.test(precio);
    }

    // Validación en tiempo real
    $('#nombre').on('input', function(){
        let valor = $(this).val();
        if(!validarNombre(valor)) {
            $('#msgNombre').text("Máximo 20 caracteres. Solo letras y espacios.").css("color", "red");
        } else {
            $('#msgNombre').text("¡Nombre válido!").css("color", "green");
        }
    });

    $('#descripcion').on('input', function(){
        let valor = $(this).val();
        if(!validarDescripcion(valor)) {
            $('#msgDescripcion').text("Máximo 50 caracteres. Sin símbolos especiales.").css("color", "red");
        } else {
            $('#msgDescripcion').text("¡Descripción válida!").css("color", "green");
        }
    });

    $('#cantidad').on('input', function(){
        let valor = $(this).val();
        if(!validarCantidad(valor)) {
            $('#msgCantidad').text("Solo números enteros. Máximo 3 dígitos.").css("color", "red");
        } else {
            $('#msgCantidad').text("¡Cantidad válida!").css("color", "green");
        }
    });

    $('#precio').on('input', function(){
        let valor = $(this).val();
        if(!validarPrecio(valor)) {
            $('#msgPrecio').text("Número válido. Máximo 4 dígitos y 2 decimales.").css("color", "red");
        } else {
            $('#msgPrecio').text("¡Precio válido!").css("color", "green");
        }
    });

    
});

$(document).ready(function () {
        $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");

        // Validaciones en tiempo real
        $('#nombre').on('input', function () {
            this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '').substring(0, 20);
        });

        $('#descripcion').on('input', function () {
            this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '').substring(0, 50);
        });

        $('#cantidad').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 3);
        });

        $('#precio').on('input', function () {
            let val = this.value.replace(/[^0-9.]/g, '');
            if ((val.match(/\./g) || []).length > 1) {
                val = val.substring(0, val.lastIndexOf('.'));
            }
            if (val.includes('.')) {
                let parts = val.split('.');
                parts[0] = parts[0].substring(0, 4); // parte entera
                parts[1] = parts[1].substring(0, 2); // decimales
                val = parts.join('.');
            } else {
                val = val.substring(0, 4);
            }
            this.value = val;
        });

        // Envío del formulario con validaciones
        $('#btnAgregaArticulo').click(function () {
            let categoria = $('#categoriaSelect').val();
            let nombre = $('#nombre').val().trim();
            let descripcion = $('#descripcion').val().trim();
            let cantidad = $('#cantidad').val().trim();
            let precio = $('#precio').val().trim();

            if (categoria === 'A' || nombre === '' || descripcion === '' || cantidad === '' || precio === '') {
                alertify.alert("Todos los campos son obligatorios.");
                return false;
            }

            var formData = new FormData(document.getElementById("frmArticulos"));

            $.ajax({
                url: "../procesos/articulos/insertaArticulos.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                success: function (r) {
                    if (r == 1) {
                        $('#frmArticulos')[0].reset();
                        $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
                        alertify.success("Agregado con éxito :D");
                    } else {
                        alertify.error("Fallo al subir el archivo :(");
                    }
                }
            });
        });
    });
