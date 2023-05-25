

function showModal(title, text) {
    const modal = new bootstrap.Modal(document.getElementById('errorModal'));

    $('#errorModalTitle').text(title);
    $('#errorModalText').text(text);
    
    modal.show();
}