document.addEventListener("DOMContentLoaded", () => {
    let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

    function actualizarCarrito() {
        localStorage.setItem("carrito", JSON.stringify(carrito));
        let lista = document.getElementById("lista-carrito");
        lista.innerHTML = "";
        carrito.forEach((item, index) => {
            lista.innerHTML += `<li class="list-group-item d-flex justify-content-between">
                ${item.nombre} x${item.cantidad} - $${item.precio * item.cantidad}
                <button class="btn btn-danger btn-sm" onclick="eliminarDelCarrito(${index})">❌</button>
            </li>`;
        });
    }

    window.agregarAlCarrito = function (id, nombre, precio) {
        let pizza = carrito.find(p => p.id === id);
        if (pizza) {
            pizza.cantidad++;
        } else {
            carrito.push({ id, nombre, precio, cantidad: 1 });
        }
        actualizarCarrito();
    };

    window.eliminarDelCarrito = function (index) {
        carrito.splice(index, 1);
        actualizarCarrito();
    };

    actualizarCarrito();
});
