// RESET PASSWORD SEND CODE //
document.getElementById('resetPass').addEventListener("click", function() {
    document.querySelector('.forgotpassword-page2').style.display = "flex";
    document.querySelector('.forgotpassword-page').style.display = "none";
    document.querySelector('.bg-modal').style.display = "none";
    document.querySelector('.bg-modal2').style.display = "none";
});
    document.querySelector('.close5').addEventListener("click", function() {
    document.querySelector('.forgotpassword-page2').style.display = "none";
});

/* BACK TO LOGIN */
document.getElementById('backtologin2').addEventListener("click", function() {
    document.querySelector('.bg-modal').style.display = "flex";
    document.querySelector('.forgotpassword-page2').style.display = "none";
    document.querySelector('.forgotpassword-page').style.display = "none";
    document.querySelector('.bg-modal2').style.display = "none";
});



// RESET PASSWORD LAST//
document.getElementById('resetPass2').addEventListener("click", function() {
    document.querySelector('.forgotpassword-page1').style.display = "flex";
    document.querySelector('.forgotpassword-page2').style.display = "none";
    document.querySelector('.bg-modal').style.display = "none";
    document.querySelector('.bg-modal2').style.display = "none";
});
    document.querySelector('.close4').addEventListener("click", function() {
    document.querySelector('.forgotpassword-page1').style.display = "none";
});


// DISABLE FUTURE DATE ON DATE OF BIRTH
$(document).ready(function(){

    var dtToday = new Date();
  
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
  
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
  
    var maxDate = year + '-' + month + '-' + day;    
    $('#txtbirthdate').attr('max', maxDate);
  })