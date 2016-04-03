var prefixUrl = window.location.pathname.slice(0, -1);
    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));
    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));

function errorCB(data){
  console.log('error');
}

$(document).ready(function(){
  var heroImage = $('#heroImage'),
      movieTitle = $('#movieTitle'),
      movieOverview = $('#movieOverview'),
      movieGenres = $('#movieGenres'),
      movieScore = $('#movieScore'),
      movieDirector = $('#movieDirector'),
      movieCast = $('#movieCast'),
      movieTrailer = $('#movieTrailer'),
      wave = 0;
  
  movieTrailer.fitVids();
  
  var getUrlParameter = function getUrlParameter(sParam) {
      var sPageURL = decodeURIComponent(window.location.search.substring(1)),
          sURLVariables = sPageURL.split('&'),
          sParameterName,
          i;

      for (i = 0; i < sURLVariables.length; i++) {
          sParameterName = sURLVariables[i].split('=');

          if (sParameterName[0] === sParam) {
              return sParameterName[1] === undefined ? true : sParameterName[1];
          }
      }
  };
  
  var movieId = getUrlParameter('movie_id');
  
  console.log(movieId);
  
  // FEATURED HERO IMAGE
  $.ajax({
    type: "GET",
    url: "../php/pageDetails.php",  
    data: {movie_id:movieId},
    dataType: "json",                
    success: function(result) {
      var backdrop = prefixUrl + result[0].backdrop_path,
          title = result[0].movie_title,
          genres = result[0].genre,
          overview = result[0].overview,
          score = result[0].score,
          director = result[0].director,
          cast = result[0].cast,
          review = result[0].review,
          trailer = result[0].trailer,
          poster2 = result[0].poster2_path,
          backdrop2_path = result[0].backdrop2_path,
          backdrop3_path = result[0].backdrop3_path,
          wave = 0;
      
          for(i=0; i<score; i++){
            movieScore.append('<i class="fa fa-star"></i> ');
          }

          cast = cast.replace(/ /g,'');
          cast = cast.split(',');
          movieCast.html('<span class="intro-text">Starring - </span>');
          for(i=0; i<cast.length; i++){
            theMovieDb.people.getById({"id":cast[i]}, parseCast, errorCB);
          }

          function parseCast(data){
              var name = $.parseJSON(data).name;
              if(wave == cast.length) {
                movieCast.append(name);
              } else {
                movieCast.append(name + ', ');
              }
          }
      
      review = review.replace(/(?:\r\n|\r|\n)/g, '<br/>');
      
      Array.prototype.clean = function(deleteValue) {
        for (var i = 0; i < this.length; i++) {
          if (this[i] == deleteValue) {         
            this.splice(i, 1);
            i--;
          }
        }
        return this;
      };
      
      review = review.split('<br/>');
      
      console.log(review.clean(""));
      
      trailer = '<div id="movieTrailer" class="trailer-container"><iframe src="'+trailer+'modestbranding=1;controls=0;showinfo=0;rel=0;fs=1" frameborder="0" allowfullscreen></iframe></div>';
      
      backdrop2_path = '<img src="..'+backdrop2_path+'">';
      backdrop3_path = '<img src="..'+backdrop3_path+'">';
      
      var pageContent = $('#pageContent');
      
      pageContent.append('<div class="col-md-6 interior-image">'+backdrop2_path+'</div>');
      pageContent.append('<div class="col-md-6 interior-image">'+backdrop3_path+'</div>');
      
      for(i=0; i<review.length; i++) {
        pageContent.append('<div class="col-md-12">'+review[i]+'<br><br></div>');  
      }
      pageContent.append('<div class="col-md-12">'+trailer+'</div>');
      
      $('#movieTrailer').fitVids();
    }
  });
  
});

function buildPage(score, review, cast){
//  console.log(review);
}