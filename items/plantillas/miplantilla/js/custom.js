//** Owl Carousel  Configuration */

$(document).ready(function(){
    $('.js-carousel').owlCarousel({
        loop:true,
        autoplay:true,
        stagePadding:7,
        margin:20,
        animateOut:'fadeOut',
        animateIn:'fadeIn',
        nav:false,
        autoPlayHoverPause:false,
        items:3,
        navText:["<span class='fas fa-arrow-right></span>","<span class='fas fa-arrow-left'></span>"],
        responsive:{
            0:{
                items:1.2,
                nav:false
            },
            600:{
                items:2,
                loop:true
            },
            1000:{
                items:3,
                loop:true
            }
        }
    });
});




    //!Slider Producto

        var main = document.getElementById('main-img');
        var small = document.getElementsByClassName('small-img');
    
        small[0].onclick = function(){
            main.src = small[0].src;
        }
        small[1].onclick = function(){
            main.src = small[1].src;
        }
    
        small[2].onclick = function(){
            main.src = small[2].src;
        }
    
        small[3].onclick = function(){
            main.src = small[3].src;
        }


        
        //!Carrito de compras

