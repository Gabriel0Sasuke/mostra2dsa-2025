let x = 0;
function admin() {
    x++;
}
function paginanova() {
    if (x >= 5) {
        window.location.href = "PHP/admin/admin.php";
    }
}