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
    var movies_total = $("[id=movie]"),
        getSameAmount = movies_total.length;
    
    $.ajax({
      type: "GET",
      url: "php/allReleased.php",             
      dataType: "json",   
      data: {getSameAmount:getSameAmount},
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

          var genres_forID = genres_recent.replace(/,/g, ""),
              genres_forID = genres_forID.toLowerCase();
          // build out html for injection
          poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
          title_recent = '<h2 id="movie_title">'+title_recent+'</h2>';
          genres_recent = '<p id="genres">'+genres_recent+'</p>';
          overview_recent = '<p>'+overview_recent+'</p>';
          director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
          score_recentContainer = '<div class="score">';

          score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 

          // inject html into container
          $('#recentMovies').append('<div class="col-sm-3 recent-item '+genres_forID+'" id="movie">'+poster_recent+'<div class="col-md-10 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-2 score-container">'+score_recentContainer+'</div></div>');
        }
        
        initControls();
      }
    });
  });
  
  $('#sortReviewed').on('click', function(){
    var movies_total = $("[id=movie]"),
        getSameAmount = movies_total.length;
    
    $.ajax({
      type: "GET",
      url: "php/allSortReviewed.php",             
      dataType: "json",
      data: {getSameAmount:getSameAmount},
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

          var genres_forID = genres_recent.replace(/,/g, ""),
              genres_forID = genres_forID.toLowerCase();
          // build out html for injection
          poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
          title_recent = '<h2 id="movie_title">'+title_recent+'</h2>';
          genres_recent = '<p id="genres">'+genres_recent+'</p>';
          overview_recent = '<p>'+overview_recent+'</p>';
          director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
          score_recentContainer = '<div class="score">';

          score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 
          
          // inject html into container
          $('#recentMovies').append('<div class="col-sm-3 recent-item '+genres_forID+'" id="movie">'+poster_recent+'<div class="col-md-10 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-2 score-container">'+score_recentContainer+'</div></div>');
        }
        
        initControls();
      }
    });
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

          var genres_forID = genres_recent.replace(/,/g, ""),
              genres_forID = genres_forID.toLowerCase();
          // build out html for injection
          poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
          title_recent = '<h2 id="movie_title">'+title_recent+'</h2>';
          genres_recent = '<p id="genres">'+genres_recent+'</p>';
          overview_recent = '<p>'+overview_recent+'</p>';
          director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
          score_recentContainer = '<div class="score">';

          score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 

          // inject html into container
          $('#recentMovies').append('<div class="col-sm-3 recent-item '+genres_forID+'" id="movie">'+poster_recent+'<div class="col-md-10 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-2 score-container">'+score_recentContainer+'</div></div>');
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
          
          var genres_forID = genres_recent.replace(/,/g, ""),
              genres_forID = genres_forID.toLowerCase();
          // build out html for injection
          poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
          title_recent = '<h2 id="movie_title">'+title_recent+'</h2>';
          genres_recent = '<p id="genres">'+genres_recent+'</p>';
          overview_recent = '<p>'+overview_recent+'</p>';
          director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
          score_recentContainer = '<div class="score">';

          score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 
          
          // inject html into container
          $('#recentMovies').append('<div class="col-sm-3 recent-item '+genres_forID+'" id="movie">'+poster_recent+'<div class="col-md-10 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-2 score-container">'+score_recentContainer+'</div></div>');
        }
        
        initControls();
      }
    });
  });
});

function initControls() {
  var movie = $("[id=movie]"),
      movie_title, url;
  
    movie.on('click', function(){
      // get the h2 value that holds the movie title
      movie_title = $(this).find($('h2')).html();

      // if movie title has a space, replace it with a dash
      if(movie_title.indexOf(' ') != -1) {
        movie_title = movie_title.replace(' ', '-');
      }

      // make sure its lowercase
      movie_title = movie_title.toLowerCase();

      // prepend location to url
      url = prefixUrl+'/movies/'+movie_title;

      // redirect
      window.location.href = url;
    });
}

function buildCategories() {
  var genres, arr, category, currentGenres,
      filterItems = $('#filterItems'),
      filterAction = $('#filterAction');
  
  filterItems.hide();
  
  filterItems.on('click', function(event){
    if(event.target.id == '#ScienceFiction'){
      event.target.id = '#Science Fiction';
    }
    category = event.target.id.substring(1);
    category = category.toLowerCase();
    filterItems.slideToggle();
    
    // category selected
    console.log(category.toLowerCase());
    
    // filter here
    
    $('#recentMovies').isotope({ filter: '.'+category });
    
    var categoriesSelected = $('*[data-genre="thriller"]');
    
    $('[id=movie]').filter(function() {
      var divs = $(this).data('genre', category)[0];
      console.log(divs.getAttribute(category));
    });
      
  });
  
  filterAction.on('click', function(){
    genres = $('#genres').html();
    filterItems.slideToggle();
    arr = $.unique(genres.split(' '));
    buildFilters(arr);
  });
}

function buildFilters(genres) {
  var filterItems = $('#filterItems');
  filterItems.html('');
  for(i=0; i<genres.length; i++){
    filterItems.append('<li id="' + genres[i] + '">' + genres[i] + '</li>');
  }
}

// init filters
buildCategories();