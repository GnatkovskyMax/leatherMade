// var height= $('.basket-img').height();
// $('.oneProductBasket div').height(height).css('line-height', height+'px');
$(window).on('resize load', function(){
    if($('.dataBasket')!=='undefined'){
        var height= $('.basket-img').height();
        $('.oneProductBasket div').height(height).css('line-height', height+'px');
        var wind_h= $(window).height()*0.7;
        $('.dataBasket').css('maxHeight', wind_h+'px');
        // $('.for_basket_lineHeight').css('line-height', wind_h+'px');
    }
});
function scroll_to_catalog(){
    var scroll= $('.catalog').offset().top;
    $('html, body').animate({ scrollTop: scroll }, 800);
}
function scroll_to_news(){
    var scroll= $('.wrapp-news').offset().top;
    $('html, body').animate({ scrollTop: scroll },800);
}
function allSum(){
    var allSum=0;
    $('.oneProductBasket').each(function(e){

        var summSingle=$('.oneProductBasket .amount').eq(e).val()*(+$('.oneProductBasket>.basket-price').eq(e).attr('data-price'));
       // console.log(summSingle);
        $('.oneProductBasket>.basket-price').eq(e).text(summSingle);
        allSum+=summSingle;
        $("input[name='all-sum']").val(allSum);

    });
    $('.all-sum').text('Всего: '+allSum);
}
function delProductFromBasket(el){
    $(el).parent().remove();
    allSum();
}
function delModalBasket(el){
    $(el).next().text('');
    $('.forBasket').hide();
}
$('body').on('click', function(e){
   var t=  e.target;
   var f = t.className;
    var c =t.parentNode;
    var p =c.className;
    //console.log(p.indexOf('oneProductBasket'));
    if(f.indexOf('deleteProduct')!==-1){
        delProductFromBasket(t);
        var data= new FormData();
            data.append('id' ,$(t).data('id'));
        $.ajax({
            url: "/ajax/deleteProductFromBasket",
            type: "POST",
            data: data ,
            processData: false,
            contentType: false,
            success: function (json) {
                 data='';
              //   console.log(json);
                $(".deleteProduc[data-id="+id+"]").removeClass('deleteProduc').addClass('addToBasket');

                if(json!=''){
                    $(".dataBasket").html(json);
                };

            }

        })
    }
    if(f.indexOf('oneProductBasket')!==-1 ||f.indexOf('basket-img')!==-1||f.indexOf('basket-price')!==-1){
        var data= new FormData();
        data.append('id' ,$(t).data('id'));
        $.ajax({
            url: "/ajax/singleProduct",
            type: "POST",
            data: data ,
            processData: false,
            contentType: false,
            success: function (json) {
                data='';
                $('.deleteBasket').trigger('click');
                $('.wrapp-view-for').html(json);
                $('.catalog-img').slick({
                    dots:true,
                    slidesToShow:1,
                    autoplay:true,
                    autoSpeed:100,
                    arrows:false,
                    speed:200,
                    ltr:true
                }); $('body').animate({ scrollTop: 0});

            }

        });
    }
    else if(f.indexOf('deleteProduc')!==-1){
        var id=$(t).data('id');
        var data= new FormData();
        data.append('id' ,$(t).data('id'));
        $.ajax({
            url: "/ajax/deleteProductFromBasket",
            type: "POST",
            data: data ,
            processData: false,
            contentType: false,
            success: function (json) {

                data='';
              //  console.log(json);
                $(".deleteProduc[data-id="+id+"]").removeClass('deleteProduc').addClass('addToBasket');
                var count=+($('.basket').text())-1;
                $('.basket').text(count);
            }

        })
    }
    else if(f.indexOf('deleteBasket')!==-1){
       // e.stopPropagation();
        delModalBasket(t);

    }
    else if(f.indexOf('basket')!==-1){
        var data='hello';
        $.ajax({
            url: "/ajax/basket",
            type: "POST",
            data: data ,
            processData: false,
            contentType: false,
            success: function (json) { var height= $('.basket-img').height();
                $('.basket-material, input').css('height',height+"px");
                $(".dataBasket").html(json);
                $('.forBasket').show();
                allSum();
                $(window).trigger('load');


            }

        })
    }
    else if(f.indexOf('amount')!==-1) {
           allSum();
    }
    else if(f.indexOf('name-category')!==-1){
        var data= new FormData();
       // console.log('hello');
        data.append('cat_id' ,$(t).data('id'));
        data.append('page' ,1);
        $.ajax({
            url: "/ajax/nextPage",
            type: "POST",
            data: data ,
            processData: false,
            contentType: false,
            success: function (json) {
                $(".wrapp-products").html(json);
                scroll_to_catalog();
                $('.name-category').removeClass('cat_active');
                $(t).addClass('cat_active');
                $('.wrapp-menu').removeClass('active');

            }

        })
    }
    else if(f.indexOf('addToBasket')!==-1){
        $(window).trigger('load');
        var id=$(t).data('id');
        var data= new FormData();
        data.append('id' ,$(t).data('id'));
        $.ajax({
            url: "/ajax/addToBasket",
            type: "POST",
            data: data ,
            processData: false,
            contentType: false,
            success: function (json) {
                data='';
                 $(t).removeClass('addToBasket').addClass('deleteProduc');
                if($('button').is(".addToBasket[data-id="+id+"]")){
                    $(".addToBasket[data-id="+id+"]").removeClass('addToBasket').addClass('deleteProduc');
                }
            }



        })
        $('.basket').text(+($('.basket').text())+1);
    }
        // menu menu menu menu menu menu menu menu menu menu menu menu menu menu menu menu menu menu
    else if(f.indexOf('icon-menu')!==-1||f.indexOf('icon-block')!==-1){
        $('.wrapp-menu').addClass('active');
    }
    //single-product single-product single-product single-product single-product single-product
    else if(f.indexOf('single-product')!==-1||p.indexOf('single-product')!==-1||p.indexOf('wrapp-img')!==-1){

        var data= new FormData();
        data.append('id' ,$(t).data('id'));
        $.ajax({
            url: "/ajax/singleProduct",
            type: "POST",
            data: data ,
            processData: false,
            contentType: false,
            success: function (json) {
                data='';
                $('.wrapp-view-for').html(json);
                $('.catalog-im').slick({
                    dots: true,
                    autoplay: true,
                    infinite: true,
                    speed: 350,
                    fade: true,
                    cssEase: 'linear',
                    arrows: false,
                    slidesToShow: 1,
                    //количество слайдов, которые выводятся на экране
                    slidesToScroll: 1
                }); $('body').animate({ scrollTop: 0});
            }

        })
    }
    else if(f.indexOf('deleteIcon')!==-1){
        $('.wrapp-view-for').html('');
    }
    //lang lang lang lang lang lang lang lang lang lang lang lang lang lang lang lang lang
    else if(f.indexOf('lang')!==-1){

        var data= new FormData();
        data.append('lang' ,$(t).text());
        $.ajax({
            url: "/ajax/langLoad",
            type: "POST",
            data: data ,
            processData: false,
            contentType: false,
            success: function (json) {
                data='';
                $('body').html(json);
                $('.header-slider').slick({
                    dots: true,
                    autoplay: true,
                    infinite: true,
                    speed: 350,
                    fade: true,
                    cssEase: 'linear',
                    arrows: false,
                    slidesToShow: 1,
                    //количество слайдов, которые выводятся на экране
                    slidesToScroll: 1
                });
            }

        })

    }
    else if(f.indexOf('field')!==-1){
    $('.field').removeClass('active');
    $(t).addClass('active');
    $(t).on('blur', function(){$('.field').removeClass('active'); });
}
    else if(f.indexOf('post-check')!==-1) {
        if ($(t).val() == 'post') {
            if (!$('.for-post').is('.for-post-active')) {
                $('.for-post').addClass('for-post-active');
            }
        }else{
            $('.for-post').removeClass('for-post-active');
            var childrenFp=$('.for-post').children();
            childrenFp.val('');
            $("input[name='service-delivery']:checked").removeAttr("checked");


        }
    }
    else if(f.indexOf('checkout')!==-1) {
        e.preventDefault();
        var data= new FormData();
        data.append('serialize' ,$('#basketForm').serialize());
        $.ajax({
            url: "/ajax/sendMail",
            type: "POST",
            data: data ,
            processData: false,
            contentType: false,
            success: function (json) {
                $(".dataBasket").html(json);
                data='';
            }

        })
    }
    else if(f.indexOf('clear-b')!==-1) {
        var data= new FormData();
        $.ajax({
            url: "/ajax/clearBasket",
            type: "POST",
            data: data ,
            processData: false,
            contentType: false,
            success: function (json) {
                data='';
                console.log('hello');
                $(".deleteProduc").removeClass('deleteProduc').addClass('addToBasket');
                $('.basket').text(0);
                delModalBasket(".deleteBasket");
            }

        })

    }
});
