$(document).ready(function(){
  var key = '&api_key=ff47119f9629ccfa68c832ccc6b470ef',
      url = 'http://api.themoviedb.org/3/',
      movie = 'search/movie?query=';
  
  
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });  
  
  tinymce.init({
    selector:'textarea',
    height : 300
  });
})