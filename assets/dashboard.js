let flashMessage = document.getElementById('flashMessage');

let btnFlashMessage = document.getElementById('btnFlashMessage');
if (flashMessage && btnFlashMessage) {
    btnFlashMessage.addEventListener('click', function () {
        flashMessage.style.display = "none";
    });
}

let showMoreButton = document.getElementById('show-more-schemas');
if (showMoreButton) {
    showMoreButton.addEventListener('click', function () {
        let schemas = document.querySelectorAll('.schema-card');
        schemas.forEach(function (schema) {
            schema.classList.remove('d-none');
        })
        showMoreButton.style.display = 'none';
    });
}
