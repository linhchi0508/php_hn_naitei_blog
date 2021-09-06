$(".story-delete").click(function(){
    var path = $(this).attr("data-path");
    var id = $(this).attr("data-id");
    if (confirm("Are you sure delete story?")) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: path,
            type: "delete",
            success: function() {
                $("#list-story-" + id).remove();
           }
        });
    }
});
