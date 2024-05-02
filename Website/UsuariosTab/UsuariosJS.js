const search = document.querySelector('.input-group input'),
    table_rows = document.querySelectorAll('tbody tr');

search.addEventListener('input', searchTable);

function searchTable() {
    const searchValue = search.value.toLowerCase(); // Convertir el texto de búsqueda a minúsculas para una comparación insensible a mayúsculas y minúsculas
    
    table_rows.forEach((row) => {
        let rowVisible = false; // Variable para rastrear si la fila debe mostrarse
        
        // Iterar sobre cada celda de la fila
        row.querySelectorAll('td').forEach((cell) => {
            const cellText = cell.textContent.toLowerCase(); // Convertir el texto de la celda a minúsculas para una comparación insensible a mayúsculas y minúsculas
            
            // Verificar si el texto de búsqueda está presente en la celda
            if (cellText.includes(searchValue)) {
                rowVisible = true; // Si se encuentra el texto de búsqueda en alguna celda, marcar la fila como visible
            }
        });
        
        // Aplicar la visibilidad de la fila según el resultado de la comparación
        row.style.display = rowVisible ? 'table-row' : 'none';
    });
}

const expandBtn = document.querySelector('.expand-btn');
const navbarBottom = document.querySelector('.navbar-bottom');


expandBtn.addEventListener('click', function() {
    navbarBottom.classList.toggle('expanded');

    const isExpanded = navbarBottom.classList.contains('expanded');
    buttons.forEach(button => {
        
    });
});

const keyButton = document.querySelector('.expand-btn');

keyButton.addEventListener('click', () => {
    const keyIcon = document.querySelector('.expand-btn');
    keyIcon.classList.add('shake-animation');

    // Eliminar la clase de animación después de 500 milisegundos (0.5 segundos)
    setTimeout(() => {
        keyIcon.classList.remove('shake-animation');
    }, 500);
});






