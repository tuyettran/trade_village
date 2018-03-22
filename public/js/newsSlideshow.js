$(document).ready(function () {
    $('#myCarousel').carousel({
        interval: 2000
    })
    $('.carousel-inner .item').each(function () {
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));
        
        var next2 = next.next();
        if (!next2.length) {
            next2 = $(this).siblings(':first');
        }
        next2.children(':first-child').clone().appendTo($(this));
         
        var next3 = next2.next();
        if(!next3.length){
            next3 = $(this).siblings(':first');
        }
        next3.children(':first-child').clone().appendTo($(this));
    });
});

//tin khác
jQuery.fn.liScroll = function(settings) {
    settings = jQuery.extend({
        travelocity: 0.03
        }, settings);       
        return this.each(function(){
                var $strip = jQuery(this);
                $strip.addClass("newsticker")
                var stripHeight = 1;
                $strip.find("li").each(function(i){
                    stripHeight += jQuery(this, i).outerHeight(true); // thanks to Michael Haszprunar and Fabien Volpi
                });
                var $mask = $strip.wrap("<div class='mask'></div>");
                var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");                             
                var containerHeight = $strip.parent().parent().height();    //a.k.a. 'mask' width   
                $strip.height(stripHeight);         
                var totalTravel = stripHeight;
                var defTiming = totalTravel/settings.travelocity;   // thanks to Scott Waye     
                function scrollnews(spazio, tempo){
                $strip.animate({top: '-='+ spazio}, tempo, "linear", function(){$strip.css("top", containerHeight); scrollnews(totalTravel, defTiming);});
                }
                scrollnews(totalTravel, defTiming);             
                $strip.hover(function(){
                jQuery(this).stop();
                },
                function(){
                var offset = jQuery(this).offset();
                var residualSpace = offset.top + stripHeight;
                var residualTime = residualSpace/settings.travelocity;
                scrollnews(residualSpace, residualTime);
                });         
        }); 
};

$(function(){
    $("ul#ticker01").liScroll();
});