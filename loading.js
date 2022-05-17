/**
 * Function for loading content from HTML file to main element
 */

$("ul").on("click", "li", function() {
    $("li.aside-active").removeClass("aside-active");
    $(this).addClass("aside-active");
    var id = $(this).attr("id");
    $("main").load("./" + id + ".html");
});