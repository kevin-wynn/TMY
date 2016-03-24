var prefixUrl = window.location.pathname;

    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));
    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));

$(document).ready(function(){
  
    // get most recently reviewed movie
    $.ajax({
    type: "GET",
    url: "php/adminDashboard.php",             
    dataType: "json",                
    success: function(result) {
      for(i=0; i<result.length; i++){
        var poster_recent = prefixUrl + result[i].poster_path,
            title_recent = result[i].movie_title,
            genres_recent = result[i].genre,
            overview_recent = result[i].overview,
            score_recent = result[i].score,
            director_recent = result[i].director,
            featured_recent = result[i].featured,
            score_recentContainer;
        
        poster_recent = '<div class="poster"><img src="'+poster_recent+'"/></div>';
        title_recent = '<h2>'+title_recent+'</h2>';
        genres_recent = '<p>'+genres_recent+'</p>';
        overview_recent = '<p>'+overview_recent+'</p>';
        director_recent = '<p><span class="intro-text">Directed By - </span>'+director_recent+'</p>';
        score_recentContainer = '<div class="score">';
        
        score_recentContainer += '<i class="fa fa-star"><span class="rating-number">'+score_recent+'</span></i></div>'; 
        
        $('#recentMovies').append('<div class="recent-item">'+poster_recent+'<div class="col-md-10 info">'+title_recent+genres_recent+director_recent+'</div><div class="col-md-2 score-container">'+score_recentContainer+'</div></div>');
      }
    }
  });
  
  // get list of all users
    $.ajax({
    type: "GET",
    url: "php/adminUsers.php",             
    dataType: "json",                
    success: function(result) {
      for(i=0; i<result.length; i++){
        var user_id = result[i].user_id,
            username = result[i].username,
            email = result[i].email,
            permissions = result[i].permissions,
            signup = result[i].signup_date;
        
        if(permissions == 100){
          permissions = 'user';
        } else if (permissions == 200) {
          permissions = 'admin';
        } else if (permissions == 300) {
          permissions = 'super admin'
        }
        
        $('#users').append('<div class="col-md-1 user-id user">'+user_id+'</div><div class="col-md-4 username user">'+username+'</div><div class="col-md-3 email user">'+email+'</div><div class="col-md-2 permissions user">'+permissions+'</div><div class="col-md-2 signup user">'+signup+'</div>');
      }
    }
  });
  
  var ctx = $("#moviesAdded").get(0).getContext("2d"),
      dates = [];
  
  // get chart dates
  $.ajax({
    type: "GET",
    url: "php/dashDates.php",             
    dataType: "json",                
    success: function(result) {
      for(i=0; i<result.length; i++){
        var publish_date = result[i].publish_date;
        dates.push(publish_date);
      }
      console.log(dates);
      
      var chartData = dates,
          counts = {};

      $.each(chartData, function(key,value) {
        if (!counts.hasOwnProperty(value)) {
          counts[value] = 1;
        } else {
          counts[value]++;
        }
      });
      
      console.log(counts);

      var chartDates = [];
      for ( property in counts ) {
        chartDates.push(property);
        console.log(chartDates);
      }
      
      var chartData = [0];
      $.each(counts, function(key, element) {
        chartData.push(element);
        console.log(chartData);
      });
      
      var data = {
          labels: chartDates,
          datasets: [
              {
                  label: "My First dataset",
                  fillColor: "rgba(89,171,227,.2)",
                  strokeColor: "#59ABE3",
                  pointColor: "#59ABE3",
                  pointStrokeColor: "#fff",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(220,220,220,1)",
                  data: chartData
              }
          ]
      };
      
      // This will get the first returned node in the jQuery collection.
      var myLineChart = new Chart(ctx).Line(data, {
        bezierCurve: true,
        scaleShowGridLines: false
      });
    }
  });
  
});