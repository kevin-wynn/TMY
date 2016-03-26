$(document).ready(function(){
  // get chart dates
  $.ajax({
    type: "GET",
    url: "php/dashCharts.php",             
    dataType: "json",                
    success: function(result) {
      var moviesContainer = $('#moviesContainer');
      var usersContainer = $('#usersContainer');
      
      var movies = result[0].movies;
      var recent_movies = result[1].recent_movies;
      var users = result[2].users;
      var last_login = result[3].last_login;
      
      $('#totalMovies').append(movies);
      $('#recentMoviesChart').append(recent_movies);
      $('#totalUsers').append(users);
      $('#activeUsers').append(last_login);
      
    var userData = [
        {
          value: last_login,
          color:"#59ABE3",
          highlight: "#22A7F0",
          label: "Active Users"
        },
        {
          value : users-last_login,
          color : "#03A678",
          highlight: "#019875",
          label: "Inactive Users"
        }
      ];

      var userChart = new Chart(document.getElementById("users").getContext("2d")).Doughnut(userData,{
        percentageInnerCutout : 50,
        animation : false
      });
      
      var movieData = [
          {
            value: recent_movies,
            color:"#EB9532",
            highlight: "#E87E04",
            label: "Recent Movies"
          },
          {
            value : movies-recent_movies,
            color : "#EF4836",
            highlight: "#C0392B",
            label: "Existing Movies"
          }
        ];

      var movieChart = new Chart(document.getElementById("movies").getContext("2d")).Doughnut(movieData,{
        percentageInnerCutout : 50,
        animation : false
      });
      
    }
  });
  
});