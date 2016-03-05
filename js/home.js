var prefixUrl = window.location.pathname.slice(0, -1);

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
      var backdrop = prefixUrl + result[0].backdrop_path,
          title = result[0].movie_title,
          genres = result[0].genre,
          overview = result[0].overview,
          score = result[0].score,
          director = result[0].director,
          cast = result[0].cast;
      
      heroImage.css('background-image', 'url('+backdrop+')');
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
    url: "php/homeReviewed.php",             
    dataType: "json",                
    success: function(result) {
      for(i=0; i<result.length; i++){
        var poster_recent = prefixUrl + result[i].poster_path,
            title_recent = result[i].movie_title,
            genres_recent = result[i].genre,
            overview_recent = result[i].overview,
            score_recent = result[i].score,
            director_recent = result[i].director,
            score_recentContainer;

        poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
        title_recent = '<h2>'+title_recent+'</h2>';
        genres_recent = '<p>'+genres_recent+'</p>';
        overview_recent = '<p>'+overview_recent+'</p>';
        director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
        score_recentContainer = '<div class="score">';
        
        score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 
        
        $('#recentMovies').append('<div class="col-sm-4 recent-item">'+poster_recent+'<div class="col-md-11 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-1 score-container">'+score_recentContainer+'</div></div>');
      }
    }
  });
  
  var sortItems = $('#sortItems'),
      sortAction = $('#sortAction');
  
  sortItems.hide();
  
  sortAction.on('click', function(){
    sortItems.slideDown('slow');
  });
  
  sortItems.on('click', function(){
    sortItems.slideUp('slow');
  });
  
  $('#sortReleased').on('click', function(){
    $.ajax({
      type: "GET",
      url: "php/homeReleased.php",             
      dataType: "json",                
      success: function(result) {
        // clear current movies here
        $('#recentMovies').html('');
        
        for(i=0; i<result.length; i++){
          var poster_recent = prefixUrl + result[i].poster_path,
              title_recent = result[i].movie_title,
              genres_recent = result[i].genre,
              overview_recent = result[i].overview,
              score_recent = result[i].score,
              director_recent = result[i].director,
              score_recentContainer;

          poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
          title_recent = '<h2>'+title_recent+'</h2>';
          genres_recent = '<p>'+genres_recent+'</p>';
          overview_recent = '<p>'+overview_recent+'</p>';
          director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
          score_recentContainer = '<div class="score">';

          score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 

          $('#recentMovies').append('<div class="col-sm-4 recent-item">'+poster_recent+'<div class="col-md-11 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-1 score-container">'+score_recentContainer+'</div></div>');
        }
      }
    });
  });
  
  $('#sortReviewed').on('click', function(){
    $.ajax({
      type: "GET",
      url: "php/homeReviewed.php",             
      dataType: "json",                
      success: function(result) {
        // clear current movies here
        $('#recentMovies').html('');
        
        for(i=0; i<result.length; i++){
          var poster_recent = prefixUrl + result[i].poster_path,
              title_recent = result[i].movie_title,
              genres_recent = result[i].genre,
              overview_recent = result[i].overview,
              score_recent = result[i].score,
              director_recent = result[i].director,
              score_recentContainer;

          poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
          title_recent = '<h2>'+title_recent+'</h2>';
          genres_recent = '<p>'+genres_recent+'</p>';
          overview_recent = '<p>'+overview_recent+'</p>';
          director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
          score_recentContainer = '<div class="score">';

          score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 

          $('#recentMovies').append('<div class="col-sm-4 recent-item">'+poster_recent+'<div class="col-md-11 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-1 score-container">'+score_recentContainer+'</div></div>');
        }
      }
    });
  });
});