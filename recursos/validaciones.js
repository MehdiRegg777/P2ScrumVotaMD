$(document).ready(function () {

    $(".password-label, .password-input, .confirm-password-button, .confirm-password-label, .confirm-password-input, .confirm-confirm-password-button, .email-lebel, .email-input, .confirm-email, .phone-level, .phone-input, .confirm-phone, .country-lebel, .country-input, .confirm-country, .city-lebel, .city-input, .confirm-city , .postal-code-lebel, .postal-code-input").hide();

    $(".confirm-username").click(function () {
        $(".password-label, .password-input, .confirm-password-button").show();
        scrollTo(".password-label");
    });

    $(".confirm-password-button").click(function () {
        $(".confirm-password-label, .confirm-password-input, .confirm-confirm-password-button").show();
        scrollTo(".confirm-password-label");
    });

    $(".confirm-confirm-password-button").click(function () {
        $(".email-lebel, .email-input, .confirm-email").show();
        scrollTo(".email-lebel");
    });

    $(".confirm-email").click(function () {
        $(".phone-level, .phone-input, .confirm-phone").show();
        scrollTo(".phone-level");
    });

    $(".confirm-phone").click(function () {
        $(".country-lebel, .country-input, .confirm-country").show();
        scrollTo(".country-lebel");
    });

    $(".confirm-country").click(function () {
       $(".city-lebel, .city-input, .confirm-city").show();
       scrollTo(".city-lebel");
    }); 

    $(".confirm-city").click(function () {
        $(".postal-code-lebel, .postal-code-input").show();
        scrollTo(".postal-code-lebel");
    });

    function scrollTo(element) {
        $('html, body').animate({
            scrollTop: $(element).offset().top
        }, 1200); 
    }
});
