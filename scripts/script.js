// Fungsi untuk menampilkan dan menyembunyikan sidebar
document.addEventListener("DOMContentLoaded", function() {
    const currentPage = window.location.pathname.split("/").pop();
    const menuItems = document.querySelectorAll('.sidebar ul li a');

    menuItems.forEach(item => {
        if (item.getAttribute("href") === currentPage) {
            item.parentElement.classList.add("active");
        }
    });
});

// Settingan untuk popup gambar
function openPopup(img) {
    const popupOverlay = document.querySelector('.popup-overlay');
    const popupImg = document.getElementById('popup-img');
    
    popupImg.src = img.src; // Set gambar popup sesuai dengan gambar yang diklik
    popupOverlay.style.display = 'flex'; // Tampilkan popup
}

function closePopup() {
    document.querySelector('.popup-overlay').style.display = 'none';
}

document.addEventListener("DOMContentLoaded", function() {
    const deleteButtons = document.querySelectorAll('.btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = button.closest('tr');
            row.remove();
        });
    });

    const deleteButton = document.getElementById('btn');
    if (deleteButton) {
        deleteButton.addEventListener('click', function() {
            const row = deleteButton.closest('tr');
            row.remove();
        });
    }
});