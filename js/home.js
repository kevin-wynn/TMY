var prefixUrl = window.location.pathname.slice(0, -1);

var offset = 0, limit = 4;

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
  
    $.ajax({
      type: "GET",
      url: "php/moviesReviewed.php",             
      dataType: "json",
      data: {offset:0, limit:8},
      success: function(result) {
        // clear current movies here
        $('#recentMovies').html('');
        
        for(i=0; i<result.length; i++){
          // grab content from json returned
          var poster_recent = prefixUrl + result[i].poster_path,
              title_recent = result[i].movie_title,
              genres_recent = result[i].genre,
              overview_recent = result[i].overview,
              score_recent = result[i].score,
              director_recent = result[i].director,
              publish_date = result[i].publish_date,
              release_date = result[i].release_date,
              score_recentContainer;

          var genres_forID = genres_recent.replace(/,/g, "");
              genres_forID = genres_forID.toLowerCase();
          
          poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
          title_recent = '<h2 id="movie_title">'+title_recent+'</h2>';
          genres_recent = '<p id="genres">'+genres_recent+'</p>';
          overview_recent = '<p>'+overview_recent+'</p>';
          director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
          score_recentContainer = '<div class="score">';
          score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 
          
          fullItems = $('<div data-released="'+release_date+'" data-published="'+publish_date+'" class="recent-item '+genres_forID+'" id="movie">'+poster_recent+'<div class="col-md-10 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-2 score-container">'+score_recentContainer+'</div></div>');
        
          $('#recentMovies').isotope('insert', fullItems ).isotope('layout');
        }
        
        initControls();
      }
    });
});