// Gets fontSize of documentElement
var fontSize = $("html").css("fontSize");
fontSize = parseInt(fontSize);

/*$(function () {
    // Changes links if URL contains "sluzby"
    if (window.location.href.indexOf("sluzby") > -1) {
        $("header a").each(function () {
            var href = $(this).prop("href");
            if (href.indexOf("sluzby/")) {
                this.href = this.href.replace("sluzby/", "");
            }
        });
    };
});*/

let menuOpen = false;

// Mobile menu
$(document).on("click", "#menu-btn", function () {
    if (!menuOpen) {
        $("#navbar ,#menu-btn ,#nav-mobile ,#container ,#vypocet_ceny-mobile").addClass("open");
        $("body").css({
            "overflow-y": "hidden"
        })
        menuOpen = true;
    } else {
        $("#navbar ,#menu-btn ,#nav-mobile ,#container ,#vypocet_ceny-mobile").removeClass("open");
        $("body").css({
            "overflow-y": "scroll"
        })
        menuOpen = false;
    };
});

// Close mobile menu if width is more than 36em
$(window).resize(function () {
    if ($(window).width() > 36 * fontSize) {
        $("#navbar ,#menu-btn ,#nav-mobile ,#container ,#vypocet_ceny-mobile").removeClass("open");
        menuOpen = false;
    }
})

// Close menu if clicked elsewhere
$(document).on("click", "#container", function () {
    if (menuOpen) {
        $("#navbar ,#menu-btn ,#nav-mobile ,#container ,#vypocet_ceny-mobile").removeClass("open");
        menuOpen = false;
    }
});

// Moves arrow when dropdown is opened
let arrowOpen = false;
$(document).on("click", ".nav-dropdown__btn, .nav-dropdown__label", function () {
    if (!arrowOpen) {
        $(this).addClass("open");
        $(this).siblings(".nav-dropdown__label").addClass("open");
        $(this).siblings(".nav-dropdown__btn").addClass("open");
        arrowOpen = true;
    } else {
        $(this).removeClass("open");
        $(this).siblings(".nav-dropdown__label").removeClass("open");
        $(this).siblings(".nav-dropdown__btn").removeClass("open");
        arrowOpen = false;
    }
});