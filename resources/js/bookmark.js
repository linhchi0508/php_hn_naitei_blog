$(".bookmark").click(function(){
    var path = $(this).attr("action");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: path,
        type: "post",
        success: function(res) {
            if(res.bool == true){
                alert("successfully bookmarked!");
            } else {
                alert("warning! bookmarked!");
            }
        }
    });    
});
