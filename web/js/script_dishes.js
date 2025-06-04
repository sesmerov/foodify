
document.addEventListener('DOMContentLoaded', function () {
    function setupMenu(buttonId, menuId, closeButtonId) {
        const button = document.getElementById(buttonId);
        const menu = document.getElementById(menuId);
        const closeButton = document.getElementById(closeButtonId);

        button.addEventListener('click', function (e) {
            e.stopPropagation();
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                menu.classList.add('opacity-0', 'scale-95');

                void menu.offsetWidth;

                menu.classList.remove('opacity-0', 'scale-95');
            } else {
                menu.classList.add('hidden');
            }
        });

        closeButton.addEventListener('click', function (e) {
            e.stopPropagation();
            menu.classList.add('hidden');
        });
    }

    setupMenu('tipo-comida-btn', 'tipo-comida-menu', 'close-tipo-comida');
    setupMenu('alergenos-btn', 'alergenos-menu', 'close-alergenos');

    document.addEventListener('click', function () {
        document.querySelectorAll('[id$="-menu"]').forEach(menu => {
            menu.classList.add('hidden');
        });
    });

    document.querySelectorAll('[id$="-menu"]').forEach(menu => {
        menu.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    });
});

function reducirPlato(id) {
    fetch(`index.php?order=removeFromCart&id_dish=${id}`, {
        method: "GET"
    }).then(() => {
        location.reload();
    });
}

function aumentarPlato(id) {
    fetch(`index.php?order=addToCart&id_dish=${id}`, {
        method: "GET"
    }).then(() => {
        location.reload();
    });
}


