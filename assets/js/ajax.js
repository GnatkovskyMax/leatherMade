function numberFilter(a,b,c,d){
    var s=[];
    if(!isNaN(a)&&!isNaN(b)&&!isNaN(c)&&!isNaN(d)){
        a=parseInt(a)
        b=parseInt(b);
        c=parseInt(c);
        d=parseInt(d);
        if(a<b){
            s['price']=true;
        }else{
            s['price']=false;
        }
        if(c<d){
            s['area']=true;
        }else{
            s['area']=false;
        }
        return s;
    }else{
        return s;
    }
}
$(".deleteObject").on('click',function (data) {
    //console.log(data);
    var data = $(this).data('id');
    console.log(data);
    $.ajax({
        url: '/ajax/delete',
        type: 'POST',
        data: {id : data},
        success: function(){
            setTimeout('window.location.reload()', 100);

        }
    });
    return false;

});

$(".editThisObject").on('click',function (e) {
    e.preventDefault();
    var some_text = tinymce.get('description').getContent();
    var some_text_en = tinymce.get('descriptione').getContent();
    $.post("/ajax/editObject",
        {
         id:$('.id').val(),
         category: $('.category').val(),
         material: $('.material').val(),
         material_en: $('.material_en').val(),
         description: some_text,
         description_en:some_text_en,
         price: $('.price').val()
        },
        function(data){

            $(".wrapp-edit").html(data);
        });

    //return false;

});    var files;
var filterData;
// var fp = new FormData();
//     function altP(a){
//         var alt_str='.alt'+a;
//         var alt = $(alt_str).val();
//         fp.append("alt"+a, alt);
//     }
//     function formP(a,b){
//         fp.append("max"+a, b.files[0]);
//         console.log(a+';'+b);
//     }
//     $('html').on('change', function(e){
//         //var formD=e.target;
//         var b = e.target;
//         var a=$(b).attr('data-id');
//         console.log(a);
//         var search_str_alt ='alt'+a;
//         var search_str='add photoP'+a;
//         if(b.className==search_str){
//             console.log(search_str);
//             formP(a, b);
//         }else if(b.className==search_str_alt){
//             console.log(search_str_alt);
//             altP(a);
//         }
// });

// Вешаем функцию на событие
// Получим данные файлов и добавим их в переменную
$('html').on('change', function(e){
    var t= e.target;
    if(t.className == "photoChange") {
        files = t.files;
    }
});
$('body').on('click', function(e){// filterrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr
    var t= e.target;
    if(t.className == "add_category"){
        e.preventDefault();
        var addCategory= new FormData();
        var name = $('.name_new').val();
        var name_en = $('.name_en_new').val();
        console.log('hello');
        addCategory.append('name', name);
        addCategory.append('name_en',name_en);
        //console.log(id);
        $.ajax({
            url: "/ajax/addCategory",
            type: "POST",
            data: addCategory,
            processData: false,
            contentType: false,
            complete: function () {
                alert("complete");
            },
            success: function (json) {
                $(".wrapp-add-category").html(json);
            }

        })
    }
    else if(t.className == "red_category"){
        e.preventDefault();
        var redCategory= new FormData();
        var id = $(t).data('id');
        var name = $('.name'+id).val();
        var name_en = $('.name_en'+id).val();
        console.log('hello');
        redCategory.append('id',id);
        redCategory.append('name', name);
        redCategory.append('name_en',name_en);
        //console.log(id);
        $.ajax({
            url: "/ajax/redCategory",
            type: "POST",
            data: redCategory,
            processData: false,
            contentType: false,
            complete: function () {
                alert("complete");
            },
            success: function (json) {
                $(".wrapp-add-category").html(json);
            }

        })
    }
    else if(t.className == "del_category"){
        e.preventDefault();
        var delCategory= new FormData();
        var id = $(t).data('id');
        delCategory.append('id',id);
        $.ajax({
            url: "/ajax/delCategory",
            type: "POST",
            data: delCategory,
            processData: false,
            contentType: false,
            complete: function () {
                alert("complete");
            },
            success: function (json) {
                $(".wrapp-add-category").html(json);
            }

        })
    }
else if(t.className == "filterbtn"){
    e.preventDefault();
    /////////услуга
    var ids = $('select[name=ids]').val() ;
    /////////тип
    var idt= $('select[name=idt]').val();
    /////////город
    var city= $('select[name=city]').val();
    /////////район
    var district = $('select[name=district]').val();
    var districtStr = '';
    if(district!==null){
        for(var i=0;i<district.length;i++){
            if(district[i]!=='districts'){
                if(i==0){
                    districtStr =district[i];
                }else{
                    districtStr +=','+district[i];
                }
            }else{
                districtStr =district[i];
                break;
            }


        }
    }else{
        districtStr ='districts';
    }
    /////////направление
    var direct = $('select[name=dirid]').val();
    var directStr = '';
    if(direct!==null){
        for(var i=0;i<direct.length;i++){
            if(direct[i]!=='directions'){
                if(i==0){
                    directStr =direct[i];
                }else{
                    directStr +=','+direct[i];
                }
            }else{
                directStr =direct[i];
                break;
            }


        }
    }else{
        directStr ='directions';
    }
    /////////отдельный вход
    var entrance = $('.entranceFilter:checkbox:checked').val();
    if(!entrance){
        entrance=0;
    }
    /////////новострой
    var build = $('.newFilter:checkbox:checked').val();
    if(!build){
        build=0;
    }
    /////////профиль
    var prid='';
    $('.profileFilter:checkbox:checked').each(function(){
        if(prid==''){
            prid=$(this).val();
        }else{
            prid+=','+$(this).val();
        }

    });
    if(prid==''){
        prid='profiles';
    }
//////////комнат
    var room=[];
    var i=0;
        $('.roomFilter:checkbox:checked').each(function(){
           room[i]=$(this).val();
            i++;

        });
    var roomStr ='';
    if(room.length!==0){
        for(var i=0;i<room.length;i++){
            if(room[i]!=='rooms'){
                if(i==0){
                    roomStr =room[i];
                }else{
                    roomStr +=','+room[i];
                }
            }else{
                roomStr =room[i];
                break;
            }


        }
    }else{
        roomStr='rooms';
    }
/////////без коммисии
    var commis = $('.commisFilter:checkbox:checked').val();
    if(!commis){
        commis=0;
    }
///////////сортировка
    var sort = $('select[name=sort]').val() ;
    //////////////////////////rabota c price and area
    var a=$('input[name=from_price]').val();
    var b=$('input[name=to_price]').val();
    var c=$('input[name=from_area]').val();
    var d=$('input[name=to_area]').val();
    if(numberFilter(a,b,c,d)['price']){
        $('input[name=from_price]').css('border', '');
        $('input[name=to_price]').css('border', '');
    }else{
        a=0;
        b=0;
        $('input[name=from_price]').css('border', '1px solid red');
        $('input[name=to_price]').css('border', '1px solid red');
    }
    if(numberFilter(a,b,c,d)['area']){
        $('input[name=from_area]').css('border', '');
        $('input[name=to_area]').css('border', '');
    }else{
        c=0;
        d=0;
        $('input[name=from_area]').css('border', '1px solid red');
        $('input[name=to_area]').css('border', '1px solid red');
    }
    $('#results').text();
    //console.log(districtStr+':'+directStr+':'+roomStr+':'+build+':'+commis+':'+sort+':'+a+':'+b+':'+c+':'+d);
    var data='ids='+ids+'&idt='+idt+'&m=0&'+'city='+city+
        '&district='+districtStr+'&dirid='+directStr+'&entrance='+entrance+'&new='+build+
        '&prid='+prid+'&room='+roomStr+'&sort='+sort+'&commis='+commis+'&from_price='+a+
        '&to_price='+b+'&from_area='+c+'&to_area='+d;
    filterData=data;
    $.ajax({
        type: "GET",
        url: "/ajax/catalog",
        data: data,
        processData: false,
        contentType: false,
        success: function (data) {
            data = $(data);
            $(".inline.wrapper-obj").html($('.inline.wrapper-obj', data).html());
        }

    });
}
});
$('body').on('click', function(e){
   var t= e.target;
    if(t.className == "editPostB") {
        e.preventDefault();
        var editPost = new FormData();
        console.log('hello');
        var title= tinymce.get('basic-t-description').getContent();
        var basic_description= tinymce.get('basic-b-description').getContent();
        var content = tinymce.get('content').getContent();
        var content_en=tinymce.get('content_en').getContent();
        editPost.append('id', $(t).attr('data-post-id'));
        editPost.append('title',title);
        editPost.append('basic_description',basic_description);
        editPost.append('content',content);
        editPost.append('content_en',content_en);
        console.log(id);
        $.ajax({
            url: "/ajax/editPost",
            type: "POST",
            data: editPost,
            processData: false,
            contentType: false,
            complete: function () {
                alert("complete");
            },
            success: function (json) {
                $(".wrapp-edit-post").html(json);
            }

        })
    }
    else if (t.className== "profilebtn") {
        filterData=undefined;
        e.preventDefault();
        var entrance = $('.entrance:checkbox:checked').val();
        if(!entrance){
            entrance=0;
        }
        console.log(build);
        var ids = $(t).attr('data-service');
        var idt=3;
        var prid='';
        $('.profile:checkbox:checked').each(function(){
            if(prid==''){
                prid=$(this).val();
            }else{
                prid+=','+$(this).val();
            }

        });
        $.ajax({
            type: "GET",
            url: "/ajax/catalog",
            data: 'prid='+prid+'&ids='+ids+'&idt='+3+'&entrance='+entrance,
            processData: false,
            contentType: false,
            success: function (data) {
                data = $(data);
                $(".inline.wrapper-obj").html($('.inline.wrapper-obj', data).html());
                ids= '';
                idt= '';
                prid = '';
            }

        // $.get("/ajax/catalog",
        //     {prid: prid,
        //         ids: ids,
        //         idt: 3
        //     }, function(data){
        //         data = $(data);
        //         $(".inline.wrapper-obj").html($('.inline.wrapper-obj', data).html());
           });
    }
    else if (t.className== "directionbtn") {
        filterData=undefined;
        e.preventDefault();
        var ids = $(t).attr('data-service');
        var dirid='';
        $('.direction:checkbox:checked').each(function(){
            if(dirid==''){
                dirid=$(this).val();
            }else{
                dirid+=','+$(this).val();
            }

        });
        $.ajax({
            type: "GET",
            url: "/ajax/catalog",
            data: 'dirid='+dirid+'&ids='+ids+'&idt='+1,
            processData: false,
            contentType: false,
            success: function (data) {
                data = $(data);
                $(".inline.wrapper-obj").html($('.inline.wrapper-obj', data).html());
            }

            // $.get("/ajax/catalog",
            //     {prid: prid,
            //         ids: ids,
            //         idt: 3
            //     }, function(data){
            //         data = $(data);
            //         $(".inline.wrapper-obj").html($('.inline.wrapper-obj', data).html());
        });
    }
    else if (t.className== "roombtn") {
        filterData=undefined;
        e.preventDefault();
        var ids = $(t).attr('data-service');
        var idt= $(t).attr('data-type');
        var build = $('.new:checkbox:checked').val();
        if(!build){
            build=0;
        }
         console.log(build);
        var room='';
        $('.room:checkbox:checked').each(function(){
            if(room==''){
                room=$(this).val();
            }else{
                room+=','+$(this).val();
            }

        });
        var data='room='+room+'&ids='+ids+'&idt='+idt+'&m=0&'+'new='+build;
        console.log(data);
        $.ajax({
            type: "GET",
            url: "/ajax/catalog",
            data: data,
            processData: false,
            contentType: false,
            success: function (data) {
                data = $(data);
                $(".inline.wrapper-obj").html($('.inline.wrapper-obj', data).html());
                ids= '';
                idt= '';
                prid = '';
                room = '';
            }
        });
    }
    else if(t.className=="viewPhotoPost"){
        var data = $(t).data('id');
        $.post("/ajax/viewPhotoPost",
            {id: data},
            function(data){
                $(".wrapp-edit-post").html(data);
            });
    }
    else if(t.className=="editAltPost"){
        e.preventDefault();
        var id =  $(t).attr('data-id');
        var value= $('.altPost').val();
        console.log(value);
        $.post("/ajax/editAltPost",
            {id: id,
             file: value
            },
            function(data){
                $( ".viewPhotoPost" ).trigger( "click" );
            });
    }
    else if(t.className=="delPhotoPost"){
        var data = $(t).attr('data-id');
        var file = $('.file-delPost').attr('src');
        console.log(file);
        $.post("/ajax/delPhotoPost",
            {id: data,
                file: file
            },
            function(data){
                $( ".viewPhotoPost" ).trigger( "click" );
            });
    }
    else if(t.className=="add_PhotoPost") {
            var data = $(t).attr('data-addPhotoPost');
            $.post("/ajax/upPhotoPost",
                {id: data},
                function(data){
                    $(".wrapp-edit-post").html(data);
                });
        }
    else if(t.className=="upPhPo") {
        e.preventDefault();
        console.log(id);
        $('.filePost').change(function(){
            var fd = new FormData();
            var id =$(this).attr('data-post-id');
            var alt = $('.altPost').val();
            console.log(fd);
            fd.append("max", this.files[0]);
            fd.append("id", id);
            fd.append("alt", alt);
            console.log(fd);
            $.ajax({
                url: "/ajax/upPhPo",
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    loader();
                },
                success: function(json){
                    $('.modal-form').remove();
                    $(".wrapp-edit-post").html(json);
                }

            });


        });
        $('.filePost').trigger('change');
    }
    else if(t.className=="addPhoto_Data") {
        e.preventDefault();
        var id =$(t).attr('data-obj-id');
        console.log(id);
        var fp = new FormData();
        $.each( files, function( key, value ){
            fp.append( key, value );
        });
        fp.append("id", id);
        console.log(fp);
        $.ajax({
            url: "/ajax/addP",
            type: "POST",
            data: fp,
            processData: false,
            contentType: false,
            beforeSend: function() {
               loader();
            },
            success: function(json){
                $('.modal-form').remove();
                fp=new FormData;
                $(".wrapp-edit").html(json);
            }

        });








    }
    else if(t.className=="viewPhoto") {

            //console.log(data);
            var data = $(t).data('id');
            $.post("/ajax/viewPhoto",
                {id: data},
                function(data){

                    $(".wrapp-edit").html(data);
                    sortable();
                });
    }
     else if(t.className=="replacePhoto") {///////////////////////////
        var data = new FormData();
         $('.rep_Ph').each(function(e){
             data.append(e, +($('.rep_Ph').eq(e).attr('data-replace')));
         });
        var id = $(t).data('id')
         data.append('id', id);
        $.ajax({
            url: "/ajax/replacePhoto",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            complete: function() {
                alert( "complete" );
            },
            success: function(json){
                $( ".viewPhoto" ).trigger( "click" );
                sortable();
            }

        });
        //
        // $.post("/ajax/replacePhoto",
        //     {id: data},
        //     function(data){
        //
        //         $(".wrapp-edit").html(data);
        //
        //     });
    }
    else if(t.className=="delPhotoT"){
        var data = $(t).attr('data-id');
        var file = $('.file-delT').attr('src');
        console.log(file);
        $.post("/ajax/delPhotoT",
            {idT: data,
             file: file
            },
            function(data){
                $("#img-top").html(data);
            });
    }
    else if(t.className=="delPhotoG"){
        var data = $(t).attr('id');
        var file = $('.file-delG').attr('src');
        console.log(file);
        $.post("/ajax/delPhotoG",
            {idG: data,
                file: file
            },
            function(data){
                $("#img_general").html(data);
            });
    }
    else if(t.className=="delPhoto_Checkbox"){
        var numbers = [];
        var id =  $(t).attr('data-id');
        var numP = $('.delPhoto:checked');

        for(var i=0; numP.length>i; i++) {
            var number= numP.eq(i).attr('id');
             var f = '.file-delP'+number;
            var file = $(f).attr('src');//pyt. k foto
            numbers[i]= [];
            for(var j=0; 3>j; j++) {
                if(j==0) {
                    numbers[i][0]=number;
                }else if(j==1) {
                    numbers[i][1]= file;
                }
            }
            }
        console.log(numbers);
         var s =[];
         for(var i=0; numP.length>=i+1;i++){
             s[i]= '#img'+numbers[i][0];

         }

        var data ='id='+id+'&numbers='+numbers;
        console.log(data);
        // $.ajax({
        //     url: "/ajax/delPhotoP",
        //     type: "POST",
        //     data: data,
        //     processData: false,
        //     contentType: false,
        //     beforeSend: function() {
        //         loader();
        //     },
        //     success: function(json){
        //         $('.modal-form').remove();
        //         $(s[0]).html(json);
        //
        //     }
        //
        // });
        $.post("/ajax/delPhotoP",
            {id: id,
                numbers:numbers
            },
            function(data){
                $( ".viewPhoto" ).trigger( "click" );
            });

    }
    else if(t.className=="editAlt"){
        e.preventDefault();
        var id =  $(t).attr('data-id');
        var numP = $(t).attr('data');//id=fotografii
        var s = '.alt'+numP;
        var p = '.message'+numP;
        var value= $(s).val();
        console.log(value);
        $.post("/ajax/editAltP",
            {id: id,
                numP:numP,
                file: value
            },
            function(data){
                $( ".viewPhoto" ).trigger( "click" );
            });
    }
    else if(t.className=="editAltT"){
        e.preventDefault();
        var id =  $(t).attr('data-id');
        var value= $('.img-T-alt').val();
        console.log(value);
        $.post("/ajax/editAltT",
            {id: id,
                file: value
            },
            function(data){
               $( ".viewPhoto" ).trigger( "click" );
            });
    }
    else if(t.className=="editAltG"){
        e.preventDefault();
        var id =  $(t).attr('data-id');
        var value= $('.img-G-alt').val();
        console.log(value);
        $.post("/ajax/editAltG",
            {id: id,
                file: value
            },
            function(data){
                $( ".viewPhoto" ).trigger( "click" );
            });
    }
    /////////////////////obnovlenie dobavlenie foto
    else if(t.className=="upPhotoT") {
        var data = $(t).attr('data-updatePhotoT');
        $.post("/ajax/upPhotoT",
            {id: data},
            function(data){
                $(".wrapp-edit").html(data);
            });
    }
    else if(t.className=="upPhotoG") {
        var data = $(t).attr('data-updatePhotoG');
        $.post("/ajax/upPhotoG",
            {id: data},
            function(data){
                $(".wrapp-edit").html(data);
            });
    }
    else if(t.className=="add_Photo") {
        var data = $(t).attr('data-addPhotoP');
        $.post("/ajax/addPhotoP",
            {id: data},
            function(data){
                $(".wrapp-edit").html(data);
            });
    }
 // else if(t.className=="file") {
 //
 //        $(t).change(function(){
 //            files = this.files;
 //            console.log(files);
 //        });
    //
    //    file = $(t).change(function(){
    //         var files = this.files;
    //
    //
    //         console.log(files);
    //         return files[0]['name'];
    //     });
    //
    //
    // }
    else if(t.className=="upT") {
        e.preventDefault();
        $('.fileT').change(function(){
            var fd = new FormData();
            var id =$(this).attr('data-obj-id');
           var altT = $('.altT').val();
            fd.append("max", this.files[0]);
            fd.append("id", id);
            fd.append("altT", altT);
            console.log(fd);
            $.ajax({
                url: "/ajax/upT",
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                complete: function() {
                    alert( "complete" );
                },
                success: function(json){
                                    $(".wrapp-edit").html(json);
                                }

            });


        });
        $('.fileT').trigger('change');
    }
    else if(t.className=="upG") {
        e.preventDefault();
        $('.fileG').change(function(){
            var fd = new FormData();
            var id =$(this).attr('data-obj-id');
            var altG = $('.altG').val();
            fd.append("max", this.files[0]);
            fd.append("id", id);
            fd.append("altG", altG);
            console.log(fd);
            $.ajax({
                url: "/ajax/upG",
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                complete: function() {
                    alert( "complete" );
                },
                success: function(json){
                    $(".wrapp-edit").html(json);
                }

            });


        });
        $('.fileG').trigger('change');
    }
    else if(t.className=="delPost") {
        var dp = new FormData();
        var i =$(t).attr('data-del-post');
        i =+i;
        dp.append("id", i);
        console.log(i);
        $.ajax({
            url: "/ajax/delPost",
            type: "POST",
            data: dp,
            processData: false,
            contentType: false,
            complete: function() {
                alert( "complete" );
            },
            success: function(json){
                $(".sectionPost"+i).html(json);
            }

        });
    }

});

