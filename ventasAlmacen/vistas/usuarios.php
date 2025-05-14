<?php 
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['usuario']=='admin'){
?>
<!DOCTYPE html>
<html>
<head>
    <title>Usuarios</title>
    <?php require_once "menu.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .input-group {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }
        .is-invalid {
            border-color: red;
        }
        .error-msg {
            color: red;
            font-size: 12px;
            margin-top: 3px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Administrar usuarios</h1>
    <div class="row">
        <div class="col-sm-4">
            <form id="frmRegistro">
                <label>Nombre</label>
                <input type="text" class="form-control input-sm" name="nombre" id="nombre" required>
                <div class="error-msg" id="errorNombre"></div>

                <label>Apellido</label>
                <input type="text" class="form-control input-sm" name="apellido" id="apellido" required>
                <div class="error-msg" id="errorApellido"></div>

                <label>Usuario</label>
                <input type="text" class="form-control input-sm" name="usuario" id="usuario" required>
                <div class="error-msg" id="errorUsuario"></div>

                <label>Password</label>
                <div class="input-group">
                    <input type="password" class="form-control input-sm" name="password" id="password" required>
                    <i class="fa fa-eye toggle-password" id="togglePassword"></i>
                </div>
                <div class="error-msg" id="errorPassword"></div>

                <p></p>
                <span class="btn btn-primary" id="registro">Registrar</span>
            </form>
        </div>
        <div class="col-sm-7">
            <div id="tablaUsuariosLoad"></div>
        </div>
    </div>
</div>

<!-- Modal de actualización -->
<div class="modal fade" id="actualizaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
            </div>
            <div class="modal-body">
                <form id="frmRegistroU">
                    <input type="text" hidden="" id="idUsuario" name="idUsuario">
                    <label>Nombre</label>
                    <input type="text" class="form-control input-sm" name="nombreU" id="nombreU">
                    <label>Apellido</label>
                    <input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU">
                    <label>Usuario</label>
                    <input type="text" class="form-control input-sm" name="usuarioU" id="usuarioU">
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnActualizaUsuario" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar Usuario</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>

<script type="text/javascript">
    const regexNombre = /^[A-Za-zÁÉÍÓÚáéíóúÑñ]+( [A-Za-zÁÉÍÓÚáéíóúÑñ]+)?$/;
    const regexUsuario = /^\S{4,20}$/;
    const regexPassword = /^\S{6,20}$/;

    function mostrarError(input, mensaje) {
        $(input).addClass("is-invalid");
        $('#error' + input.id.charAt(0).toUpperCase() + input.id.slice(1)).text(mensaje);
    }

    function limpiarError(input) {
        $(input).removeClass("is-invalid");
        $('#error' + input.id.charAt(0).toUpperCase() + input.id.slice(1)).text("");
    }

    function validarCampo(input, regex, min, max, mensaje) {
        const valor = input.value.trim();
        if (valor.length < min || valor.length > max || !regex.test(valor)) {
            mostrarError(input, mensaje);
            return false;
        } else {
            limpiarError(input);
            return true;
        }
    }

    function validarFormulario() {
        const nombre = document.getElementById("nombre");
        const apellido = document.getElementById("apellido");
        const usuario = document.getElementById("usuario");
        const password = document.getElementById("password");

        let valido = true;

        valido &= validarCampo(nombre, regexNombre, 2, 30, "Nombre inválido: solo letras, máximo un espacio, entre 2 y 30 caracteres.");
        valido &= validarCampo(apellido, regexNombre, 2, 30, "Apellido inválido: solo letras, máximo un espacio, entre 2 y 30 caracteres.");
        valido &= validarCampo(usuario, regexUsuario, 4, 20, "Usuario inválido: sin espacios, entre 4 y 20 caracteres.");
        valido &= validarCampo(password, regexPassword, 6, 20, "Contraseña inválida: sin espacios, entre 6 y 20 caracteres.");

        return Boolean(valido);
    }

    $(document).ready(function() {
        $('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');

        // Validación en tiempo real
        $('#nombre').on('input', function () {
            validarCampo(this, regexNombre, 2, 30, "Nombre inválido: solo letras, máximo un espacio, entre 2 y 30 caracteres.");
        });
        $('#apellido').on('input', function () {
            validarCampo(this, regexNombre, 2, 30, "Apellido inválido: solo letras, máximo un espacio, entre 2 y 30 caracteres.");
        });
        $('#usuario').on('input', function () {
            validarCampo(this, regexUsuario, 4, 20, "Usuario inválido: sin espacios, entre 4 y 20 caracteres.");
        });
        $('#password').on('input', function () {
            validarCampo(this, regexPassword, 6, 20, "Contraseña inválida: sin espacios, entre 6 y 20 caracteres.");
        });

        $('#togglePassword').click(function () {
            const input = $('#password');
            const tipo = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', tipo);
            $(this).toggleClass('fa-eye fa-eye-slash');
        });

        $('#registro').click(function(e) {
            e.preventDefault();
            if (!validarFormulario()) {
                alertify.error("Revisa los campos marcados en rojo");
                return;
            }

            const datos = $('#frmRegistro').serialize();
            $.ajax({
                type: "POST",
                data: datos,
                url: "../procesos/regLogin/registrarUsuario.php",
                success: function(r) {
                    if (r == 1) {
                        $('#frmRegistro')[0].reset();
                        $('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
                        alertify.success("Usuario registrado con éxito");
                    } else {
                        alertify.error("No se pudo registrar");
                    }
                }
            });
        });

        $('#btnActualizaUsuario').click(function() {
            const datos = $('#frmRegistroU').serialize();
            $.ajax({
                type: "POST",
                data: datos,
                url: "../procesos/usuarios/actualizaUsuario.php",
                success: function(r) {
                    if (r == 1) {
                        $('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
                        alertify.success("Actualizado con éxito");
                    } else {
                        alertify.error("No se pudo actualizar");
                    }
                }
            });
        });
    });

    function agregaDatosUsuario(idusuario) {
        $.ajax({
            type: "POST",
            data: "idusuario=" + idusuario,
            url: "../procesos/usuarios/obtenDatosUsuario.php",
            success: function(r) {
                const dato = jQuery.parseJSON(r);
                $('#idUsuario').val(dato['id_usuario']);
                $('#nombreU').val(dato['nombre']);
                $('#apellidoU').val(dato['apellido']);
                $('#usuarioU').val(dato['email']);
            }
        });
    }

    function eliminarUsuario(idusuario) {
        alertify.confirm('¿Desea eliminar este usuario?', function() {
            $.ajax({
                type: "POST",
                data: "idusuario=" + idusuario,
                url: "../procesos/usuarios/eliminarUsuario.php",
                success: function(r) {
                    if (r == 1) {
                        $('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
                        alertify.success("Eliminado con éxito");
                    } else {
                        alertify.error("No se pudo eliminar");
                    }
                }
            });
        }, function() {
            alertify.error('Cancelado');
        });
    }
</script>

<?php 
} else {
    header("location:../index.php");
}
?>
