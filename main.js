addEventListener("DOMContentLoaded", (e) => {
    let zodiacoForm = document.querySelector("#zodiacoForm");
    zodiacoForm.addEventListener("submit", async(e) => {
        e.preventDefault();
        let datos = Object.fromEntries(new FormData(e.target));
        let config = {
            method: zodiacoForm.method,
            body: JSON.stringify(datos)
        };
        let peticion = await fetch(zodiacoForm.action, config);
        let resultado = await peticion.json();
        document.querySelector("#resultado").innerHTML = resultado.mensaje;
    })
})