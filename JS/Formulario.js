const form = document.getElementById("FormSolicitud");

form.addEventListener("submit", (eventform) => {
  eventform.preventDefault();
  console.log("Formulario enviado sin recargar");

  form.reset();

  alert("Formulario enviado con éxito");
  
});