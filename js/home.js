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
    url: "php/homeRecent.php",             
    dataType: "json",                
    success: function(result) {
      console.log(result);
      console.log(result.length);
      for(i=0; i<result.length; i++){
        console.log('i: ',i);
        var poster_recent = prefixUrl + result[i].poster_path,
            title_recent = result[i].movie_title,
            genres_recent = result[i].genre,
            overview_recent = result[i].overview,
            score_recent = result[i].score,
            director_recent = result[i].director;
//            cast_recent = result[i].cast;

        poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
        title_recent = '<h2>'+title_recent+'</h2>';
        genres_recent = '<p>'+genres_recent+'</p>';
        overview_recent = '<p>'+overview_recent+'</p>';
//        cast_recent = '<p>'+cast_recent+'</p>';
        director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
        score_recent = '<div class="score">';

//        cast_recent = cast_recent.replace(/ /g,'');
//        cast_recent = cast_recent.split(',');

//        for(i=0; i<cast.length; i++){
//          theMovieDb.people.getById({"id":cast_recent[i]}, function(data){
//            var name = $.parseJSON(data).name;
//            movieCast_recent = '<p><span class="intro-text">Starring - </span>'+name+', ';
//            wave++
//            if(wave == cast.length-1) {
//              movieCast_recent.append(name)
//            } else {
//              movieCast_recent.append(name + ', ')
//            }
//          }, errorCB)
//        }
        
        $('#recentMovies').append('<div class="col-sm-3 recent-item">'+poster_recent+
                                title_recent+genres_recent+director_recent+'</div>');

//        for(i=0; i<score_recent; i++){
//          if (i+1 == score_recent){
//            score_recent = '<i class="fa fa-star"></i> '; 
//          } else {
//            score_recent = '<i class="fa fa-star"></i></div>';
//          }
//        } 
      }
    }
  });
  
  movieTitle.fitText( 0.75, {
    minFontSize: '50px'
  });
  
  movieGenres.fitText( 2.5, {
    minFontSize: '10px'
  });
});