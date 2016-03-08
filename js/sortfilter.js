$(document).ready(function(){
  var sortItems = $('#sortItems'),
      sortAction = $('#sortAction');
  
  sortItems.hide();
  
  sortAction.on('click', function(){
    sortItems.slideToggle();
  });
  
  sortItems.on('click', function(){
    sortItems.slideToggle();
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
  
  $('#sortReviewed').on('click', function(){
    $.ajax({
      type: "GET",
      url: "php/homeReviewed.php",             
      dataType: "json",                
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
});

function initControls() {
  var filterAction = $('#filterAction'), genres;
  filterAction.on('click', function(){
    genres = $('#genres').html();
    genres = genres.split(' ');
    buildFilters(genres);
  });
}

function buildFilters(genres) {
  var filterItems = $('#filterItems');
  for(i=0; i<genres.length; i++){
    filterItems.append('<li id="' + genres[i] + '">' + genres[i] + '</li>');
  }
}