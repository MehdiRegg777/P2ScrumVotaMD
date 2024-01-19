$(document).ready(function () {

    $(".password-label, .password-input, .confirm-password-button, .confirm-password-label, .confirm-password-input, .confirm-confirm-password-button, .email-lebel, .email-input, .confirm-email, .phone-level, .phone-input, .confirm-phone, .country-lebel, .country-input, .confirm-country, .city-lebel, .city-input, .confirm-city , .postal-code-lebel, .postal-code-input").hide();

    $(".confirm-username").click(function () {
        $(".password-label, .password-input, .confirm-password-button").show();
    });

    $(".confirm-password-button").click(function () {
        $(".confirm-password-label, .confirm-password-input, .confirm-confirm-password-button").show();
    });

    $(".confirm-confirm-password-button").click(function () {
        $(".email-lebel, .email-input, .confirm-email").show();
    });

    $(".confirm-email").click(function () {
        $(".phone-level, .phone-input, .confirm-phone").show();
    });

    $(".confirm-phone").click(function () {
        $(".country-lebel, .country-input, .confirm-country").show();
    });

    $(".confirm-country").click(function () {
       $(".city-lebel, .city-input, .confirm-city").show();
    }); 

    $(".confirm-city").click(function () {
        $(".postal-code-lebel, .postal-code-input").show();
     }); 
});