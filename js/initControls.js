// sets up interation with clicking a movie poster - redirects them to /movies/clicked
function initControls(){
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