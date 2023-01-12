$('.slider .owl-carousel').owlCarousel({
    loop: true,
    margin: 4,

    autoplay: true,
    autoplaySpeed: 1000,
    dotsSpeed: 1000,
    nav: true,
    navSpeed: 1000,
    // center: true,
    // autoWidth: false,

    responsiveClass: true,
    responsive: {
        320: {
            items: 1
        },
        480: {
            items: 1
        },
        640: {
            items: 1
        }, 
        736: {
            items: 2
        },
        768: {
            items: 2
        },
        1024: {
            items: 2
        },
        1280: {
            items: 3
        }

    }

})
$('.donors .owl-carousel').owlCarousel({
    loop: true,
    margin: 40,

    autoplay: true,
    autoplaySpeed: 1500,
    dotsSpeed: 1000,
    nav: true,
    navSpeed: 1000,
    // center: true,
    // autoWidth: false,

    responsiveClass: true,
    responsive: {
        320: {
            items: 1
        },
        480: {
            items: 1
        },
        640: {
            items: 2
        },
        768: {
            items: 3
        },
        1024: {
            items: 4
        }

    }

})

// ==============================================================

function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}