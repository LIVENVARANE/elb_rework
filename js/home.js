function discoverAnim() {
    document.getElementById('discover-anim').style.left = '0px';

    setTimeout(function() {
        link('discover.php?anim')
    }, 300);
}