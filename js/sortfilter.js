$(document).ready(function(){
  var sortItems = $('#sortItems'),
      sortAction = $('#sortAction'),
      recentMovies = $('#recentMovies');
  
  recentMovies.isotope({
    itemSelector: '#movie',
    getSortData: {
      published: '[data-published]',
      released: '[data-released]'
    }
  });
  
  sortItems.hide();
  
  sortAction.on('click', function(){
    sortItems.slideToggle();
  });
  
  sortItems.on('click', function(){
    sortItems.slideToggle();
  });
  
  var genres, arr, category, currentGenres,
      filterItems = $('#filterItems'),
      filterAction = $('#filterAction');
  
  filterItems.hide();
  
  filterItems.on('click', function(event){
    var noFilterItems = $('#noFilterItems');
    noFilterItems.hide();
    
    if(event.target.id == '#ScienceFiction'){
      event.target.id = '#Science';
    }
    category = event.target.id.substring(1);
    category = category.toLowerCase();
    
    if (category == 'all'){
      category = '*';
    } else {
      category = '.' + category;
    }
    filterItems.slideToggle();  
    recentMovies.isotope({filter:category});
  });
  
  filterAction.on('click', function(){
    genres = $('#genres').html();
    filterItems.slideToggle();
    arr = $.unique(genres.split(' '));
    buildFilters(arr);
  });
  
  $('#sortReviewed').on('click', function(){        
    recentMovies.isotope({
      sortBy : 'published',
      sortAscending: false
    });
  });
  
  $('#sortReleased').on('click', function(){
    recentMovies.isotope({
      sortBy : 'released',
      sortAscending: false
    });
  });
  
  function buildFilters(genres) {
    var filterItems = $('#filterItems');
    filterItems.html('<li id="#all">#all</li>');
    for(i=0; i<genres.length; i++){
      filterItems.append('<li id="' + genres[i] + '">' + genres[i] + '</li>');
    }
  }
});