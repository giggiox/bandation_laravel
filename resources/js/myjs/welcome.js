$('.slick-carousel').slick({
    slidesToShow: 3,

    centerMode: true,

    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    responsive: [
        {
            breakpoint: 1500,
            settings: {
                arrows: true,
                centerMode: false,
                centerPadding: '40px',
                slidesToShow: 3
            }
        },
        {
            breakpoint: 1000,
            settings: {
                arrows: true,
                centerMode: false,
                centerPadding: '40px',
                slidesToShow: 2
            }
        },

        {
            breakpoint: 480,
            settings: {
                arrows: true,
                centerMode: false,
                centerPadding: '40px',
                slidesToShow: 1
            }
        }

    ]
});
