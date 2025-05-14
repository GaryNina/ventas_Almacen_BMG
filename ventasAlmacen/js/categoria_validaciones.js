$(document).ready(function(){

    $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");

    // Validación en tiempo real del campo "categoria"
    $('#categoria').on('input', function(){
        let valor = $(this).val();
        let mensaje = '';
        let regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]*$/;

        if(valor.length > 15){
            mensaje = 'Máximo 15 caracteres permitidos.';
            $('#mensajeCategoria').css('color', 'red');
        } else if(!regex.test(valor)){
            mensaje = 'Solo se permiten letras (sin números ni símbolos).';
            $('#mensajeCategoria').css('color', 'red');
        } else {
            mensaje = '¡Formato válido!';
            $('#mensajeCategoria').css('color', 'green');
        }

        $('#mensajeCategoria').text(mensaje);
    });

    // Validación final antes de enviar
    $('#btnAgregaCategoria').click(function(){

        let valor = $('#categoria').val();
        let regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{1,15}$/;

        if(valor.trim() === ''){
            alertify.alert("Debes llenar todos los campos!!");
            return false;
        }

        if(!regex.test(valor)){
            alertify.alert("Categoría inválida. Solo letras, sin símbolos y hasta 15 caracteres.");
            return false;
        }

        let datos = $('#frmCategorias').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"../procesos/categorias/agregaCategoria.php",
            success:function(r){
                if(r==1){
                    $('#frmCategorias')[0].reset();
                    $('#mensajeCategoria').text('');
                    $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
                    alertify.success("Categoria agregada con exito :D");
                }else{
                    alertify.error("No se pudo agregar categoria");
                }
            }
        });
    });
});
$(document).ready(function(){

    // Validación en tiempo real para actualizar
    $('#categoriaU').on('input', function(){
        let valor = $(this).val();
        let mensaje = '';
        let regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]*$/;

        if(valor.length > 15){
            mensaje = 'Máximo 15 caracteres permitidos.';
            $('#mensajeCategoriaU').css('color', 'red');
        } else if(!regex.test(valor)){
            mensaje = 'Solo se permiten letras (sin números ni símbolos).';
            $('#mensajeCategoriaU').css('color', 'red');
        } else {
            mensaje = '¡Formato válido!';
            $('#mensajeCategoriaU').css('color', 'green');
        }

        $('#mensajeCategoriaU').text(mensaje);
    });

    // Validación antes de enviar actualización
    $('#btnActualizaCategoria').click(function(){

        let valor = $('#categoriaU').val();
        let regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{1,15}$/;

        if(valor.trim() === ''){
            alertify.alert("Debes llenar el campo de categoría");
            return false;
        }

        if(!regex.test(valor)){
            alertify.alert("Categoría inválida. Solo letras, sin símbolos y hasta 15 caracteres.");
            return false;
        }

        let datos = $('#frmCategoriaU').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"../procesos/categorias/actualizaCategoria.php",
            success:function(r){
                if(r==1){
                    $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
                    alertify.success("Actualizado con exito :)");
                }else{
                    alertify.error("no se pudo actualizar :(");
                }
            }
        });
    });
});


    function agregaDato(idCategoria,categoria){
        $('#idcategoria').val(idCategoria);
        $('#categoriaU').val(categoria);
    }

    function eliminaCategoria(idcategoria){
        alertify.confirm('¿Desea eliminar esta categoria?', function(){ 
            $.ajax({
                type:"POST",
                data:"idcategoria=" + idcategoria,
                url:"../procesos/categorias/eliminarCategoria.php",
                success:function(r){
                    if(r==1){
                        $('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
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
