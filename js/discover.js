var discover_items = ['plus_icon.png', 'test.png', 'test2.png', 'end.png'];
var discover_item_index = 0;
var slideshow_img;

document.addEventListener('DOMContentLoaded', function() {
    slideshow_img = document.getElementById('slideshow');
    slideshow_img.src = 'assets/discover/' + discover_items[0];
});

function lastItem() {
    if(discover_item_index != 0) {
        discover_item_index--;
        slideshow_img.src = 'assets/discover/' + discover_items[discover_item_index];
    }
}

function nextItem() {
    if(discover_item_index != discover_items.length - 1) {
        discover_item_index++;
        slideshow_img.src = 'assets/discover/' + discover_items[discover_item_index];
    }
}