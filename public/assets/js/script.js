$(document).ready(function() {
    $("body").on("click", ".bx-hide", function() {
        $(this).removeClass("bx-hide").addClass("bx-show");
        $(this).parents("div").children("input[type=text]").attr("type", "password");
    });

    $("body").on("click", ".bx-show", function() {
        $(this).removeClass("bx-show").addClass("bx-hide");
        $(this).parents("div").children("input[type=password]").attr("type", "text");
    });
});
