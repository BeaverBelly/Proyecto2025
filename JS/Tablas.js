const cont = document.getElementById("TablaPagGlaciares");
if (cont) {
  cont.innerHTML = '<div class="text-center py-4">Cargando tabla…</div>';

  fetch("PHP/TablaGlaciaresEmblematicos.php", { cache: "no-store" })
    .then(res => {
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      return res.text();
    })
    .then(html => {
      cont.innerHTML = html;
    })
    .catch(err => {
      console.error("Error cargando la tabla", err);
      cont.innerHTML = `
        <div class="alert alert-danger" role="alert">
          No se pudo cargar la tabla. Intentá recargar la página.
        </div>`;
    });
}
