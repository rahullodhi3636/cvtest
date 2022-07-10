jQuery(document).ready(function( $ ) {

  
  // Back to top button
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').fadeIn('slow');
    } else {
      $('.back-to-top').fadeOut('slow');
    }
  });
  $('.back-to-top').click(function(){
    $('html, body').animate({scrollTop : 0},1500, 'easeInOutExpo');
    return false;
  });





  // Testimonials carousel (uses the Owl Carousel library)
  $(".testimonials-carousel").owlCarousel({
   autoplay: true,
    nav: false,
    dots: true,
    loop: true,
    //navText : ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
    responsive: { 0: { items: 1 }, 768: { items: 1 }, 900: { items: 1 }
    }
  });

   // timeline carousel (uses the Owl Carousel library)
  $(".timeline-carousel").owlCarousel({
   autoplay: true,
    nav: true,
    dots: true,
    loop: true,
    navText : ["<i class='fas fa-long-arrow-alt-left'></i>","<i class='fas fa-long-arrow-alt-right'></i>"],
    responsive: { 0: { items: 1 }, 768: { items: 1 }, 900: { items: 4 }
    }
  });


    /* ---- particles.js config ---- */

particlesJS("particles-js", {
  particles: {
    number: {
      value: 200,
      density: {
        enable: true,
        value_area: 600
      }
    },
    color: {
      value: "#ffffff"
    },
    shape: {
      type: "circle",
      stroke: {
        width: 0,
        color: "#000000"
      },
      polygon: {
        nb_sides: 6
      },
      image: {
        //src: "img/github.svg",
        width: 100,
        height: 100
      }
    },
    opacity: {
      value: 0.5,
      random: false,
      anim: {
        enable: false,
        speed: 1,
        opacity_min: 0.1,
        sync: false
      }
    },
    size: {
      value: 3,
      random: true,
      anim: {
        enable: false,
        speed: 40,
        size_min: 0.1,
        sync: false
      }
    },
    line_linked: {
      enable: true,
      distance:100,
      color: "#ffffff",
      opacity: 0.4,
      width: 1
    },
    move: {
      enable: true,
      speed: 6,
      direction: "none",
      random: false,
      straight: false,
      out_mode: "out",
      bounce: false,
      attract: {
        enable: false,
        rotateX: 600,
        rotateY: 1200
      }
    }
  },
 
  retina_detect: true
});

/* ---- stats.js config ---- */

});



    // Team Slides
    $('.team-slides').owlCarousel({
      loop: true,
      nav: true,
      dots: false,
      autoplayHoverPause: true,
      autoplay: true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
      responsive: {
                0: {
                    items:1,
                },
                768: {
                    items:2,
                },
                1200: {
                    items:3,
        }
            }
    });

    // Testimonial Slides
    $('.testimonial-slides').owlCarousel({
      loop: true,
      nav: false,
      dots: true,
      autoplayHoverPause: true,
      autoplay: true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
      responsive: {
                0: {
                    items:1,
                },
                768: {
                    items:1,
                },
                1200: {
                    items:2,
        }
            }
    });

    // Partner Slides
    $('.partner-slides').owlCarousel({
      loop: true,
      nav: false,
      dots: false,
      autoplayHoverPause: true,
      autoplay: true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
      responsive:{
                0: {
                    items:2,
                },
                768: {
                    items:3,
                },
                1200: {
                    items:6,
        }
            }
        });


// $(document).ready(function(){
// var count_particles, stats, update;
// stats = new Stats();
// stats.setMode(0);
// stats.domElement.style.position = "absolute";
// stats.domElement.style.left = "0px";
// stats.domElement.style.top = "0px";
// document.body.appendChild(stats.domElement);
// count_particles = document.querySelector(".js-count-particles");
// update = function() {
//   stats.begin();
//   stats.end();
//   if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
//     count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
//   }
//   requestAnimationFrame(update);
// };
// requestAnimationFrame(update);
// });

// !function(a) {
//     //"use strict";
//     a(".page-scroll").bind("click", function(b) {
//         var c = a(this);
//         a("html, body").stop().animate({
//             scrollTop: a(c.attr("href")).offset().top - 1
//         }, 1250, "easeInOutExpo"), b.preventDefault();
//     }), a("body").scrollspy({
//         target: ".navbar",
//         offset: 1
//     }), a(".navbar-collapse ul li a").click(function() {
//         a(".navbar-toggle:visible").click();
//     });
// }(jQuery);

$(function() {
  $('.page-scroll').on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 600, 'linear');
  });
});


$(document).ready( function() {   

$('.grid2').isotope({
  itemSelector: '.single-portfolio',
});

// filter items on button click
$('.filter-button-group').on( 'click', 'li', function() {
  var filterValue = $(this).attr('data-filter');
  $('.grid2').isotope({ filter: filterValue });
  $('.filter-button-group li').removeClass('active');
  $(this).addClass('active');
});
    })


$('.gallery').each(function() { 
    $(this).magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
          enabled:true
        }
    });
});

 // Tabs
        (function ($) {
            $('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
            $('.tab ul.tabs li a').on('click', function (g) {
                var tab = $(this).closest('.tab'), 
                index = $(this).closest('li').index();
                tab.find('ul.tabs > li').removeClass('current');
                $(this).closest('li').addClass('current');
                tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
                tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
                g.preventDefault();
            });
        })(jQuery);