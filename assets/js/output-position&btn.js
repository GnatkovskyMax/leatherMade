$('body').on('click',function(e){
    var object = e.target;
    var f = object.className;
    if(f.indexOf('post')!==-1){
        var pageData= new FormData();
        var page= +($(object).text());
        pageData.append('page_post',page);
        $.ajax({
            url: "/ajax/nextPageNews",
            type: "POST",
            data: pageData,
            processData: false,
            contentType: false,
            success: function (json) {
                $(".wrapp-news").html(json);
                scroll_to_news();
            }

        })

    }
else if(f.indexOf('load')!==-1){
        var pageData= new FormData();
        var page= +($(object).text());
        pageData.append('page',page);
        //console.log(id);
        $.ajax({
            url: "/ajax/nextPage",
            type: "POST",
            data: pageData,
            processData: false,
            contentType: false,
            success: function (json) {
                 $(".wrapp-products").html(json);
                scroll_to_catalog();
            }

        })

    }
    else if(f.indexOf('up')!==-1) {
        $('html, body').animate({scrollTop: 0}, 800);
    }
    else if(f.indexOf('btn-collage')!==-1) {
        scroll_to_catalog();
    }

});
