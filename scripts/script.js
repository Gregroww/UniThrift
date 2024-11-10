document.addEventListener("DOMContentLoaded", function() {
    // Dapatkan URL halaman saat ini
    const currentPage = window.location.pathname.split("/").pop();
    
    // Pilih semua item menu di sidebar
    const menuItems = document.querySelectorAll('.sidebar ul li a');

    // Loop melalui item menu dan tambahkan kelas 'active' ke item yang cocok dengan URL saat ini
    menuItems.forEach(item => {
        if (item.getAttribute("href") === currentPage) {
            item.parentElement.classList.add("active");
        }
    });
});
