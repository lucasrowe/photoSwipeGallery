// Code from https://webdesign.tutsplus.com/tutorials/the-perfect-lightbox-using-photoswipe-with-jquery--cms-23587

$('.imageGallery').each( function() {
    var $pic = $(this),
        getItems = function() {
            var items = [];
            // Parse out our data attributes about each photo
            $pic.find('a').each(function() {
                var $href = $(this).attr('href'),
                    $size = $(this).data('size').split('x'),
                    $width = $size[0],
                    $height = $size[1];
                var item = {
                    src : $href,
                    w : $width,
                    h : $height
                }
                items.push(item);
            });
            return items;
        }

    var items = getItems();

    var $pswp = $('.pswp')[0];
    $pic.on('click', '.thumbnail', function(event) {
        event.preventDefault();

        var $index = $(this).index();
        var options = {
            index: $index,
            bgOpacity: 0.7,
            showHideOpacity: true
        }

        // Initialize PhotoSwipe
        var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
        lightBox.init();
    });
});

// Execute justifiedGallery
$('.imageGallery').justifiedGallery({
    rowHeight : 120,
    lastRow : 'nojustify',
    margins : 3
});
