//var filterItems = $('#filterItems');

$(document).ready(function(){
  var sortItems = $('#sortItems'),
      sortAction = $('#sortAction'),
      recentMovies = $('#recentMovies'),
      discover = $('#discover'),
      nowplaying = $('#nowplaying');
  
  recentMovies.isotope({
    itemSelector: '#movie',
    getSortData: {
      published: '[data-published]',
      released: '[data-released]',
      category: '[data-category]'
    },
    percentPosition: true,
    masonry: {
      // use element for option
      columnWidth: '.recent-item'
    }
  });
  
  discover.isotope({
    itemSelector: '#discovery',
    percentPosition: true,
    masonry: {
      // use element for option
      columnWidth: '.recent-item'
    }
  });
  
  nowplaying.isotope({
    itemSelector: '#nowplaying',
    percentPosition: true,
    masonry: {
      // use element for option
      columnWidth: '.recent-item'
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
  
//  filterAction.on('click', function(){
//    filterItems.slideToggle();
//  });
  
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
  
//  filterItems.on('click', function(){
//    recentMovies.isotope({
//      sortBy : 'category',
//      sortAscending: false
//    });
//  });
});

//function buildFilters(filters) {
//  console.log(filters);
//  filterItems.html('<li id="#all">#all</li>');
//  
//  for(i=0; i<filters.length; i++){
//    console.log(filters[i]);
//    filterItems.append('<li id="' + filters[i] + '">' + filters[i] + '</li>');
//  }
//  
//}