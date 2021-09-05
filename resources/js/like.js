$(".likes").click(function(){
    var path = $(this).attr("data-path");
    var  id = $(this).attr("action");
    var  prevCount = $(this).attr("data-count");
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
                $("#like-" + id).get(0).style.color = "red";
                prevCount++;
                $(".like-count-" + id).text(prevCount);
                alert("successfully liked!");
            } else {
                alert("warning, liked!");
            }
        },
        error:function(){
            alert("warning");
        }  
    });
});
