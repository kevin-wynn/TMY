// sets up interation with clicking a movie poster - redirects them to /movies/clicked
function initControls(){
  var movie = $("[id=movie]"),
      movie_title, url, movie_id;
  
    movie.on('click', function(){
    // get the h2 value that holds the movie title
    movie_title = $(this).find($('h2')).html();
      
    movie_id = $(this).data('movie-id');
      
    console.log(movie_id);
    
    // if movie title has a space, replace it with a dash
    if(movie_title.indexOf(' ') != -1) {
      movie_title = movie_title.replace(' ', '-');
    }
    
    // make sure its lowercase
    movie_title = movie_title.toLowerCase();
    
    // prepend location to url
    url = prefixUrl+'/movies/'+movie_title+'?movie_id='+movie_id;
      
    // redirect
    window.location.href = url;
      
  });
  
  $('.discover-help').unbind().on('click', function(){
    $('#discoverTooltip').slideToggle();
  });
  
  $('.nowplaying-help').unbind().on('click', function(){
    $('#nowplayingTooltip').slideToggle();
  });
}