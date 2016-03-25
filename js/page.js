var prefixUrl = window.location.pathname.slice(0, -1);
    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));
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
      movieTrailer = $('#movieTrailer'),
      wave = 0;
  
      for(i=0; i<score; i++){
        movieScore.append('<i class="fa fa-star"></i> ');
      }

      movieTrailer.fitVids();  
  
      cast = cast0 + ',' + cast1 + ',' + cast2;
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
  
  // sets up interation with clicking a movie poster - redirects them to /movies/clicked
  function initControls(){
    var movie = $("[id=movie]"),
        movie_title, url;

      movie.on('click', function(){
      // get the h2 value that holds the movie title
      movie_title = $(this).find($('h2')).html();

      // if movie title has a space, replace it with a dash
      if(movie_title.indexOf(' ') != -1) {
        movie_title = movie_title.replace(' ', '-');
      }

      // make sure its lowercase
      movie_title = movie_title.toLowerCase();

      // prepend location to url
      url = prefixUrl+'/movies/'+movie_title;

      // redirect
      window.location.href = url;
    });
  }
  
});