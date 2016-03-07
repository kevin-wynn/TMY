var permissionLevel;

$.ajax({
  type: "GET",
  url: "php/permissions.php",             
  dataType: "json",                
  success: function(result) {
    for(i=0; i<result.length; i++){
      permissionLevel = result[i].permissions;
      console.log(permissionLevel);
      buildNavigation();
    }
  }
});

function buildNavigation(){
  var dashboard = $('#sidebar-dashboard'),
      movies = $('#sidebar-movies'),
      writer = $('#sidebar-writer'),
      rating = $('#sidebar-rating'),
      users = $('#sidebar-users');
  
  dashboard.hide();
  movies.hide();
  writer.hide();
  rating.hide();
  users.hide();
  
  // user
  if(permissionLevel == 100) {
    dashboard.show();
    movies.show();
    rating.show();
    
  // admin
  } else if(permissionLevel == 200) {
    dashboard.show();
    movies.show();
    writer.show();
    
  // super admin
  } else if(permissionLevel == 300) {
    dashboard.show();
    movies.show();
    writer.show();
    users.show();
  }
}