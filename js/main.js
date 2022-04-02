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

function mobileMenu(input) {
    if(document.getElementById('mobile-menu').style.left != '0px') { //mobile menu closed
        document.getElementById('mobile-menu').style.left = '0px';
    } else {
        document.getElementById('mobile-menu').style.left = '-100%';
    }
}