// Función para actualizar el contador visual del carrito
function actualizarContadorVisual(count) {
    const cartIcon = document.querySelector('.cart-icon');
    let cartCount = document.querySelector('.cart-count');
    
    if (count > 0) {
        if (cartCount) {
            cartCount.textContent = count;
        } else {
            cartCount = document.createElement('span');
            cartCount.className = 'cart-count';
            cartCount.textContent = count;
            cartIcon.appendChild(cartCount);
        }
    } else {
        if (cartCount) {
            cartCount.remove();
        }
    }
}

// Función para agregar productos al carrito
function agregarAlCarrito(productoId) {
    fetch('agregar_carrito.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            producto_id: productoId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Actualizar el contador del carrito
            actualizarContadorVisual(data.cartCount);
            
            // Mostrar mensaje de éxito
            alert('Producto agregado al carrito');
            
            // Disparar evento de actualización
            const event = new CustomEvent('cartUpdated', { detail: { count: data.cartCount } });
            document.dispatchEvent(event);
        } else {
            alert(data.message || 'Error al agregar el producto al carrito');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al procesar la solicitud');
    });
}

// Función para actualizar la cantidad de productos
function actualizarCantidad(productoId, accion) {
    fetch('actualizar_carrito.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            producto_id: productoId,
            accion: accion
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Actualizar el contador del carrito
            if (data.cartCount !== undefined) {
                actualizarContadorVisual(data.cartCount);
            }
            // Recargar la página para actualizar los precios
            window.location.reload();
        } else {
            alert(data.message || 'Error al actualizar el carrito');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al actualizar el carrito');
    });
}

// Función para eliminar productos del carrito
function eliminarProducto(productoId) {
    if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        fetch('eliminar_producto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                producto_id: productoId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualizar el contador del carrito
                if (data.cartCount !== undefined) {
                    actualizarContadorVisual(data.cartCount);
                }
                // Recargar la página para actualizar la vista
                window.location.reload();
            } else {
                alert(data.message || 'Error al eliminar el producto');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al eliminar el producto');
        });
    }
}

// Escuchar eventos de actualización del carrito
document.addEventListener('DOMContentLoaded', () => {
    // Actualizar contador inicial
    fetch('actualizar_contador_carrito.php')
        .then(response => response.json())
        .then(data => {
            if (data.count !== undefined) {
                actualizarContadorVisual(data.count);
            }
        })
        .catch(error => console.error('Error al cargar el contador:', error));
});

// Escuchar cambios en el carrito
document.addEventListener('cartUpdated', (event) => {
    if (event.detail && event.detail.count !== undefined) {
        actualizarContadorVisual(event.detail.count);
    }
});