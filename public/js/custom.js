$(document).ready(function(){"use strict";var e=$(".header"),n=!1,t=$(".menu"),o=$(".hamburger"),r=new ScrollMagic.Controller;function a(){$(window).scrollTop()>100?e.addClass("scrolled"):e.removeClass("scrolled")}function i(){t.addClass("active"),n=!0}function c(){t.removeClass("active"),n=!1}a(),$(window).on("resize",function(){a()}),$(document).on("scroll",function(){a()}),function(){if($(".menu").length){$(".menu");$(".hamburger").length&&o.on("click",function(){n?c():(i(),$(document).one("click",function e(n){$(n.target).hasClass("menu_mm")?$(document).one("click",e):c()}))})}}(),$(".search_button").length&&$(".search_button").on("click",function(){$(".header_search_container").length&&$(".header_search_container").toggleClass("active")}),function(){if($(".home_slider").length){var e=$(".home_slider");if(e.owlCarousel({items:1,loop:!0,autoplay:!0,nav:!1,dots:!1,smartSpeed:1200}),$(".home_slider_prev").length){var n=$(".home_slider_prev");n.on("click",function(){e.trigger("prev.owl.carousel")})}if($(".home_slider_next").length){var t=$(".home_slider_next");t.on("click",function(){e.trigger("next.owl.carousel")})}}}(),function(){if($(".milestone_counter").length){var e=$(".milestone_counter");e.each(function(e){var n=$(this),t=n.data("end-value"),o=n.text(),a="",i="";n.attr("data-sign-before")&&(a=n.attr("data-sign-before")),n.attr("data-sign-after")&&(i=n.attr("data-sign-after"));new ScrollMagic.Scene({triggerElement:this,triggerHook:"onEnter",reverse:!1}).on("start",function(){var n={value:o};TweenMax.to(n,4,{value:t,roundProps:"value",ease:Circ.easeOut,onUpdate:function(){document.getElementsByClassName("milestone_counter")[e].innerHTML=a+n.value+i}})}).addTo(r)})}}()});