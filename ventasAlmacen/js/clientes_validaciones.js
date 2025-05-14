// clientes_validaciones.js

function validarClienteFormulario(formId) {
    const form = document.getElementById(formId);
    const inputs = form.querySelectorAll('input');
    let valid = true;
    let mensajes = [];
  
    inputs.forEach(input => {
      const id = input.id;
      const valor = input.value.trim();
      const nombreCampo = input.previousElementSibling?.textContent || id;
  
      // Solo validar si el campo no está vacío o es obligatorio
      const obligatorio = ['nombre', 'apellidos', 'telefono'].includes(input.name);
      if (obligatorio && valor === '') {
        mensajes.push(`${nombreCampo} es obligatorio.`);
        valid = false;
        return;
      }
  
      if (valor !== '') {
        switch(id) {
          case 'nombre':
          case 'nombreU':
            if (valor.length > 20) {
              mensajes.push(`${nombreCampo} no debe superar 20 caracteres.`);
              valid = false;
            }
            break;
          case 'apellidos':
          case 'apellidosU':
            if (valor.length > 30) {
              mensajes.push(`${nombreCampo} no debe superar 30 caracteres.`);
              valid = false;
            }
            break;
          case 'direccion':
          case 'direccionU':
            if (valor.length > 50) {
              mensajes.push(`${nombreCampo} no debe superar 50 caracteres.`);
              valid = false;
            }
            break;
          case 'rfc':
          case 'rfcU':
            if (valor.length > 100) {
              mensajes.push(`${nombreCampo} no debe superar 100 caracteres.`);
              valid = false;
            }
            break;
          case 'email':
          case 'emailU':
            if (!valor.includes('@')) {
              mensajes.push(`${nombreCampo} debe contener un '@'.`);
              valid = false;
            }
            break;
          case 'telefono':
          case 'telefonoU':
            if (!/^[0-9]+$/.test(valor)) {
              mensajes.push(`${nombreCampo} solo debe contener números.`);
              valid = false;
            } else if (valor.length > 8) {
              mensajes.push(`${nombreCampo} no debe superar 8 dígitos.`);
              valid = false;
            }
            break;
        }
      }
    });
  
    if (!valid) {
      alertify.alert("Errores en el formulario:", mensajes.join("<br>"));
    } else {
      alertify.success("Todos los datos cumplen los requisitos ✨");
    }
  
    return valid;
  }
  
  function limpiarFormulario(formId) {
    const form = document.getElementById(formId);
    form.reset();
    alertify.message("Formulario limpiado 🧼");
  }
  