document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('img').forEach(function(img) {
        img.setAttribute('draggable', 'false');
    });
});

function link(where, newpage) {
    if(newpage == undefined || !newpage) {
        window.open(where, '_top');
    } else if(newpage) {
        window.open(where, '_blank');
    }
}