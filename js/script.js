document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modal');
    const abrirModal = document.getElementById('abrirModal');
    const cerrarModal = document.getElementById('cerrarModal');

    abrirModal.addEventListener('click', function() {
        modal.style.display = 'block';
    });

    cerrarModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});

function mensajeAlerta(message){
                var alertBox = document.createElement('div');
                alertBox.style.padding = '10px';
                alertBox.style.backgroundColor = '#f2f2f2';
                alertBox.style.border = '1px solid #ccc';
                alertBox.style.borderRadius = '5px';
                alertBox.style.fontFamily = 'Arial, sans-serif';
                alertBox.textContent = message;

                var overlay = document.createElement('div');
                overlay.style.position = 'fixed';
                overlay.style.top = '0';
                overlay.style.left = '0';
                overlay.style.width = '100%';
                overlay.style.height = '100%';
                overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
                overlay.style.zIndex = '9999';
                overlay.appendChild(alertBox);

                document.body.appendChild(overlay);

                setTimeout(function() {
                    document.body.removeChild(overlay);
                    window.location = '../gestion_huespedes.php';
                }, 10000);
}