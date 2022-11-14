 /* NAVIGATION BAR */
 const menu = document.querySelector('#mobile-menu');
 const menuLinks = document.querySelector('.navbar__menu');
 const navLogo = document.querySelector('#navbar__logo');
 
 //display mobile menu
 const mobileMenu = () => {
     menu.classList.toggle('is-active')
     menuLinks.classList.toggle('active')
 }
 
 menu.addEventListener('click', mobileMenu);

 /* POPUP-LOGIN */
    document.getElementById('signin').addEventListener("click", function() {
	document.querySelector('.bg-modal').style.display = "flex";
    document.querySelector('.bg-modal2').style.display = "none";
    document.querySelector('.forgotpassword-page').style.display = "none";
});
    document.querySelector('.close').addEventListener("click", function() {
	document.querySelector('.bg-modal').style.display = "none";
});

/* DONT HAVE AN ACCOUNT REGISTER HERE */
    document.getElementById('register').addEventListener("click", function() {
    document.querySelector('.bg-modal2').style.display = "flex";
    document.querySelector('.bg-modal').style.display = "none";
    document.querySelector('.forgotpassword-page').style.display = "none";
});

/* POPUP-SIGNUP */
    document.getElementById('signup').addEventListener("click", function() {
	document.querySelector('.bg-modal2').style.display = "flex";
    document.querySelector('.bg-modal').style.display = "none";
    document.querySelector('.forgotpassword-page').style.display = "none";
});
    document.querySelector('.close2').addEventListener("click", function() {  
    document.querySelector('.bg-modal2').style.display = "none";
});

/* ALREADY HAVE AN ACCOUNT REGISTER HERE */
    document.getElementById('login').addEventListener("click", function() {
    document.querySelector('.bg-modal').style.display = "flex";
	document.querySelector('.bg-modal2').style.display = "none";
    document.querySelector('.forgotpassword-page').style.display = "none";
});

/* FORGOT PASSWORD */
document.getElementById('forgot-password').addEventListener("click", function() {
    document.querySelector('.forgotpassword-page').style.display = "flex";
	document.querySelector('.bg-modal').style.display = "none";
    document.querySelector('.bg-modal2').style.display = "none";
});
    document.querySelector('.close3').addEventListener("click", function() {
    document.querySelector('.forgotpassword-page').style.display = "none";
});

/* BACK TO LOGIN */
    document.getElementById('backtologin').addEventListener("click", function() {
    document.querySelector('.bg-modal').style.display = "flex";
    document.querySelector('.forgotpassword-page').style.display = "none";
    document.querySelector('.bg-modal2').style.display = "none";
});


// SHOW/HIDE PASSWORD //
let passwordInput = document.getElementById('txtPass'),
    toggle = document.getElementById('btnToggle'),
    icon = document.getElementById('eyeIcon');

function togglePassword(){
    if (passwordInput.type === 'password'){
        passwordInput.type = 'text';
        icon.classList.add("fa-eye-slash");
    }
    else{
        passwordInput.type = 'password';
        icon.classList.remove("fa-eye-slash");
    }
}

function checkInput(){
}
toggle.addEventListener('click', togglePassword, false);
passwordInput.addEventListener('keypup', checkInput, false);



 /* IMAGE SLIDER (HOME) */
const slider = document.querySelector(".slider");
const nextBtn = document.querySelector(".next-btn");
const prevBtn = document.querySelector(".prev-btn");
const slides = document.querySelectorAll(".slide");
const slideIcons = document.querySelectorAll(".slide-icon");
const numberOfSlides = slides.length;
var slideNumber = 0;

//image slider next button
nextBtn.addEventListener("click", () => {
slides.forEach((slide) => {
slide.classList.remove("active");
});
slideIcons.forEach((slideIcon) => {
slideIcon.classList.remove("active");
});

slideNumber++;

if(slideNumber > (numberOfSlides - 1)){
slideNumber = 0;
}

slides[slideNumber].classList.add("active");
slideIcons[slideNumber].classList.add("active");
});

//image slider previous button
prevBtn.addEventListener("click", () => {
slides.forEach((slide) => {
slide.classList.remove("active");
});
slideIcons.forEach((slideIcon) => {
slideIcon.classList.remove("active");
});

slideNumber--;

if(slideNumber < 0){
slideNumber = numberOfSlides - 1;
}

slides[slideNumber].classList.add("active");
slideIcons[slideNumber].classList.add("active");
});

//image slider autoplay
var playSlider;

var repeater = () => {
playSlider = setInterval(function(){
slides.forEach((slide) => {
 slide.classList.remove("active");
});
slideIcons.forEach((slideIcon) => {
 slideIcon.classList.remove("active");
});

slideNumber++;

if(slideNumber > (numberOfSlides - 1)){
 slideNumber = 0;
}

slides[slideNumber].classList.add("active");
slideIcons[slideNumber].classList.add("active");
}, 4000);
}
repeater();

//stop the image slider autoplay on mouseover
slider.addEventListener("mouseover", () => {
clearInterval(playSlider);
});

//start the image slider autoplay again on mouseout
slider.addEventListener("mouseout", () => {
repeater();
});

// Show active menu when scrolling
const highlightMenu = () => {
const elem = document.querySelector('.highlight');
const homeMenu = document.querySelector('#home');
const aboutMenu = document.querySelector('#about');
const servicesMenu = document.querySelector('#signup');
let scrollPos = window.scrollY;
// console.log(scrollPos);

// adds 'highlight' class to my menu items
if (window.innerWidth > 960 && scrollPos < 600) {
homeMenu.classList.add('highlight');
aboutMenu.classList.remove('highlight');
return;
} else if (window.innerWidth > 960 && scrollPos < 1400) {
aboutMenu.classList.add('highlight');
homeMenu.classList.remove('highlight');
servicesMenu.classList.remove('highlight');
return;
} else if (window.innerWidth > 960 && scrollPos < 2345) {
servicesMenu.classList.add('highlight');
aboutMenu.classList.remove('highlight');
return;
}

if ((elem && window.innerWIdth < 960 && scrollPos < 600) || elem) {
elem.classList.remove('highlight');
}
};

window.addEventListener('scroll', highlightMenu);
window.addEventListener('click', highlightMenu);

//  Close mobile Menu when clicking on a menu item
const hideMobileMenu = () => {
const menuBars = document.querySelector('.is-active');
if (window.innerWidth <= 768 && menuBars) {
menu.classList.toggle('is-active');
menuLinks.classList.remove('active');
}
};

menuLinks.addEventListener('click', hideMobileMenu);
navLogo.addEventListener('click', hideMobileMenu);
