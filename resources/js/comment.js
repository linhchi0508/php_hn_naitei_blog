$(function() {
    Array.from(document.querySelectorAll(".cmt")).forEach( i => {
        i.addEventListener("click", function(e) {
            e.preventDefault();
            var story_id = i.getAttribute("attr-story_id");
            var user_id = i.getAttribute("attr-user_id");

            var str = "#pacmt" + story_id;
            $(i).on("keypress", function(e) {
                if(e.which === 13) {
                    e.preventDefault();
                    var content = $(str).val();
                    $(str).val('');

                    content = $.trim(content);
                    if($.trim(content).length == 0){
                        error_msg = "please type comment";
                        $('#error_status').text(error_msg);
                    }else {
                        error_msg = "";
                        $('#error_status').text(error_msg);
                    }
        
                    if(error_msg != '') {
                        return false;
                    } else {
                        var data = {
                            "content": content,
                            "status": 1,
                            "users_id": user_id,
                            "stories_id": story_id,
                            "parent": null,
                        };
                        $.ajax({
                            type: "POST",
                            url: "/comments",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: data,
                            success: function(response){
                                // handle here to display comment
                                if(response['success'] == "success") {
                                    var new_cmt = 
                                        `<li> 
                                            <div class='comet-avatar'> 
                                                <img class='cmt-image' src='${response['user_img']}' alt=''>
                                            </div>
                                            <div class='we-comment'>
                                                <h5><a href='#' title=''>${response['user_name']}</a></h5>
                                                <p>${response['content']}</p>
                                                <div class='inline-itms' attr-story_id='${response['story_id']}' attr-user_id='${response['user_id']}' attr-id='2'>
                                                    <span>${response['time']}</span>
                                                    <a class='we-reply' title='Reply'><i class='fa fa-reply'></i></a>
                                                </div>
                                            </div>
                                        </li>`;
                                    var position = "#new-cmt" + response['story_id']; 
                                    $(position).before(new_cmt);
                                }
                            },
                        });
                    }
                }
            });
        });
    });
});

$(function() {
    Array.from(document.querySelectorAll(".inline-itms")).forEach( i => {
        i.addEventListener("click", function(e) {
            e.preventDefault();

            var story_id_re = i.getAttribute("attr-story_id");
            var user_id_re = i.getAttribute("attr-user_id");
            var id_re = i.getAttribute("attr-id"); // id cua comment cha

            var str_pos = ".input-cmt" + id_re;

            var str = 
                `<li class='post-comment replied${id_re}'>
                    <div class='comet-avatar'>
                        <img src='asset('bower_components/blog_template/images/resources/nearly1.jpg')' alt=''>
                    </div>
                    <div class='post-comt-box'>
                        <form>
                            <input class='cmt-rep' id='cmt${id_re}' attr-story_id='${story_id_re}' attr-user_id='${user_id_re}' placeholder='Post your comment'>
                        </form>
                    </div>
                </li>`;
            $(str_pos).replaceWith(str);

            var cmt_id = "#cmt" + id_re;
            $(cmt_id).on("keypress", function(e) {
                if(e.which === 13) {
                    e.preventDefault();
                    var content_re = $(cmt_id).val();
                    $(cmt_id).val('');
                    
                    content_re = $.trim(content_re);
                    if($.trim(content_re).length == 0){
                        error_msg = "please type comment";
                        $('#error_status').text(error_msg);
                    }else {
                        error_msg = "";
                        $('#error_status').text(error_msg);
                    }
                    if(error_msg != ''){
                        return false;
                    }else {
                        var data_re = {
                            "content": content_re,
                            "status": 1,
                            "users_id": user_id_re,
                            "stories_id": story_id_re,
                            "parent": id_re,
                        };
                        $.ajax({
                            type: "POST",
                            url: "/comments",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: data_re,
                            success: function(response){
                                if(response['success'] == "success") {
                                    if(response['parent'] != null){
                                        var pos = ".replied" + id_re;
                                        var new_rep = 
                                            `<li class='replied'>
                                                <div class='comet-avatar'>
                                                    <img src='${response['user_img']}' alt=''>
                                                </div>
                                                <div class='we-comment'>
                                                    <h5><a href='#' title=''>${response['user_name']}</a></h5>
                                                    <p>${response['content']}</p>
                                                    <div class='inline-itms'>
                                                        <span>${response['time']}</span>
                                                    </div>
                                                </div>
                                            </li>`;
                                        $(pos).before(new_rep);
                                    }
                                }
                            },
                        });
                    }
                }
            });
        });
    });
});
