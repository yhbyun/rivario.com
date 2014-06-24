var rivario = rivario || {};

rivario.initHeadroom = function() {
    var myElement = document.querySelector("#gnb");
    // construct an instance of Headroom, passing the element
    var headroom  = new Headroom(myElement,
        {
            tolerance: 5,
            offset : 205,
            classes: {
                initial: "animated",
                pinned: "slideDown",
                unpinned: "slideUp"
            }
        }
    );
    // initialise
    headroom.init();
};

rivario.csrf = function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });
};

rivario.animateSite = function() {
    $('.thumb').load(function() {
        $(this).closest('.site').velocity("transition.flipXIn", { stagger: 70 });
    });

    var siteHeader = $('.site-header');
    siteHeader.velocity("fadeIn", { duration: 500 });

    setTimeout(function () {
        $('.site').addClass('ih-item square effect6 from_top_and_bottom');
        $('.site').show();
        $('.site .info').show();
    }, 1200);

};

jQuery(function ($) {
    rivario.initHeadroom();
    rivario.csrf();
    rivario.animateSite();
});


