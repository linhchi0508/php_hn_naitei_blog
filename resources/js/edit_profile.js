$(function() {
    $(".input-img").on("change", function(e) {
        var url = URL.createObjectURL(e.target.files[0]);
        $("#img-pre").replaceWith("<img id='img-pre' class='user-img-change-profile' src='" + url + "' alt=''>");

    });
});
