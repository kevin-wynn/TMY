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
      wave = 0;
  
  $.ajax({
    type: "GET",
    url: "../php/heroImage.php",             
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
        theMovieDb.people.getById({"id":cast[i]}, function(data){
          var name = $.parseJSON(data).name;
          wave++
          if(wave == cast.length) {
            movieCast.append(name)
          } else {
            movieCast.append(name + ', ')
          }
        }, errorCB)
      }
      
      for(i=0; i<score; i++){
        movieScore.append('<i class="fa fa-star"></i> ');
      }
    }
  });
  
  $.ajax({
    type: "GET",
    url: "../php/homeReviewed.php",             
    dataType: "json",                
    success: function(result) {
      for(i=0; i<result.length; i++){
        // grab content from json returned
        var poster_recent = prefixUrl + result[i].poster_path,
            title_recent = result[i].movie_title,
            genres_recent = result[i].genre,
            overview_recent = result[i].overview,
            score_recent = result[i].score,
            director_recent = result[i].director,
            score_recentContainer;

        // build out html for injection
        poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
        title_recent = '<h2 id="movie_title">'+title_recent+'</h2>';
        genres_recent = '<p>'+genres_recent+'</p>';
        overview_recent = '<p>'+overview_recent+'</p>';
        director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
        score_recentContainer = '<div class="score">';
        
        score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 
        
        // inject html into container
        $('#recentMovies').append('<div class="col-sm-3 recent-item" id="movie">'+poster_recent+'<div class="col-md-10 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-2 score-container">'+score_recentContainer+'</div></div>');
      }
      
      initControls();
    }
  });
  
});

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