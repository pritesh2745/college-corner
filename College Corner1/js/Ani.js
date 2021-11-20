window.addEventListener('scroll',scrollAppear);
function scrollAppear(){
    var aboutText = document.querySelector('.aboutText');
    var aboutTextPoistion = aboutText.getBoundingClientRect().top;

    var aboutImg = document.querySelector('.aboutImg');
    var aboutImgPoistion = aboutImg.getBoundingClientRect().top;

    var aboutMe = document.querySelector('.aboutMe');
    var aboutMePoistion = aboutMe.getBoundingClientRect().top;

    var Box = document.querySelector('.box');
    var BoxPoistion = Box.getBoundingClientRect().top;

    var screenPosition = window.innerHeight;

    if(aboutMePoistion < screenPosition){
        aboutMe.classList.add('intro-appear-rl');
    }
    if(aboutTextPoistion < screenPosition){
        aboutText.classList.add('intro-appear-ud');
    }
    if(aboutImgPoistion < screenPosition){
        aboutImg.classList.add('intro-appear-rl');
    }
    if(BoxPoistion < screenPosition){
        Box.classList.add('intro-appear-ud');
    }
}
window.addEventListener('scroll', hey);
function hey(){
    var nav = document.querySelector('.nav');
    var goTop = document.querySelector('.goTop');
    if(this.scrollY > 10){
        nav.classList.add("navshow");
    }
    else{
      nav.classList.remove("navshow");
    }
}