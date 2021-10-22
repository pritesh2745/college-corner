// $(document).ready(function(){
//     $(window).scroll(function(){
//         if($(window).scrollTop() > $(window).height()){
//             $(".navigation").css({"background-color":"transparent"});   
//         }
//         else{
//             $(".navigation").css({"background-color":"white"});
//         }

//     })
// })
$(document).ready(function(){
    $(window).scroll(function(){
      if(this.scrollY > 20){
        $(".navbar").addClass("sticky");
        $(".goTop").fadeIn();
      }
      else{
        $(".navbar").removeClass("sticky");
        $(".goTop").fadeOut();
      }
    };