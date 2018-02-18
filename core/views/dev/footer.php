<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!--<script src="/assets/js/dop_link.js"></script>-->
<!--<script src="/assets/js/PHPMailer.js"></script>-->
<script src="/assets/js/ajax.js"></script>
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
     function sortable(){
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    }
</script>


<script src="/assets/js/output-position&btn.js"></script>
<script src="/assets/js/basket.js"></script>
<script src="/assets/js/modal-form_btn-scroll.js"></script>

<script type="text/javascript" src="/assets/slick/slick/slick.min.js">
</script>
<script type="text/javascript">
        // $('.header-slider').slick({
        //     dots: true,
        //     autoplay: true,
        //     infinite: true,
        //     speed: 350,
        //     fade: true,
        //     cssEase: 'linear',
        //     arrows: false,
        //     slidesToShow: 1,
        //     //количество слайдов, которые выводятся на экране
        //
        //     //adaptiveHeight: true
        // });

        var width;
        if (+($('body').width())<350) {
            width=1
        }else{
            width=3;
        }
        $(window).ready(function(){$('.center').slick({
            dots:true,
            slidesToShow:width,
            autoplay:true,
            autoSpeed:100,
            arrows:false,
            speed:200,
            ltr:true
        });});
</script>
<?php if(getUrlSegment(0)=='admin'){?>
    <script src="/assets/js/admin.js"></script>
    <script src="/assets/js/adminForm.js"></script>
<script src="/assets/tinymce/js/tinymce/tinymce.min.js">
    </script>
    <script type="text/javascript">



        tinyMCE.init({
            selector: 'textarea',
            height: 500,
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
            image_advtab: true,
            templates: [
                { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ],
            setup : function(ed) {
                console.log(ed);
                ed.on('focus load', function(ed) {
                    if ($('div').is('.firstMceVal')) {
                        var s = tinyMCE.activeEditor;
                        console.log(s);
                        var a = 'descriptione';
                        if (s['id'] == a) {
                            s.setContent($('.secondMceVal').html());

                        } else {
                            s.setContent($('.firstMceVal').html());

                        }
                    }

                    if ($('div').is('.post-t-MceVal')) {
                        var s = tinyMCE.activeEditor;
                        console.log(s);
                        var b = 'basic-t-description';
                        var c = 'basic-b-description';
                        var e = 'content_en';
                        var d = 'content';

                        if (s['id'] == b) {
                            s.setContent($('.post-t-MceVal').html());
                        }else if(s['id'] == c) {
                            s.setContent($('.post-b-MceVal').html());

                        }
                        else if(s['id'] == d) {
                            s.setContent($('.post-c-MceVal').html());

                        }
                        else if(s['id'] == e) {
                            s.setContent($('.post-e-MceVal').html());

                        }
                    }
                });

                ed.on('blur', function(ed) {
                    if ($('div').is('.firstMceVal')) {
                        var s = tinyMCE.activeEditor;
                        console.log(s);
                        var a = 'descriptione';
                        if (s['id'] == a) {
                            $('.secondMceVal').html(s.getContent());

                        } else {
                            $('.firstMceVal').html(s.getContent());

                        }
                    }
                    if ($('div').is('.post-t-MceVal')) {
                        var s = tinyMCE.activeEditor;
                        console.log(s);
                        var b = 'basic-t-description';
                        var c = 'basic-b-description';
                        var e= 'content_en';
                        var d = 'content';
                        if (s['id'] == b) {
                            $('.post-t-MceVal').html(s.getContent());
                        }else if(s['id'] == c) {
                            $('.post-b-MceVal').html(s.getContent());

                        }
                        else if(s['id'] == d) {
                            $('.post-c-MceVal').html(s.getContent());

                        }
                        else if(s['id'] == e) {
                            $('.post-e-MceVal').html(s.getContent());

                        }
                    }
                });

            }

        });
    </script>
<?php }?>
