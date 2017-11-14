$(document).ready(function(){
  function cleanArray(actual) {
    var newArray = [];
    for (var i = 0; i < actual.length; i++) {
      if (actual[i]) {
        newArray.push(actual[i]);
      }
    }
    return newArray;
  }
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

      var userChart;

      if(document.getElementById("users")) {
        userChart = new Chart(document.getElementById("users").getContext("2d")).Doughnut(userData,{
          percentageInnerCutout : 50,
          animation : false
        });
      }

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

      var movieChart;
      if(document.getElementById("movies")) {
        movieChart = new Chart(document.getElementById("movies").getContext("2d")).Doughnut(movieData,{
          percentageInnerCutout : 50,
          animation : false
        });
      }
    }
  });

  $.ajax({
    type: "GET",
    url: "php/getGenreCount.php",
    dataType: "json",
    success: function(result) {
      var genreTitles = "",
      genreCount = "";

      $.each(result, function(i, data) {
        for ( var property in data ) {
          genreTitles += property + ',';
        }
        for( var key in data) {
            if(data.hasOwnProperty(key)) {
                genreCount += data[key] + ',';
            }
        }
      });

      genreTitles = genreTitles.split(',');
      genreCount = genreCount.split(',');

      var genreData = {
        labels: genreTitles,
        datasets: [
          {
            label: "Genres",
            fillColor: "rgba(155, 89, 182, 0.8)",
            strokeColor: "rgba(145, 61, 136, 0.8)",
            highlightFill: "rgba(154, 18, 179 ,0.8)",
            highlightStroke: "rgba(145, 61, 136, 0.8)",
            data: genreCount,
          }
        ]
      };

      var genreChart;
      if(document.getElementById("genres")) {
        genreChart = new Chart(document.getElementById("genres").getContext("2d")).Bar(genreData, {
          percentageInnerCutout : 50,
          animation : false
        });
      }
    }
  });
});
