$(".following").click(function(){
    var path = $(this).attr("action");
    var id = $(this).attr("data-id");

    if (confirm("Are you sure Follow?")) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: path,
            type: "post",
            success: function() {
                $("#user-list-" + id).remove();
                alert("Follow success!");
           }
        });
    }
});
