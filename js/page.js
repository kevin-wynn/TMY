var prefixUrl = window.location.pathname.slice(0, -1);
    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));
    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));

function errorCB(data){
  console.log('error');
}

$(document).ready(function(){
  var heroImage = $('#heroImage'),
      movieTitle = $('#movieTitle'),
      movieOverview = $('#movieOverview'),
      movieGenres = $('#movieGenres'),
      movieScore = $('#movieScore'),
      movieDirector = $('#movieDirector'),
      movieCast = $('#movieCast'),
      movieTrailer = $('#movieTrailer'),
      wave = 0;
  
  movieTrailer.fitVids();
  
  var getUrlParameter = function getUrlParameter(sParam) {
      var sPageURL = decodeURIComponent(window.location.search.substring(1)),
          sURLVariables = sPageURL.split('&'),
          sParameterName,
          i;

      for (i = 0; i < sURLVariables.length; i++) {
          sParameterName = sURLVariables[i].split('=');

          if (sParameterName[0] === sParam) {
              return sParameterName[1] === undefined ? true : sParameterName[1];
          }
      }
  };
  
  var movieId = getUrlParameter('movie_id');
  
  console.log(movieId);
  
  // FEATURED HERO IMAGE
  $.ajax({
    type: "GET",
    url: "../php/pageDetails.php",  
    data: {movie_id:movieId},
    dataType: "json",                
    success: function(result) {
      var backdrop = prefixUrl + result[0].backdrop_path,
          title = result[0].movie_title,
          genres = result[0].genre,
          overview = result[0].overview,
          score = result[0].score,
          director = result[0].director,
          cast = result[0].cast,
          wave = 0;
      
          for(i=0; i<score; i++){
            movieScore.append('<i class="fa fa-star"></i> ');
          }

          cast = cast.replace(/ /g,'');
          cast = cast.split(',');
          movieCast.html('<span class="intro-text">Starring - </span>');
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
      
      console.log(title);
    }
  });
  
});

function buildPage(score, review, cast){

//  
//  console.log(review);
}