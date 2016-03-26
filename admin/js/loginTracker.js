$(document).ready(function(){
  
  var d = new Date();

  var month = d.getMonth()+1;
  var day = d.getDate();

  var login = d.getFullYear() + '/' +
      (month<10 ? '0' : '') + month + '/' +
      (day<10 ? '0' : '') + day;

  console.log('login date: ', login);
  
  $.ajax({
    type: "GET",
    url: "php/loginTracker.php",
    data: {login:login},
    dataType: "json",                
    success: function(result) {
      console.log(result);
    }
  });
});