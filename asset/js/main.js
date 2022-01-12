console.log("cc");

VANTA.NET({
    el: ".main",
    color: 0x5b30e8,
    backgroundColor: 0xb133d,
    points: 10
  });


// Variable carousel
var w, container, carousel, item, radius, itemLength, rY, ticker;
var mouseX = 0;
var mouseY = 0;
var mouseZ = 0;
var addX = 0;

$(document).ready( init )

function init()
{
  w = $(window);
  container = $( '#contentContainer' );
  carousel = $( '#carouselContainer' );
  item = $( '.carouselItem' );
  itemLength = $( '.carouselItem' ).length;
  rY = 360 / itemLength;
  radius = Math.round( (250) / Math.tan( Math.PI / itemLength ) );
  
  // modif container 3d props
  TweenMax.set(container, {perspective:700})
  TweenMax.set(carousel, {z:-(radius)})
  
  // create carousel item props
  
  for ( var i = 0; i < itemLength; i++ )
  {
    var $item = item.eq(i);
    var $block = $item.find('.carouselItemInner');
    
    //thanks @chrisgannon!        
    TweenMax.set($item, {rotationY:rY * i, z:radius, transformOrigin:"50% 50% " + -radius + "px"});

    animateIn( $item, $block )
  }
  
  // set mouse x and y props and looper ticker
  window.addEventListener( "mousemove", onMouseMove, false );
  ticker = setInterval( looper, 1000/60 );
}

function animateIn( $item, $block )
{
  var $nrX = 360 * getRandomInt(2);
  var $nrY = 360 * getRandomInt(2);

  var $nx = -(2000) + getRandomInt( 4000 )
  var $ny = -(2000) + getRandomInt( 4000 )
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
  mouseZ = -(radius) - (Math.abs(-(window.innerHeight * .1) + event.pageY ) - 200);
}

// loops and sets the carousel 3d properties
function looper()
{
  addX += mouseX
  TweenMax.to( carousel, 1, { rotationY:addX, rotationX:mouseY, ease:Quint.easeOut } )
  TweenMax.set(carousel, {z:mouseZ })
}

function getRandomInt( $n )
{
  return Math.floor((Math.random()*$n)+1);
}


//Utilisation de Intersection observer pour changer le style transparent de la barre de
//navigation au scroll
const navReveal = document.querySelector("nav");

let navOptions = {
    root: null,
    rootMargin: '0px',
    threshold: .5
};

let observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if(entry.isIntersecting == true){
            navReveal.style.background = "transparent";
        }else{
            navReveal.style.background = "#242A2E";
        }
    })
});

let idTarget = document.querySelector("#acceuil");
observer.observe(idTarget);

//Appartition du carrousel


const carrouselReveal = document.getElementById("contentContainer");

let carrouselOptions = {
    root: document.querySelector("#infos"),
    rootMargin: '0px',
    threshold: 0.25   
};

let bobserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if(entry.isIntersecting == true){
            carrouselReveal.style.display = "none";
        }else{
            carrouselReveal.style.display = "block";
        }
    })
});

let idTarget2 = document.querySelector("#infos");
bobserver.observe(idTarget);

