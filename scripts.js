const itemsPerPage = 5;
const totalItems = 12; 
const results = Array.from({ length: totalItems }, (_, i) => 'Barang ${i + 1}');


let currentPage = 1;


function renderResults(page) {
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const currentResults = results.slice(startIndex, endIndex);

    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = `
        <ul>
            ${currentResults.map(item => <li>${item}</li>).join('')}
        </ul>
    `;
}


function updatePaginationButtons() {
    const pageButtons = document.querySelectorAll('.pagination .page');
    pageButtons.forEach(button => {
        const page = parseInt(button.dataset.page, 10);
        button.classList.toggle('active', page === currentPage);
    });

    document.getElementById('prev').disabled = currentPage === 1;
    document.getElementById('next').disabled = currentPage === Math.ceil(totalItems / itemsPerPage);
}


document.querySelector('.pagination').addEventListener('click', (event) => {
    const target = event.target;

    if (target.id === 'prev' && currentPage > 1) {
        currentPage--;
    } else if (target.id === 'next' && currentPage < Math.ceil(totalItems / itemsPerPage)) {
        currentPage++;
    } else if (target.classList.contains('page')) {
        currentPage = parseInt(target.dataset.page, 10);
    }

    renderResults(currentPage);
    updatePaginationButtons();
});

// Inisialisasi pertama kali
renderResults(currentPage);
updatePaginationButtons();