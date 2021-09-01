$(".remove").click(function(){
    var path = $(this).attr("action");
    var id = $(this).attr("data-id");
    var count = $(this).attr("data-path");
    if (confirm("Are you sure ?")) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: path,
            type: "delete",
            success: function() {
                count--;
                $("#follow-count").text(count);
                $("#user-list-" + id).remove();
                alert("Unfollow success!");
           }
        });
    }
});
