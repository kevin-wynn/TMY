var prefixUrl = window.location.pathname;

    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));
    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));

function errorCB(data){
  console.log('error');
}

$(document).ready(function() {
  var usersContainer = $('#usersContainer');
  
  function getUsers(){
    var header, emailContainer, userContainer;
    usersContainer.empty();
    
    $.ajax({
      type: "GET",
      url: "php/userProfile.php",             
      dataType: "json",
      data: {id:id},
      success: function(result) {
        for(i=0; i<result.length; i++){
          var user_id = result[i].user_id,
              username = result[i].username,
              email = result[i].email,
              permissions = result[i].permissions;
              f_name = result[i].f_name;
              l_name = result[i].l_name;
              last_login = result[i].last_login;
              url_slug = result[i].url_slug;
        }
        console.log(result);
        
        header = $('#profile').html(f_name + ' ' + l_name);
        emailContainer = $('#profile').append('<span class="email">'+email+'</span>');
        userContainer = $('#user').html('<span class="userdeets">'+last_login+'</span>');
        userContainer = userContainer.append('<span class="userdeets">'+url_slug+'</span>');
        
        initControls();
      }
    });
  }
  
  getUsers();
  
  function initControls(){
    $('#headshot').on('click', function(){
      
    });
  }
  
});