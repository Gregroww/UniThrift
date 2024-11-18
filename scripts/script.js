document.addEventListener("DOMContentLoaded", function() {
    const currentPage = window.location.pathname.split("/").pop();
    const menuItems = document.querySelectorAll('.sidebar ul li a');

    menuItems.forEach(item => {
        if (item.getAttribute("href") === currentPage) {
            item.parentElement.classList.add("active");
        }
    });
});

function openPopup(img) {
    const popupOverlay = document.querySelector('.popup-overlay');
    const popupImg = document.getElementById('popup-img');
    
    popupImg.src = img.src; 
    popupOverlay.style.display = 'flex';
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

function saveChanges() {
    const aboutUsText = document.getElementById('aboutUsContent').innerHTML;
    
    fetch('admin-tentang-kami.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'deskripsi=' + encodeURIComponent(aboutUsText)
    })
    .then(response => response.text())
    .then(data => {
        alert('Perubahan berhasil disimpan!');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan perubahan.');
    });
}
