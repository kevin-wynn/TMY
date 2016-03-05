var prefixUrl = window.location.pathname;

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
    url: "php/adminReviewed.php",             
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
        
        if (featured_recent){featured_recent = 'featured'} else {featured_recent = ''}
        
        poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
        title_recent = '<h2>'+title_recent+'</h2>';
        genres_recent = '<p>'+genres_recent+'</p>';
        overview_recent = '<p>'+overview_recent+'</p>';
        director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
        score_recentContainer = '<div class="score">';
        
        score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 
        
        $('#recentMovies').append('<div class="col-sm-3 recent-item '+ featured_recent +'">'+poster_recent+'<div class="col-md-10 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-2 score-container">'+score_recentContainer+'</div><div class="featured-text">'+featured_recent+'</div></div>');
      }
      initControls();
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
      url: "php/adminReleased.php",             
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
              featured_recent = result[i].featured,
              score_recentContainer;
          
          if (featured_recent){featured_recent = 'featured'} else {featured_recent = ''}

          poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
          title_recent = '<h2>'+title_recent+'</h2>';
          genres_recent = '<p>'+genres_recent+'</p>';
          overview_recent = '<p>'+overview_recent+'</p>';
          director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
          score_recentContainer = '<div class="score">';

          score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 

          $('#recentMovies').append('<div class="col-sm-3 recent-item '+ featured_recent +'">'+poster_recent+'<div class="col-md-10 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-2 score-container">'+score_recentContainer+'</div><div class="featured-text">'+featured_recent+'</div></div>');
        }
      }
    });
  });
  
  $('#sortReviewed').on('click', function(){
    $.ajax({
      type: "GET",
      url: "php/adminReviewed.php",             
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
              featured_recent = result[i].featured,
              score_recentContainer;
          
          if (featured_recent){featured_recent = 'featured'} else {featured_recent = ''}

          poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
          title_recent = '<h2>'+title_recent+'</h2>';
          genres_recent = '<p>'+genres_recent+'</p>';
          overview_recent = '<p>'+overview_recent+'</p>';
          director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
          score_recentContainer = '<div class="score">';

          score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 

          $('#recentMovies').append('<div class="col-sm-3 recent-item '+ featured_recent +'">'+poster_recent+'<div class="col-md-10 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-2 score-container">'+score_recentContainer+'</div><div class="featured-text">'+featured_recent+'</div></div>');
        }
      }
    });
  });
});

function initControls(){
  $('.recent-item').on('click', function(){
      $('.recent-item').not(this).each(function(){
        $(this).removeClass('featured');
        $(this).find($('.featured-text')).html('');
      });
    
      $(this).addClass('featured');
      $(this).find($('.featured-text')).html('featured');
    
      var movieTitle = $(this).find($('.info h2')).html();
    
      $('[name=movie_title]').val(movieTitle);
    
      $('[name=submit]').trigger('click');
  });
};