var prefixUrl = window.location.pathname;

    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));
    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));

var offset = 0, limit = 10, total = 0;

function errorCB(data){
  console.log('error');
}

$(document).ready(function() {
  var movieTitle = $('#movieTitle'),
      movieOverview = $('#movieOverview'),
      movieGenres = $('#movieGenres'),
      movieScore = $('#movieScore'),
      movieDirector = $('#movieDirector'),
      movieCast = $('#movieCast'),
      wave = 0;
  
  getMovies();
  
  var sortItems = $('#sortItems'),
      sortAction = $('#sortAction');
  
  sortItems.hide();
  
  sortAction.on('click', function(){
    sortItems.slideDown('slow');
  });
  
  sortItems.on('click', function(){
    sortItems.slideUp('slow');
  });
  
  //get inital movies and set up interaction with show more button to more more calls
  $('#getMore').on('click', function(){
    if(offset+10 > total){
      $('#getMore').hide();
    }
    getMovies();
  });

  function getMovies(){
    $.ajax({
      type: "GET",
      data: {offset:offset, limit:limit},
      url: "php/adminReviewed.php",             
      dataType: "json",                
      success: function(result) {
        offset += 8;
        total = result[0].total;
        for(i=0; i<result.length; i++){
          var poster_recent = prefixUrl + result[i].poster_path,
              title_recent = result[i].movie_title,
              genres_recent = result[i].genre,
              overview_recent = result[i].overview,
              score_recent = result[i].score,
              director_recent = result[i].director,
              publish_date = result[i].publish_date,
              release_date = result[i].release_date,
              featured_recent = result[i].featured,
              movie_id = result[i].movie_id,
              score_recentContainer;
              
              if (featured_recent){featured_recent = 'featured'} else {featured_recent = ''}

          var genres_forID = genres_recent.replace(/,/g, "");
              genres_forID = genres_forID.toLowerCase();

          poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
          title_recent = '<h2 id="movie_title">'+title_recent+'</h2>';
          genres_recent = '<p id="genres">'+genres_recent+'</p>';
          overview_recent = '<p>'+overview_recent+'</p>';
          director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
          score_recentContainer = '<div class="score">';
          score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 

          fullItems = $('<div data-id="'+movie_id+'" data-released="'+release_date+'" data-published="'+publish_date+'" class="recent-item '+genres_forID+' '+featured_recent+'" id="movie">'+poster_recent+'<div class="col-md-10 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-2 score-container">'+score_recentContainer+'</div><div class="featured-text"><i class="fa fa-bolt"></i></div></div>');

          $('#recentMovies').isotope('insert', fullItems ).isotope('layout');
        }
        initControls();
      }
    });
  }
  
  function initControls(){
    $('.recent-item').on('click', function(){
      
      var id = $(this).data('id'),
          clicked = $(this);
      
      $.ajax({
        type: "POST",
        data: {id:id},
        url: "php/db_featured.php",             
        dataType: "html",                
        success: function(result) {
          console.log(result);
          if (result) {
            $('.recent-item').not(this).each(function(){
              $(this).removeClass('featured');
              $(this).find($('.featured-text')).html('');
            });
            
            console.log(clicked);

            clicked.addClass('featured');
            clicked.find($('.featured-text')).html('<i class="fa fa-bolt"></i>');
          }
        }
      });
    });
  }
});