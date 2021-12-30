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

function toggleHeaderMore() {
    if(document.querySelector('.more-container').classList.contains('shown')) { //normal buttons mode
        document.querySelector('.media-container').classList.remove('shown');
        document.querySelector('.more-container').classList.remove('shown');
        document.querySelector('.buttons-container').classList.add('shown');
    } else {
        document.querySelector('.media-container').classList.add('shown');
        document.querySelector('.more-container').classList.add('shown');
        document.querySelector('.buttons-container').classList.remove('shown');
    }
}

function mobileMenu(input) {
    if(document.getElementById('mobile-menu').style.left != '0px') { //mobile menu closed
        document.getElementById('mobile-menu').style.left = '0px';
    } else {
        document.getElementById('mobile-menu').style.left = '-100%';
    }
}