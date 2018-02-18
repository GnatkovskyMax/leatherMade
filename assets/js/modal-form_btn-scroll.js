/**
 * Created by Max on 08.02.2017.
 */
function loader(){
    var form='<div class="modal-form">' +
        '<div class="com-form">' +
         '<img src="/assets/img/load.gif">'+
        '</div>' +
        '<div class="clos"></div>' +
        '</div>';
    $('body').append(form);
    var height=parseFloat($(window).height()+100);
    console.log(height);
    $('.modal-form').height(height);
    $(window).resize(function(){
        var height=parseFloat($(window).height()+100);
        $('.modal-form').height(height);
    });
    $('.modal-form').addClass('show-modal');
}
// $('.helper-panel').on('click',function (e) {
//     var obj = e.target;
//     console.log(obj.className);
//  switch(obj.className){
//      case "helper-btn rent-scroll":
//          console.log($('#filter').height());
//          var rent = $('.scroll-rent').offset().top;
//          var height;
//          if($('#filter').is('.hh')){
//               height= $('#filter').height();
//          }else{
//              height= $('#filter').height()*2;
//          }
//          var scroll = rent-height;
//          $('body').animate({ scrollTop: scroll }, 600);
//          return false;
//          break;
//      case "helper-btn sale-scroll":
//          var sale = $('.scroll-sale').offset().top;
//          var height;
//          if($('#filter').is('.hh')){
//              height= $('#filter').height();
//          }else{
//              height= $('#filter').height()*2;
//          }
//          var scroll = sale-height;
//          $('body').animate({ scrollTop: scroll }, 600);
//          return false;
//          break;
//      case "helper-btn up-scroll":
//          $('body').animate({ scrollTop: 0 }, 600);
//          return false;
//          break;
//      case "helper-btn similarObj":
//          var sale = $('.similar-scroll').offset().top;
//         $('body').animate({ scrollTop: sale }, 600);
//         return false;
//         break;
//
// }
// });