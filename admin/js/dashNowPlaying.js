$(document).ready(function(){
  var categories, movieData, movieId, movieName, posterPath, posterUrl, overview, releaseDate, cast, director, posterBackdrop, posterBackdropUrl, popularVote, firstThree;
  
  // BUILD NOWPLAYING SECTION
  var nowplayingMovies = $('#nowplayingMovies'); 
  nowplayingMovies.isotope({
    itemSelector: '.nowplaying-item',
    percentPosition: true,
    masonry: {
      // use element for option
      columnWidth: '.nowplaying-item'
    }
  });
  
  function initNowplayingItems() {
    nowplayingMovies.html('');
    // get nowplaying items in database
    $.ajax({
      type: "GET",
      url: "php/getNowplaying.php",
      dataType: "json",
      success: function(result) {
          for(i=0; i<result.length; i++){
            var poster_recent = prefixUrl + result[i].poster_path,
                nowplaying_id = result[i].nowplaying_id,
                featured = result[i].featured;
            
            if (featured == 1){
              featured = 'nowplaying-featured';
            } else {
              featured = '';
            }
            poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
            fullItems = $('<div class="nowplaying-item '+featured+'" id="movie" data-nowplaying_id="'+nowplaying_id+'">'+poster_recent+'</div>');
            nowplayingMovies.isotope('insert', fullItems );
            initNowplayingFeature();
          }
          // layout Isotope after each image loads
          nowplayingMovies.imagesLoaded().progress( function() {
            nowplayingMovies.isotope('layout');
          });
      }
    }); 
  }
  
  initNowplayingItems();
  
  function initNowplayingFeature(){
    $('.nowplaying-item').unbind().on('click', function(){
      
      if ($(this).hasClass('nowplaying-featured')) {
        nowplayingId = $(this).data('nowplaying_id');
        removeFeatured(nowplayingId);
      } else if ( $('.nowplaying-featured').length > 3 ) {
        console.log('max featured hit');
      } else {
        nowplayingId = $(this).data('nowplaying_id');
        addFeatured(nowplayingId);
      }
        
    });
  }
  
  function addFeatured(nowplayingId){
    movieIds = $.extend({}, nowplayingId);
    
    $.ajax({
      type:"POST",
      url: "php/setNowplayingFeatured.php",
      data: {nowplayingId:nowplayingId},
      dataType: "html",
      success: function(result){
        initNowplayingItems();
      }
    });
  }
  
  function removeFeatured(nowplayingId){
    movieIds = $.extend({}, nowplayingId);
    
    $.ajax({
      type:"POST",
      url: "php/removeNowplayingFeature.php",
      data: {nowplayingId:nowplayingId},
      dataType: "html",
      success: function(result){
        initNowplayingItems();
      }
    });
  }
  
  $('.getmovies-nowplaying').on('click', function(){
    nowplayingMovies.css({height:'200px'});
    nowplayingMovies.html('<div class="loading"><i class="fa fa-film"></i><br>Loading...</div>');
    
    $('.loading').bind('fade-cycle', function() {
        $(this).fadeOut('slow', function() {
            $(this).fadeIn('slow', function() {
                $(this).trigger('fade-cycle');
            });
        });
    });
    
    $('.loading').trigger('fade-cycle');
    // clear discovery table
    $.ajax({
      type: "POST",
      url: "php/nowplayingClear.php",
      dataType: "html",                
      success: function(result) {
        seedNowplayingTable();
      }
    });
  });
  
  function seedNowplayingTable(){
    // get config from tMDB
    theMovieDb.configurations.getConfiguration(function(data){
          posterSize = $.parseJSON(data).images.poster_sizes;
          baseUrl = $.parseJSON(data).images.base_url.slice(0,-1);
    }, errorCB);
    
    // get new nowplaying items
    theMovieDb.movies.getNowPlaying({}, function(data){
      var discovery = $.parseJSON(data).results;
      for(i=0; i < discovery.length; ++i) {
        categories = $.parseJSON(data).results[i].genre_ids;
        movieData = $.parseJSON(data).results[i];
        movieId = $.parseJSON(data).results[i].id;
        movieName = $.parseJSON(data).results[i].original_title;
        posterPath = $.parseJSON(data).results[i].poster_path;
        posterUrl = baseUrl + '/w500' + posterPath;
        overview = $.parseJSON(data).results[i].overview;
        releaseDate = $.parseJSON(data).results[i].release_date;
        posterBackdrop = $.parseJSON(data).results[i].backdrop_path;
        posterBackdropUrl = baseUrl + '/original' + posterBackdrop;
        popularVote = $.parseJSON(data).results[i].vote_average;
        cast = $.parseJSON(data).results[i].cast;
        director = $.parseJSON(data).results[i].director;
        
        insertData();
      }

    }, errorCB); 
  }
  
  function insertData(){
    $.ajax({
      type: "POST",
      url: "php/nowplayingInsert.php",
      data: {
        categories:categories,
        movieName:movieName,
        posterUrl:posterUrl,
        overview:overview,
        releaseDate:releaseDate,
        posterBackdropUrl:posterBackdropUrl,
        cast:firstThree,
        director:director,
        popularVote:popularVote,
        movieId:movieId
      }, 
      dataType: "html",                
      success: function(result) {
        if(result == 20){
          getMovies();
        }
      }
    });
  }
  
  function getMovies(){
    var offset = 0, limit = 20;
    $.ajax({
      type: "GET",
      data: {offset:offset, limit:limit},
      url: "php/getNowplaying.php",             
      dataType: "json",                
      success: function(result) {
        nowplayingMovies.html('');
        for(i=0; i<result.length; i++){
          var poster_recent = prefixUrl + result[i].poster_path,
              featured_recent = result[i].featured;
              
              if (featured_recent){
                featured_recent = 'featured';
              } else {
                featured_recent = '';
              }

          poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';

          fullItems = $('<div class="nowplaying-item '+featured_recent+'" id="movie">'+poster_recent+'</div>');

          nowplayingMovies.isotope('insert', fullItems ).isotope('layout');
        }
        initControls();
      }
    });
  }
  
  function initControls(){
    
  }
});