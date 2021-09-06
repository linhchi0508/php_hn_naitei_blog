$(function() {
    Array.from(document.querySelectorAll(".hide-cmt")).forEach( i => {
        $(i).on("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            var hide_cmt_id = i.getAttribute("attr-id_cmt");
            var origin_url = window.location.origin;

            if (confirm("Are you sure?")) {
                $.ajax({
                    type: "DELETE",
                    url: origin_url + "/hide-comment/" + hide_cmt_id,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(response){
                        if(response['message'] == "success") {
                            location.reload();
                        }
                    },
                });
            }
        });
    });
});

$(function() {
    Array.from(document.querySelectorAll(".hide-story")).forEach( i => {
        $(i).on("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            var hide_story_id = i.getAttribute("attr-story_id");
            var url = window.location.origin;

            if (confirm("Are you sure?")) {
                $.ajax({
                    type: "DELETE",
                    url: url + "/hide-story/" + hide_story_id,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(response){
                        if(response['message'] == "success") {
                            location.reload();
                        }
                    },
                });
            }
        });
    });
});
