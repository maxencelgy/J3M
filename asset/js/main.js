console.log("cc");

VANTA.NET({
    el: ".main",
    color: 0x5b30e8,
    backgroundColor: 0xb133d,
    points: 5,
    points: 10

  });


//   VANTA.NET({
//     el: "#inscription",
//     color: 0xf50000,
//     backgroundColor: 0xc3c3c3,
//     points: 10
//   });

// $(document).ready(function (){
//     const submited = $('#submitted');
//     const err = $('.error')
//     console.log(err);
    
//     submited.on('click',function(e){
//         e.preventDefault();
//         // main.css('display', 'none');
//         $('body').css({'background': '#131313'})
//         console.log("le bouton est bien cliqué");

   
//         })
     
//     })

const navReveal = document.querySelector("nav");

let navOptions = {
    root: null,
    rootMargin: '0px',
    threshold: .5
};

let observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        console.log(entry.isIntersecting)
        if(entry.isIntersecting == true){
            navReveal.style.background = "rgba(5,11,79,.9)";
        }
    })
});

let classTarget = document.querySelector(".right");
observer.observe(classTarget);



    
