$(".remove").click(function(){
    var path = $(this).attr("action");
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
                $("#user-list").remove();
           }
        });
    }
});
