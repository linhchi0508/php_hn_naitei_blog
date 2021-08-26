$("#follow").click(function(){
    var path = $(this).attr("action");
    var id =  $(this).attr("data-id");
    if (confirm("Are you sure ?")) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: path,
            type: "post",
            success: function() {
                var user = '<button type="submit" action="{{route(\'follow.destroy\','+ id +')}}" class="btn btn-danger remove">Unfollow</button>';
                    $("#follow").replaceWith(user );
           }
        });
    }
});
