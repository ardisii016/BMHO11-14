// search-box open close js code
let navbar = document.querySelector(".navbar");
let searchBox = document.querySelector(".search-box .bx-search");
// let searchBoxCancel = document.querySelector(".search-box .bx-x");

searchBox.addEventListener("click", ()=>{
  navbar.classList.toggle("showInput");
  if(navbar.classList.contains("showInput")){
    searchBox.classList.replace("bx-search" ,"bx-x");
  }else {
    searchBox.classList.replace("bx-x" ,"bx-search");
  }
});

// sidebar open close js code
let navLinks = document.querySelector(".nav-links");
let menuOpenBtn = document.querySelector(".navbar .bx-menu");
let menuCloseBtn = document.querySelector(".nav-links .bx-x");
menuOpenBtn.onclick = function() {
navLinks.style.left = "0";
}
menuCloseBtn.onclick = function() {
navLinks.style.left = "-100%";
}


// sidebar submenu open close js code
let htmlcssArrow = document.querySelector(".htmlcss-arrow");
htmlcssArrow.onclick = function() {
 navLinks.classList.toggle("show1");
}

let htmlcssArrow1 = document.querySelector(".sidebar-arrow");
htmlcssArrow1.onclick = function() {
 navLinks.classList.toggle("show1");
}





// current date only
$(document).ready(function(){

    var dtToday = new Date();
  
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate() + 1;
    var year = dtToday.getFullYear();
  
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
  
    var maxDate = year + '-' + month + '-' + day;    
    $('#txtDate').attr('min', maxDate);
})


// NO SUNDAY
const picker = document.getElementById('txtDate');
picker.addEventListener('input', function(e){
  var day = new Date(this.value).getUTCDay();
  if([0, 6].includes(day)){
    e.preventDefault();
    this.value = '';
    alert('Sorry but Health Center are closed every weekends');
  }
});


//limit to 3 check box

$('.box').on('change', function (e) {
  if ($('.box:checked').length > 3) {
      $(this).prop('checked', false);
  }
});

//submit button to go to summary-pdf
document.getElementById("submit-btn").addEventListener("click", myFunction);
function myFunction() {
  window.location.href="summary-pdf.php";
}


