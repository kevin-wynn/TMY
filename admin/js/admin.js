$(document).ready(function(){
  var key = '&api_key=ff47119f9629ccfa68c832ccc6b470ef',
      url = 'http://api.themoviedb.org/3/',
      movie = 'search/movie?query=',
      allGenres = '',
      actorIds = '',
      searchBox = $('#searchBox'),
      resultsContainer = $('#resultsContainer'),
      movieDetails = $('#movieDetails'),
      movie_title = $('[name=movie_title]'),
      moviedb_id = $('[name=moviedb_id]'),
      movieOverview = $('[name=overview]'),
      movieDirector = $('[name=director]'),
      moviePoster = $('[name=poster_path]'),
      movieBackdrop = $('[name=backdrop_path]'),
      movieReleaseDate = $('[name=release_date]'),
      moviePublishDate = $('[name=publish_date]'),
      movieGenres = $('[name=genre]'),
      moviePopularVote = $('[name=popular_vote]'),
      movieActorIds = $('[name=cast]'),
      movieTrailer = $('[name=trailer]'),
      movieBackdrop2 = $('[name=backdrop2_path]'),
      movieBackdrop3 = $('[name=backdrop3_path]'),
      moviePoster2 = $('[name=poster2_path]'),
      categories, movieData, movieId, movieName, posterPath, posterUrl, overview, releaseDate, poster, posterBackdropUrl, posterBackdrop, posterBackdrop2Url, posterBackdrop3Url, poster2Url,
      posterSize, baseUrl, title, cast, firstThree, director, genreId, genres, popularVote;
  
  // define success and error callback functions
  function successCB(data) { console.log("Success callback: " + data); }
  function errorCB(data) { console.log("Error callback: " + data); }
  
  // get config from tMDB
  theMovieDb.configurations.getConfiguration(getConfig, errorCB);
  function getConfig(data) {
    posterSize = $.parseJSON(data).images.poster_sizes;
    baseUrl = $.parseJSON(data).images.base_url.slice(0,-1);
  }
  
  //set up rating stars
  $('.rating').raty({
    starType: 'i',
    number: 5,
    hints: ['','','','',''],
  });
  
  // get value from search on enter press
  searchBox.keypress(function(e) {
    if(e.which == 13) {
      getResults();
    }
  });
  
  // get results and build out all posters
  function getResults() {
    var searchResult = searchBox.val();

    theMovieDb.search.getMovie({"query":searchResult}, function(data){
      resultsContainer.html('');
      $('.submit-error').html('');
      
      var length = $.parseJSON(data).total_results;
      
      // error handling for 0 results
      if (length === 0 ) {
        resultsContainer.html("<span class='no-results'>Sorry. We couldn't find any results for this search, try again.</span>");
      }
      
      // FOR NOW TEMPORARY FIX JUST LIMIT TO ONE PAGE
      if (length > 20) {
        length = 20;
      }
      // TODO: need to make this paginate or infinite scroll multiple pages
      //       20 results per page
      //       console.log(data);
      //       console.log(length);
      for(i=0; i < length; ++i) {
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

        if (posterPath !== null && categories !== '') {
          resultsContainer.append('<div id="posterContainer" class="col-md-12" data-movieId="' + movieId + '"><div class="col-md-3 poster-item">' +
          '<img id="posterUrlContainer" src=' + posterUrl + '/></div>' +
          '<div class="poster-text col-md-9"><h2 data-title="' + movieName + '">' + movieName + '</h2><p data-release-date="' + releaseDate + '">' + releaseDate + ' - ' + movieId + '</p>' +
          '<p data-categories="' + categories + '">' + categories + '</p><p id="overview" data-overview="' + overview + '">' + overview + '</p>' +
          '<div id="actorContainer"></div>' + '<div id="saveContainer"></div>' +
          '</div><div id="backdropContainer" data-backdrop="' + posterBackdropUrl + '"></div></div>');
        } else {
          resultsContainer.append('<div id="posterContainer"><div class="col-md-3 poster-item"><div class="no-image-found">No Image Found</div></div></div>');
        }
        
      }
      var posterContainer = $("[id=posterContainer]");
      posterContainer.on('click', function(){
        posterContainer.not(this).each(function(){
          $(this).hide();
        });
        movieId = $(this).data('movieid');
        getSelected(movieId);
      });
    }, errorCB);
  }
  
  // build movie data into form fields
  function getSelected(movieId){
    
    // show review writer and stars
    $('.review').fadeIn();
    
    theMovieDb.movies.getById({"id":movieId}, function(data){
      title = $.parseJSON(data).title;
      overview = $.parseJSON(data).overview;
      posterPath = $.parseJSON(data).poster_path;
      posterUrl = baseUrl + '/w500' + posterPath;
      posterBackdrop = $.parseJSON(data).backdrop_path;
      posterBackdropUrl = baseUrl + '/original' + posterBackdrop;
      releaseDate = $.parseJSON(data).release_date;
      genres = $.parseJSON(data).genres;
      popularVote = $.parseJSON(data).vote_average;
      
      // get current date for publish_date
      var d = new Date();

      var month = d.getMonth()+1;
      var day = d.getDate();
      var time = d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();

      var currentDate = d.getFullYear() + '-' +
          (month<10 ? '0' : '') + month + '-' +
          (day<10 ? '0' : '') + day + ' ' + time;
      
      // build genre listing
      theMovieDb.genres.getList({}, function(data){},errorCB);
      
      for (i = 0; i < genres.length; ++i) {
        if (i+1 == genres.length){
          allGenres += genres[i].name;
        } else {
          allGenres += genres[i].name + ', ';
        }
      }
      
      moviedb_id.val(movieId);
      movie_title.val(title);
      movieOverview.val(overview);
      moviePoster.val(posterUrl);
      movieBackdrop.val(posterBackdropUrl);
      movieReleaseDate.val(releaseDate);
      moviePublishDate.val(currentDate);
      movieGenres.val(allGenres);
      moviePopularVote.val(popularVote);
      
    },errorCB);
    
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
      
      movieDirector.val(director[0].name);
      
      for(i = 0; i < firstThree.length; ++i) {
        if (i+1 == firstThree.length){
          actorIds += firstThree[i].id;
        } else {
          actorIds += firstThree[i].id + ', ';
        }
      }
      
      movieActorIds.val(actorIds);
      
    }, errorCB);
    
    // get trailers for movie
    theMovieDb.movies.getTrailers({"id":movieId}, function(data){
      var youtubePrefix = 'https://www.youtube.com/embed/',
          youtubeTrailer = $.parseJSON(data).youtube;
      if(youtubeTrailer===''){
        alert('no trailers for this movie');
      } else {
        youtubeTrailer = youtubeTrailer[0].source;
        youtubeTrailer = youtubePrefix+youtubeTrailer;
        movieTrailer.val(youtubeTrailer);
      }
    }, errorCB);
    
    // get extra backdrops and posters
    theMovieDb.movies.getImages({"id":movieId }, function(data){
      var backdropPathComplete, postersPathComplete,
          backdrops = $.parseJSON(data).backdrops;
      resultsContainer.append('<div class="col-md-12 backdrop-selection"><h5 class="image-header">Backdrops:</h5></div>');
      resultsContainer.append('<div class="col-md-12 poster-selection"><h5 class="image-header">Posters:</h5></div>');
      
      if (backdrops.length > 18){
        for (i=0; i<18; i++){
          backdropPathComplete = baseUrl + '/original' + backdrops[i].file_path;

          $('.backdrop-selection').append('<div class="col-md-2 select-image backdrop" id="backdropSelection"><img src="'+backdropPathComplete+'"/></div>');
        }
      } else {
        for (i=0; i<backdrops.length; i++){
          backdropPathComplete = baseUrl + '/original' + backdrops[i].file_path;

          $('.backdrop-selection').append('<div class="col-md-2 select-image backdrop" id="backdropSelection"><img src="'+backdropPathComplete+'"/></div>');
        }
      }
      
      var posters = $.parseJSON(data).posters;
      
      if (posters.length > 6) {
        for (i=0; i<6; i++){
          postersPathComplete = baseUrl + '/w500' + posters[i].file_path;    
          $('.poster-selection').append('<div class="col-md-2 select-image poster" id="posterSelection"><img src="'+postersPathComplete+'"/></div>');
        }
      } else {
        for (i=0; i<posters.length; i++){
          postersPathComplete = baseUrl + '/w500' + posters[i].file_path;    
          $('.poster-selection').append('<div class="col-md-2 select-image poster" id="posterSelection"><img src="'+postersPathComplete+'"/></div>');
        }
      }
      
      initSelectImageControls();
      
    }, errorCB);
    
    function initSelectImageControls(){
      $('.select-image').unbind().on('click', function(){
        
        var posters = $('.poster.selected'),
            backdrops = $('.backdrop.selected');
        
        if ($(this).hasClass('backdrop')){
          if(backdrops.length < 3){
            if ($(this).hasClass('selected')) {
              $(this).removeClass('selected');
            } else {
              $(this).addClass('selected');
              console.log($(this).find('img').attr("src"));
            }
          }  
        } else if ($(this).hasClass('poster')){
          if(posters.length < 2){
            if ($(this).hasClass('selected')) {
              $(this).removeClass('selected');
            } else {
              $(this).addClass('selected');
            }
          }
        } else {
          console.log('what happened');
        }

      });
    }
    
    // do some work before submitting to get images ready and check validation stuff
    $('.review').submit(function(e){
      e.preventDefault();
      
      var poster = $('.poster.selected'),
          backdrop = $('.backdrop.selected'),
          count;
      
      for (i=0; i<poster.length; i++){
        if(poster.length === 1){
          moviePoster.val(poster[0].getElementsByTagName('img')[0].src);          
        } else if (poster.length === 2){
          moviePoster.val(poster[0].getElementsByTagName('img')[0].src);          
          moviePoster2.val(poster[1].getElementsByTagName('img')[0].src);          
        }
      }
      
      console.log(backdrop);
      
      for (i=0; i<backdrop.length; i++){
        if(backdrop.length === 1){
          movieBackdrop.val(backdrop[0].getElementsByTagName('img')[0].src); 
        } else if (backdrop.length === 2){
          movieBackdrop.val(backdrop[0].getElementsByTagName('img')[0].src);
          movieBackdrop2.val(backdrop[1].getElementsByTagName('img')[0].src);
        } else if (backdrop.length === 3){
          movieBackdrop.val(backdrop[0].getElementsByTagName('img')[0].src);          
          movieBackdrop2.val(backdrop[1].getElementsByTagName('img')[0].src);          
          movieBackdrop3.val(backdrop[2].getElementsByTagName('img')[0].src);          
        }
      }
      
      var empties = $('input:hidden').filter(function() { return $(this).val() === ""; });
      
      empties.attr('disabled', true);
      
      $.ajax({
        type: "GET",
        url: "php/checkExisting.php", 
        data: {movieId:movieId},
        dataType: "json",
        success: function(result) {
          if (result.length > 0){
            moviedb_id = result[0].moviedb_id;
            $('.submit-error').html("You've already reviewed this movie. <div class='update-movie'>Update?</div>");
            $('.update-movie').on('click', function(){
              var formData = $('.review').serialize();
              $.ajax({
                type: "POST",
                url: "includes/update-review.php",
                data: formData,
                dataType: "json",
                success: function(response) {
                  console.log('response');
                }
              });
            });
          } else {
            $('.review').unbind().submit();
          }
        }
      });
    });
    
  }
});