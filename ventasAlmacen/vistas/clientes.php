<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>clientes</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Clientes</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmClientes">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre" minlength="3" maxlength="20">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" id="apellidos" name="apellidos" minlength="10" maxlength="30">
						<label>Direccion</label>
						<input type="text" class="form-control input-sm" id="direccion" name="direccion" minlength="10" maxlength="20">
						<label>Email</label>
						<input type="text" class="form-control input-sm" id="email" name="email" minlength="10" maxlength="15">
						<label>Telefono</label>
						<input type="text" class="form-control input-sm" id="telefono" name="telefono" minlength="8" maxlength="8">
						<label>RFC</label>
						<input type="text" class="form-control input-sm" id="rfc" name="rfc" minlength="15" maxlength="15">
						<p></p>
						<span class="btn btn-primary" id="btnAgregarCliente">Agregar</span>
                        <span class="btn btn-warning" id="btnLimpiarCliente">Limpiar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaClientesLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalClientesUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar cliente</h4>
					</div>
					<div class="modal-body">
						<form id="frmClientesU">
							<input type="text" hidden="" id="idclienteU" name="idclienteU">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" id="apellidosU" name="apellidosU">
							<label>Direccion</label>
							<input type="text" class="form-control input-sm" id="direccionU" name="direccionU">
							<label>Email</label>
							<input type="text" class="form-control input-sm" id="emailU" name="emailU">
							<label>Telefono</label>
							<input type="text" class="form-control input-sm" id="telefonoU" name="telefonoU">
							<label>RFC</label>
							<input type="text" class="form-control input-sm" id="rfcU" name="rfcU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAgregarClienteU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>


    <script type="text/javascript">
//LIMPIAR CELDA CLIENTE
		$('#btnLimpiarCliente').click(function(){
                $('#frmClientes')[0].reset();
            });
</script>


<script>
	// Función para validar campos individuales
	function validarCampo(idCampo, regex, maxLength, obligatorio = true) {
		const campo = document.getElementById(idCampo);
		campo.addEventListener('input', function () {
			const valor = campo.value;
			let valido = true;

			if (obligatorio && valor.trim() === '') {
				valido = false;
			} else if (valor.length > maxLength) {
				valido = false;
			} else if (!regex.test(valor) && valor !== '') {
				valido = false;
			}

			if (!valido) {
				campo.style.borderColor = 'red';
			} else {
				campo.style.borderColor = '';
			}
		});
	}

	// Llama a la función para cada campo
	document.addEventListener('DOMContentLoaded', function () {
		validarCampo('nombre', /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{1,15}$/, 15);
		validarCampo('apellidos', /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{1,30}$/, 30);
		validarCampo('direccion', /^.{1,40}$/, 40);
		validarCampo('email', /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 100, false); // no obligatorio
		validarCampo('telefono', /^\d{8}$/, 8);
		validarCampo('rfc', /^.{1,30}$/, 30);

		// Para actualizar
		validarCampo('nombreU', /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{1,15}$/, 15);
		validarCampo('apellidosU', /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{1,30}$/, 30);
		validarCampo('direccionU', /^.{1,40}$/, 40);
		validarCampo('emailU', /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 100, false);
		validarCampo('telefonoU', /^\d{8}$/, 8);
		validarCampo('rfcU', /^.{1,30}$/, 30);
	});
</script>



	<script type="text/javascript">
		function agregaDatosCliente(idcliente){

			$.ajax({
				type:"POST",
				data:"idcliente=" + idcliente,
				url:"../procesos/clientes/obtenDatosCliente.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#idclienteU').val(dato['id_cliente']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidosU').val(dato['apellido']);
					$('#direccionU').val(dato['direccion']);
					$('#emailU').val(dato['email']);
					$('#telefonoU').val(dato['telefono']);
					$('#rfcU').val(dato['rfc']);

				}
			});
		}

		function eliminarCliente(idcliente){
			alertify.confirm('¿Desea eliminar este cliente?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcliente=" + idcliente,
					url:"../procesos/clientes/eliminarCliente.php",
					success:function(r){
						if(r==1){
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
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

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaClientesLoad').load("clientes/tablaClientes.php");

			$('#btnAgregarCliente').click(function(){

				vacios=validarFormVacio('frmClientes');

				if(vacios > 0){
	                alertify.alert("⚠️ Debes llenar todos los campos para continuar.");
	            return false;
                }

                let nombre = $('#nombre').val().trim();
                let apellidos = $('#apellidos').val().trim();
                let direccion = $('#direccion').val().trim();
                let email = $('#email').val().trim();
                let telefono = $('#telefono').val().trim();
                let rfc = $('#rfc').val().trim();

                if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{1,15}$/.test(nombre)) {
                	alertify.alert("😕 El nombre solo debe contener letras y máximo 15 caracteres.");
                	return false;
                }

                if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{1,30}$/.test(apellidos)) {
                	alertify.alert("😕 Los apellidos solo deben contener letras y máximo 30 caracteres.");
                	return false;
                }

                if (direccion.length > 40) {
                	alertify.alert("📍 La dirección no puede superar los 40 caracteres.");
                	return false;
                }

                if (email !== '' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                	alertify.alert("📧 El correo ingresado no es válido.");
                	return false;
                }

                if (!/^\d{8}$/.test(telefono)) {
                	alertify.alert("📞 El teléfono debe tener exactamente 8 dígitos.");
                	return false;
                }

                if (rfc.length > 30) {
                	alertify.alert("🆔 El RFC no debe tener más de 30 caracteres.");
                	return false;
                }

				datos=$('#frmClientes').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/agregaCliente.php",
					success:function(r){
						if(r==1){
							$('#frmClientes')[0].reset();
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Cliente agregado con exito :D");
						}else{
							alertify.error("No se pudo agregar cliente");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAgregarClienteU').click(function(){
				datos=$('#frmClientesU').serialize();

                let nombreU = $('#nombreU').val().trim();
                let apellidosU = $('#apellidosU').val().trim();
                let direccionU = $('#direccionU').val().trim();
                let emailU = $('#emailU').val().trim();
                let telefonoU = $('#telefonoU').val().trim();
                let rfcU = $('#rfcU').val().trim();

                if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{1,15}$/.test(nombreU)) {
                	alertify.alert("😕 El nombre solo debe contener letras y máximo 15 caracteres.");
                	return false;
                }

                if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{1,30}$/.test(apellidosU)) {
                	alertify.alert("😕 Los apellidos solo deben contener letras y máximo 30 caracteres.");
                	return false;
                }

                if (direccionU.length > 40) {
                	alertify.alert("📍 La dirección no puede superar los 40 caracteres.");
                	return false;
                }

                if (emailU !== '' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailU)) {
                	alertify.alert("📧 El correo ingresado no es válido.");
                	return false;
                }

                if (!/^\d{8}$/.test(telefonoU)) {
                	alertify.alert("📞 El teléfono debe tener exactamente 8 dígitos.");
                	return false;
                }

                if (rfcU.length > 30) {
                	alertify.alert("🆔 El RFC no debe tener más de 30 caracteres.");
                	return false;
                }
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/actualizaCliente.php",
					success:function(r){

						if(r==1){
							$('#frmClientes')[0].reset();
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Cliente actualizado con exito :D");
						}else{
							alertify.error("No se pudo actualizar cliente");
						}
					}
				});
			})
		})
	</script>


	<?php 
}else{
	header("location:../index.php");
}
?>