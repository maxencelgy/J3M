VANTA.NET({
    el: ".main",
    color: 0xe89111,
    backgroundColor: 0xb133d,
    points: 10
  });

var w, container, carousel, item, radius, itemLength, rY, ticker;
var mouseX = 0;
var mouseY = 0;
var mouseZ = 0;
var addX = 0;

$(document).ready(init)


// Menu BURGER /////////////////////////////////////////////
  const burger = $('#burger');
  const croix = $('#croix');
  const nav = $('nav');
  const navigation = $('.header_btn');


  console.log(burger);
  console.log(croix);
  console.log(navigation);

  burger.on('click',function (){
    navigation.fadeIn();
    nav.css('flex-direciton', 'column');
    burger.css('display', 'none');
    croix.css('display', 'block');
  });

  croix.on('click',function (){
    navigation.fadeOut();
    burger.css('display', 'block');
    croix.css('display', 'none');
  });



function init()
{
  w = $(window);
  container = $( '#contentContainer' );
  carousel = $( '#carouselContainer' );
  item = $( '.carouselItem' );
  itemLength = $( '.carouselItem' ).length;
  rY = 360 / itemLength;
  radius = Math.round( (300) / Math.tan( Math.PI / itemLength ) );
  
  // modif container 3d props
  TweenMax.set(container, {perspective:700})
  TweenMax.set(carousel, {z:-(radius)})
  
  // create carousel item props
  
  for ( var i = 0; i < itemLength; i++ )
  {
    var $item = item.eq(i);
    var $block = $item.find('.carouselItemInner');
    
    //thanks @chrisgannon!        
    TweenMax.set($item, {rotationY:rY * i, z:radius, transformOrigin:"50% 10% " + -radius + "px"});

    animateIn( $item, $block )
  }
  
  // set mouse x and y props and looper ticker
  window.addEventListener( "mousemove", onMouseMove, false );
  ticker = setInterval( looper, 2000/60 );
}

function animateIn( $item, $block )
{
  var $nrX = 360 * getRandomInt(2);
  var $nrY = 0 * getRandomInt(0);

  var $nx = -(2000) + getRandomInt( 4000 )
  var $ny = -(0) + getRandomInt( 0 )
  var $nz = -4000 +  getRandomInt( 4000 )

  var $s = 1.5 + (getRandomInt( 10 ) * .1)
  var $d = 1 - (getRandomInt( 8 ) * .1)

    //Animation début
  TweenMax.set( $item, { autoAlpha:1, delay:$d } )
  TweenMax.set( $block, { z:$nz, rotationY:$nrY, rotationX:$nrX, x:$nx, y:$ny, autoAlpha:0} )
  TweenMax.to( $block, $s, { delay:$d, rotationY:0, rotationX:0, z:0,  ease:Expo.easeInOut} )
  TweenMax.to( $block, $s-.5, { delay:$d, x:0, y:0, autoAlpha:1, ease:Expo.easeInOut} )
}

function onMouseMove(event)
{
  mouseX = -(-(window.innerWidth * .5) + event.pageX) * .0025;
  mouseY = -(-(window.innerHeight * .5) + event.pageY ) * .01;
  // mouseZ = -(radius) - (Math.abs(-(window.innerHeight * .1) + event.pageY ) - 200);
}

// loops and sets the carousel 3d properties
function looper()
{
  addX += mouseX
  TweenMax.to( carousel, 1, { rotationY:addX, rotationX:mouseY, ease:Quint.easeOut } )
  // TweenMax.set(carousel, {z:mouseZ })
}

function getRandomInt( $n )
{
  return Math.floor((Math.random()*$n)+1);
}


//Utilisation de Intersection observer pour changer le style transparent de la barre de
//navigation au scroll
const navReveal = document.querySelector("nav");
const flecheHaut = document.querySelector("#flecheHaut");

let observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if(entry.isIntersecting == true){
            navReveal.style.background = "transparent";
            flecheHaut.style.display = "none";
        }else{
            navReveal.style.background = "#242A2E";
            flecheHaut.style.animation = "opacityAnim 2s";
            flecheHaut.style.display = "block";
        }
    })
});

let idTarget = document.querySelector("#acceuil");
observer.observe(idTarget);

