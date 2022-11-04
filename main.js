let sumaA = 0, sumaB = 0, sumaC = 0, cantidadA = 0, cantidadB = 0, cantidadC = 0;

function sumarPromedio(genero, carrera, edad) {
    if (genero == "masculino") {
        if (carrera == "a") {
            sumaA += edad;
            cantidadA += 1;
        } else if (carrera == "b") {
            sumaB += edad;
            cantidadB += 1
        } else {
            sumaC += edad;
            cantidadC += 1;
        }
    } else {
        null
    }
}
addEventListener("DOMContentLoaded", (e) => {
    document.querySelector("#cantidad").removeAttribute("disabled");
    document.querySelector("#cantidad").addEventListener("keyup", (e) => {
        let genero = document.querySelector("#genero");
        let edad = document.querySelector("#edad");
        let carrera = document.querySelector("#carrera");

        if (e.target.value > 0) {
            genero.removeAttribute("disabled");
            edad.removeAttribute("disabled");
            carrera.removeAttribute("disabled");
        } else {
            genero.disabled = true;
            edad.disabled = true;
            carrera.disabled = true;
        }
    })
    let contador = 1;
    let listaPromedio = [];
    let calcular = document.querySelector("#calcular");
    calcular.addEventListener("submit", async (e) => {
        e.preventDefault();
        let cantidad = document.querySelector("#cantidad").value;
        document.querySelector("#cantidad").disabled = true;
        if (contador < cantidad) {
            let datos = Object.fromEntries(new FormData(calcular));
            sumarPromedio(datos["genero"], datos["carrera"], parseInt(datos["edad"]));
            document.querySelector("#genero").selectedIndex = 0;
            document.querySelector("#edad").value = "";
            document.querySelector("#carrera").selectedIndex = 0;
            contador += 1;
        } else {
            let calcular = e.target;
            let datos = Object.fromEntries(new FormData(calcular));
            sumarPromedio(datos["genero"], datos["carrera"], parseInt(datos["edad"]));
            document.querySelector("#estudiantes").innerHTML = "";
            listaPromedio.push(sumaA);
            listaPromedio.push(cantidadA);
            listaPromedio.push(sumaB);
            listaPromedio.push(cantidadB);
            listaPromedio.push(sumaC);
            listaPromedio.push(cantidadC);

            let config = {
                method: calcular.method,
                body: JSON.stringify(listaPromedio)
            };

            let peticion = await fetch(calcular.action, config);
            let respuesta = await peticion.text();

            document.querySelector("#estudiantes").insertAdjacentHTML("beforeend", respuesta);
            document.querySelector("#genero").selectedIndex = 0;
            document.querySelector("#edad").value = "";
            document.querySelector("#carrera").selectedIndex = 0;
            genero.disabled = true;
            edad.disabled = true;
            carrera.disabled = true;
        }
    })
})