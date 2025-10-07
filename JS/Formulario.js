const form = document.getElementById("FormSolicitud");
const controls = Array.from(form.querySelectorAll("input, select, textarea"));

// Función para revisar cada campo
function marcarErrores() {
  controls.forEach(ctrl => {
    if (typeof ctrl.value === "string") ctrl.value = ctrl.value.trim();

    if (!ctrl.checkValidity()) {
      ctrl.classList.add("is-invalid");
      ctrl.classList.remove("is-valid");
    } else {
      // No mostrar verde todavía
      ctrl.classList.remove("is-invalid");
      ctrl.classList.remove("is-valid");
    }
  });
}

// Quita error en tiempo real cuando el campo mejora
function limpiarErroresAlEscribir() {
  controls.forEach(ctrl => {
    ctrl.addEventListener("input", () => {
      if (ctrl.checkValidity()) {
        ctrl.classList.remove("is-invalid");
      }
    });
  });
}

limpiarErroresAlEscribir();

form.addEventListener("submit", (event) => {
  event.preventDefault();

  // Revisión de errores
  marcarErrores();

  // Si hay errores, detenemos el envío
  const hayErrores = !form.checkValidity();
  if (hayErrores) return;

  // Ahora sí: todos correctos → marcar verde
  controls.forEach(c => c.classList.add("is-valid"));

  // Mensaje y reset
  console.log("Formulario enviado sin recargar");
  alert("Formulario enviado con éxito");

  form.reset();

  // Limpia clases visuales después del envío
  controls.forEach(c => {
    c.classList.remove("is-valid");
    c.classList.remove("is-invalid");
  });
});
