$(document).ready(function(){
  var categories, movieData, movieId, movieName, posterPath, posterUrl, overview, releaseDate, cast, director, posterBackdrop, posterBackdropUrl, popularVote, firstThree;
  
  // BUILD DISCOVERY SECTION
  var discoveryMovies = $('#discoveryMovies'); 
  discoveryMovies.isotope({
    itemSelector: '.discovery-item',
    percentPosition: true,
    masonry: {
      // use element for option
      columnWidth: '.discovery-item'
    }
  });
  
  function initDiscoveryItems() {
    discoveryMovies.html('');
    // get discovery items in database
    $.ajax({
      type: "GET",
      url: "php/getDiscover.php",
      dataType: "json",
      success: function(result) {
          for(i=0; i<result.length; i++){
            var poster_recent = prefixUrl + result[i].poster_path,
                discovery_id = result[i].discovery_id,
                featured = result[i].featured;
            
            if (featured == 1){
              featured = 'discovery-featured';
            } else {
              featured = '';
            }
            poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
            fullItems = $('<div class="discovery-item '+featured+'" id="movie" data-discovery_id="'+discovery_id+'">'+poster_recent+'</div>');
            discoveryMovies.isotope('insert', fullItems );
            initDiscoveryFeature();
          }
          // layout Isotope after each image loads
          discoveryMovies.imagesLoaded().progress( function() {
            discoveryMovies.isotope('layout');
          });
      }
    }); 
  }
  
  initDiscoveryItems();
  
  function initDiscoveryFeature(){
    $('.discovery-item').unbind().on('click', function(){
      
      if ($(this).hasClass('discovery-featured')) {
        discoveryId = $(this).data('discovery_id');
        removeFeatured(discoveryId);
      } else if ( $('.discovery-featured').length > 3 ) {
        console.log('max featured hit');
      } else {
        discoveryId = $(this).data('discovery_id');
        addFeatured(discoveryId);
      }
        
    });
  }
  
  function addFeatured(discoveryId){
    movieIds = $.extend({}, discoveryId);
    
    $.ajax({
      type:"POST",
      url: "php/setDiscoverFeature.php",
      data: {discoveryId:discoveryId},
      dataType: "html",
      success: function(result){
        initDiscoveryItems();
      }
    });
  }
  
  function removeFeatured(discoveryId){
    movieIds = $.extend({}, discoveryId);
    
    $.ajax({
      type:"POST",
      url: "php/removeDiscoverFeature.php",
      data: {discoveryId:discoveryId},
      dataType: "html",
      success: function(result){
        initDiscoveryItems();
      }
    });
  }
  
  $('.getmovies').on('click', function(){
    discoveryMovies.css({height:'200px'});
    discoveryMovies.html('<div class="loading"><i class="fa fa-film"></i><br>Loading...</div>');
    
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
      url: "php/discoverClear.php",
      dataType: "html",                
      success: function(result) {
        seedDiscoveryTable();
      }
    });
  });
  
  function seedDiscoveryTable(){
    // get config from tMDB
    theMovieDb.configurations.getConfiguration(function(data){
          posterSize = $.parseJSON(data).images.poster_sizes;
          baseUrl = $.parseJSON(data).images.base_url.slice(0,-1);
    }, errorCB);
    
    // get new discovery items
    theMovieDb.discover.getMovies({"vote_average.gte": 7}, function(data){
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
      url: "php/discoverInsert.php",
      data: {
        categories:categories,
        movieName:movieName,
        posterUrl:posterUrl,
        overview:overview,
        releaseDate:releaseDate,
        posterBackdropUrl:posterBackdropUrl,
        cast:firstThree,
        director:director,
        popularVote:popularVote
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
      url: "php/getDiscovery.php",             
      dataType: "json",                
      success: function(result) {
        discoveryMovies.html('');
        for(i=0; i<result.length; i++){
          var poster_recent = prefixUrl + result[i].poster_path,
              featured_recent = result[i].featured;
              
              if (featured_recent){
                featured_recent = 'featured';
              } else {
                featured_recent = '';
              }

          poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';

          fullItems = $('<div class="discovery-item '+featured_recent+'" id="movie">'+poster_recent+'</div>');

          discoveryMovies.isotope('insert', fullItems ).isotope('layout');
        }
        initControls();
      }
    });
  }
  
  function initControls(){
    
  }
});