fetch("PHP/TablaGlaciaresEmblematicos.php")
    .then(res => res.text())
    .then(html =>{
        document.getElementById("TablaPagGlaciares").innerHTML = html;
    })  
    .catch(err => console.error("Error cargando la tabla", err));