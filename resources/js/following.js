$("#follow").click(function(){
    var path = $(this).attr("action");
   
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
                $('#follow').toggle();
                $('#unfollow').toggle();
           }
        });
    }
});
