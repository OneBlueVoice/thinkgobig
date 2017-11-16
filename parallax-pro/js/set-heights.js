jQuery(function( $ ){

    function setHeights() {
        $('.category .content .entry').each(function() {
            var $imgh = $('.category-thumbnail img').height();
            $(this).css('min-height', $imgh);
        });
    }
    $(window).on('resize load', setHeights);

});