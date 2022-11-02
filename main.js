addEventListener("DOMContentLoaded", (e) => {
    let calcular = document.querySelector("#calcular");
    calcular.addEventListener("submit", async(e) => {
        e.preventDefault();
        let datos = Object.fromEntries(new FormData(e.target));
        let config = {
            method: calcular.method,
            body: JSON.stringify(datos)
        };
        let peticion = await fetch(calcular.action, config);
        let resultado = await peticion.text();
        document.querySelector("#resultado").innerHTML = resultado;
    })
})