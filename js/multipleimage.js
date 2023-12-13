
function addPhotoInput() {
    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.className = 'form-control mt-2';
    fileInput.name = 'photo_upload[]';
    fileInput.accept = 'image/*';
    document.getElementById('photoInputs').appendChild(fileInput);
}

function toggleCollapse(collapseId) {
    const collapseElement = document.getElementById(collapseId);
    const isCollapsed = collapseElement.classList.contains("show");

    if (isCollapsed) {
        collapseElement.classList.remove("show");
    }
}