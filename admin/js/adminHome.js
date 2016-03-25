var prefixUrl = window.location.pathname;

    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));
    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));

function errorCB(data){
  console.log('error');
}

$(document).ready(function(){
    var baseUrl, posterSize, categories, movieData, movieId, movieName, posterPath, posterUrl, overview, releaseDate,
        posterBackdrop, posterBackdropUrl, cast, director, firstThree, actorIds, popularVote,
        discoveryId;
  
    // get most recently reviewed movie
    $.ajax({
    type: "GET",
    url: "php/adminDashboard.php",             
    dataType: "json",                
    success: function(result) {
      for(i=0; i<result.length; i++){
        var poster_recent = prefixUrl + result[i].poster_path,
            title_recent = result[i].movie_title,
            genres_recent = result[i].genre,
            overview_recent = result[i].overview,
            score_recent = result[i].score,
            director_recent = result[i].director,
            featured_recent = result[i].featured,
            score_recentContainer;
        
        poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
        title_recent = '<h2>'+title_recent+'</h2>';
        genres_recent = '<p>'+genres_recent+'</p>';
        overview_recent = '<p>'+overview_recent+'</p>';
        director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
        score_recentContainer = '<div class="score">';
        
        score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 
        
        $('#recentMovies').append('<div class="recent-item">'+poster_recent+'<div class="col-md-10 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-2 score-container">'+score_recentContainer+'</div></div>');
      }
    }
  });
  
  // get list of all users
    $.ajax({
    type: "GET",
    url: "php/adminUsers.php",             
    dataType: "json",                
    success: function(result) {
      for(i=0; i<result.length; i++){
        var user_id = result[i].user_id,
            username = result[i].username,
            email = result[i].email,
            permissions = result[i].permissions,
            signup = result[i].signup_date;
        
        if(permissions == 100){
          permissions = 'user';
        } else if (permissions == 200) {
          permissions = 'admin';
        } else if (permissions == 300) {
          permissions = 'super admin';
        }
        
        $('#users').append('<div class="col-md-1 user-id user">'+user_id+'</div><div class="col-md-4 username user">'+username+'</div><div class="col-md-3 email user">'+email+'</div><div class="col-md-2 permissions user">'+permissions+'</div><div class="col-md-2 signup user">'+signup+'</div>');
      }
    }
  });
  
  var ctx = $("#moviesAdded").get(0).getContext("2d"),
      dates = [], dates2 = [];
  
  // get chart dates
  $.ajax({
    type: "GET",
    url: "php/dashCharts.php",             
    dataType: "json",                
    success: function(result) {
      for(i=0; i<result.length; i++){
        var publish_date = result[i].publish_date,
            signup_date = result[i].signup_date;
        
        if(typeof publish_date != 'undefined') {
          dates.push(publish_date);
        }
        
        if(typeof signup_date != 'undefined') {
          dates2.push(signup_date);
        }
      }
//      console.log(dates);
//      console.log(dates2);
      
      var chartData = dates,
          chartData2 = dates2,
          counts = {},
          counts2 = {};

      $.each(chartData, function(key,value) {
        if (!counts.hasOwnProperty(value)) {
          counts[value] = 1;
        } else {
          counts[value]++;
        }
      });
      
      $.each(chartData2, function(key,value) {
        if (!counts2.hasOwnProperty(value)) {
          counts2[value] = 1;
        } else {
          counts2[value]++;
        }
      });
      
      var chartDates = [];
      for ( var property in counts ) {
        chartDates.push(property);
      }
      
      var chartDataArr = [];
      $.each(counts, function(key, element) {
        chartDataArr.push(element);
      });
      
      var chartData2Arr = [];
      $.each(counts2, function(key, element) {
        chartData2Arr.push(element);
      });
      
      var data = {
          labels: chartDates,
          datasets: [
              {
                  label: "Movies Added",
                  fillColor: "rgba(89,171,227,.2)",
                  strokeColor: "#59ABE3",
                  pointColor: "#59ABE3",
                  pointStrokeColor: "#fff",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(220,220,220,1)",
                  data: chartDataArr
              },{
                  label: "Users Signed Up",
                  fillColor: "rgba(3,166,120,.2)",
                  strokeColor: "#03A678",
                  pointColor: "#03A678",
                  pointStrokeColor: "#fff",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(220,220,220,1)",
                  data: chartData2Arr
              }
          ]
      };
      
      // This will get the first returned node in the jQuery collection.
      var myLineChart = new Chart(ctx).Line(data, {
        bezierCurve: true,
        scaleShowGridLines: false,
        multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>",
        scaleBeginAtZero: true
      });
    }
  });
  
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
        
        getCredits();
        insertData();
      }

    }, errorCB); 
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
        actorIds:actorIds,
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
  
  function getCredits(){
    theMovieDb.movies.getCredits({"id":movieId}, function(data){
      cast = $.parseJSON(data).cast;
      director = $.parseJSON(data).crew;
      firstThree = cast.splice(0,3);

      // find the director in the crew credits
      function getObjects(obj, key, val) {
          var objects = [];
          for (var i in obj) {
              if (!obj.hasOwnProperty(i)) continue;
              if (typeof obj[i] == 'object') {
                  objects = objects.concat(getObjects(obj[i], key, val));
              } else if (i == key && obj[key] == val) {
                  objects.push(obj);
              }
          }
          return objects;
      }

      director = getObjects(director, 'job', 'Director');

      for(i = 0; i < firstThree.length; ++i) {
        if (i+1 == firstThree.length){
          actorIds += firstThree[i].id;
        } else {
          actorIds += firstThree[i].id + ', ';
        }
      }

    }, errorCB);
  }
  
  function initControls(){
    
  }
  
});