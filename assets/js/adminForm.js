/**
 * Created by Max on 21.02.2017.
 */
$('.addFile').on('click', function(){
   var file = '<label><input type="file" name="image" class="file"><input type="radio" name="general" value="0"><input type="text" name="alt" placeholder="Введите Альт-атрибут для картинки"></label>';
    $( file ).insertAfter( $(this).prev() );
    for(var i=0;$('.file').length>i;i++){
        console.log($('.file').eq(i).attr('name','image'+i).next().attr('value', i).next().attr('name','alt'+i));
    }

});
$('body').on('click', function (e) {
    var z = e.target;
    if(z.className=='addFileP'){
        var file = '<label><input type="file" name="image" class="add">' +
            '<input type="text" name="alt" placeholder="Введите Альт-атрибут для картинки"></label>';
        $( file ).insertAfter( $(z).prev() );
        for(var i=0;$('.add').length>i;i++){
            $('.add').eq(i).attr('name','image'+i).attr('data-id', i).next().attr('name','alt'+i);
            $('.add').eq(i).addClass('photoP'+i).next().addClass('alt'+i).attr('data-id', i);
        }
    }
});

$('.for_top_img').change( function(){

    if(!$('label').is('.img_top')){
        alert('hhh'); $('<label class="img_top">Добавить фотографию для слайдера<input type="file" name="img_top"></label></br>').insertAfter($(this));

    }else{
        $('.img_top').remove();
    }

});
