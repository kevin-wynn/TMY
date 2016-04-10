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
      moviePoster = $('#moviePoster'),
      wave = 0;
  
  var baseUrl, imageUrl;

  theMovieDb.configurations.getConfiguration(function(data){
    baseUrl = $.parseJSON(data).images.base_url;
    imageUrl = baseUrl + 'w500';
  }, errorCB);
  
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
  
  function toTitleCase(str) {
      return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
  }
  
  var movieId = getUrlParameter('movie_id');
  
  var movieName = /[^/]*$/.exec(window.location)[0];
  
  movieName = movieName.replace(/-/g, ' ');
  
  movieName = toTitleCase(movieName);
  
  // GET MOVIE AND BUILD PAGE
  if(movieId){
    $.ajax({
      type: "GET",
      url: "../php/pageDetails.php",  
      data: {movie_id:movieId},
      dataType: "json",                
      success: function(result) {
        buildPage(result);
      }
    });
  } else if(movieId === '' || movieName){
    $.ajax({
      type: "GET",
      url: "../php/pageDetailsMovieName.php",  
      data: {movieName:movieName},
      dataType: "json",                
      success: function(result) {
        buildPage(result);
      }
    });
  }
  
  function buildPage(result){
    var backdrop = prefixUrl + result[0].backdrop_path,
        title = result[0].movie_title,
        genres = result[0].genre,
        overview = result[0].overview,
        score = result[0].score,
        director = result[0].director,
        cast = result[0].cast,
        review = result[0].review,
        trailer = result[0].trailer,
        poster = result[0].poster_path,
        poster2 = result[0].poster2_path,
        backdrop2_path = result[0].backdrop2_path,
        backdrop3_path = result[0].backdrop3_path,
        moviedb_id = result[0].moviedb_id,
        wave = 0;

      heroImage.css('background-image', 'url('+backdrop+')');
      $('.footer').css('background-image', 'url('+backdrop+')');
      movieTitle.html('<span class="">'+title+'</span>');
      movieGenres.html(genres);
      movieOverview.html(overview);
      moviePoster.prepend('<img class="poster" src="..'+poster+'">');

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

    review = review.replace(/(?:\r\n|\r|\n)/g, '<br/>');

    Array.prototype.clean = function(deleteValue) {
      for (var i = 0; i < this.length; i++) {
        if (this[i] == deleteValue) {         
          this.splice(i, 1);
          i--;
        }
      }
      return this;
    };

    review = review.split('<br/>');

    if(trailer !== ''){
      trailer = '<div id="movieTrailer" class="trailer-container"><iframe src="'+trailer+'modestbranding=1;controls=0;showinfo=0;rel=0;fs=1" frameborder="0" allowfullscreen></iframe></div>';
    } else {
      trailer = '';
    }

    if(backdrop2_path != '/assets/images/backdrops/'){backdrop2_path = '<img src="..'+backdrop2_path+'">';} else { backdrop2_path = '';}

    if(backdrop3_path != '/assets/images/backdrops/'){backdrop3_path = '<img src="..'+backdrop3_path+'">';} else { backdrop3_path = ''; }

    var pageContent = $('#pageContent');

    pageContent.append('<div class="col-md-6 interior-image">'+backdrop2_path+'</div>');
    pageContent.append('<div class="col-md-6 interior-image">'+backdrop3_path+'</div>');

    for(i=0; i<review.length; i++) {
      if(review[i].length < 50){
        pageContent.append('<div class="col-md-12" style="font-size:24px;">'+review[i]+'<br></div>');  
      } else {
        pageContent.append('<div class="col-md-12">'+review[i]+'<br></div>');
      }
    }
    pageContent.append('<div class="col-md-12"><br>'+trailer+'</div>');

    $('#movieTrailer').fitVids();
    
    theMovieDb.movies.getSimilarMovies({"id":moviedb_id }, function(data){
      var results = $.parseJSON(data).results;
      
      for(i=0; i<3; i++){
        var poster = results[i].poster_path,
            title = results[i].original_title,
            movie_id = results[i].id,
            similarMovies = $('#similarMovies');
        
        poster = imageUrl + poster;
        
        similarMovies.append('<div data-movie-id="'+movie_id+'" class="col-md-4 similar"><img src="'+poster+'"><p>'+title+'</p></div>');
        
        buildExternalLink(movie_id);
      }
    }, errorCB);
    
    // get IMDB id and wrap div in link
    function buildExternalLink(movie_id){
      theMovieDb.movies.getById({"id":movie_id }, function(data){
        var imdbId = $.parseJSON(data).imdb_id,
            imdbPrefix = 'http://www.imdb.com/title/',
            imdbFullLink = imdbPrefix + imdbId,
            poster = $('[data-movie-id="'+movie_id+'"]');
        poster.wrap('<a target="_blank" href="' + imdbFullLink + '"></a>');
      }, errorCB);
    }
  }
  
});