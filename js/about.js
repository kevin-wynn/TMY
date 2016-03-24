var prefixUrl = window.location.pathname.slice(0, -1);
    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));

function errorCB(data){
  console.log('error');
}

$(document).ready(function() {
  var heroImage = $('#heroImage'),
      movieTitle = $('#movieTitle'),
      movieOverview = $('#movieOverview'),
      movieGenres = $('#movieGenres'),
      movieScore = $('#movieScore'),
      movieDirector = $('#movieDirector'),
      movieCast = $('#movieCast'),
      wave = 0;
  
  console.log(prefixUrl);
  
  $.ajax({
    type: "GET",
    url: "php/heroImage.php",             
    dataType: "json",                
    success: function(result) {
      // grab content from json returned
      var backdrop = prefixUrl + result[0].backdrop_path,
          title = result[0].movie_title,
          genres = result[0].genre,
          overview = result[0].overview,
          score = result[0].score,
          director = result[0].director,
          cast = result[0].cast;
      
      // build out and inject html for injection
      heroImage.css('background-image', 'url('+backdrop+')');
      $('.footer').css('background-image', 'url('+backdrop+')');
      movieTitle.html(title);
      movieGenres.html(genres);
      movieOverview.html(overview);
      movieCast.html(cast);
      movieDirector.html('<span class="intro-text">Directed By - </span>' + director);
      movieCast.html('<span class="intro-text">Starring - </span>');
      
      cast = cast.replace(/ /g,'');
      cast = cast.split(',');
      
      for(i=0; i<cast.length; i++){
        theMovieDb.people.getById({"id":cast[i]}, parseCast, errorCB);
      }
      
      function parseCast(data){
          var name = $.parseJSON(data).name;
        
          if(wave == cast.length) {
            movieCast.append(name);
          } else {
            movieCast.append(name + ', ');
          }
      }
      
      for(i=0; i<score; i++){
        movieScore.append('<i class="fa fa-star"></i> ');
      }
    }
  });
});