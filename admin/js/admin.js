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
      categories, movieData, movieId, movieName, posterPath, posterUrl, overview, releaseDate, poster, posterBackdropUrl, posterBackdrop,
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
      var length = $.parseJSON(data).total_results;
      
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
    
  }
});