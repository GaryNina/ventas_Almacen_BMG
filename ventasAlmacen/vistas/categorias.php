<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>categorias</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>

		<div class="container">
			<h1>Categorias</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmCategorias">
						<label>Categoria</label>
						<input type="text" class="form-control input-sm" name="categoria" id="categoria">
						<small id="mensajeCategoria" style="color:red;"></small>
						<p></p>
						<span class="btn btn-primary" id="btnAgregaCategoria">Agregar</span>
						<span class="btn btn-warning" id="btnLimpiarCategoria">Limpiar</span>
					</form>
				</div>
				<div class="col-sm-6">
					<div id="tablaCategoriaLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->

<!--SCRIPT PARA LIMPIAR CELDAS -->
<script type="text/javascript">
	//LIMPIAR CELDA CATEGORIA
		$('#btnLimpiarCategoria').click(function(){
                $('#frmCategorias')[0].reset();
            });
</script>
		<!-- Modal -->
		<div class="modal fade" id="actualizaCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza categorias</h4>
					</div>
					<div class="modal-body">
						<form id="frmCategoriaU">
							<input type="text" hidden="" id="idcategoria" name="idcategoria">
							<!--<label>Categoria</label>
							<input type="text" id="categoriaU" name="categoriaU" class="form-control input-sm"> -->
							<label>Categoria</label>
							<input type="text" id="categoriaU" name="categoriaU" class="form-control input-sm" >
							<small id="mensajeCategoriaU" style="color:red;"></small>
							<p></p>
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" id="btnActualizaCategoria" class="btn btn-warning" data-dismiss="modal">Guardar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

<!--SCRIPT PARA AGREGAR -->
<script type="text/javascript">
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
</script>


<!--SCRIPT PARA ACTUALIZAR CATEGORIAS -->
<script type="text/javascript">
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
</script>

<!-- SCRIPT PARA ELIMINAR CATEGORIAS -->	
<script type="text/javascript">
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
</script>
	<?php 
}else{
	header("location:../index.php");
}
?>