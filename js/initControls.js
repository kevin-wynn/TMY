// sets up interation with clicking a movie poster - redirects them to /movies/clicked
function initControls(){  
  $('.discover-help').unbind().on('click', function(){
    $('#discoverTooltip').slideToggle();
  });
  
  $('.nowplaying-help').unbind().on('click', function(){
    $('#nowplayingTooltip').slideToggle();
  });
}