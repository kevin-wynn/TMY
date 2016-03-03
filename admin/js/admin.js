$(document).ready(function(){
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });  
  
  tinymce.init({
    selector:'textarea',
    height : 300
  });
})