var prefixUrl = window.location.pathname;

    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));
    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));

function errorCB(data){
  console.log('error');
}

$(document).ready(function() {
  var usersContainer = $('#usersContainer');
  
  $.ajax({
    type: "GET",
    url: "php/adminUsers.php",             
    dataType: "json",                
    success: function(result) {
      for(i=0; i<result.length; i++){
        var user_id = result[i].user_id,
            username = result[i].username,
            email = result[i].email,
            permissions = result[i].permissions;
        
        if(permissions == 100){
          permissions = 'user';
        } else if (permissions == 200) {
          permissions = 'admin';
        } else if (permissions == 300) {
          permissions = 'superAdmin'
        }
        
        usersContainer.append('<div id="row" class="row"><div id="edit" class="col-md-1"><i class="fa fa-pencil"></i></div><div class="col-md-1 user-id user">'+user_id+'</div><div class="col-md-4 username user">'+username+'</div><div class="col-md-4 email user">'+email+'</div><div id="permissionsToggle" class="col-md-2 permissions user">'+permissions+'</div></div>');
      }
      initControls();
    }
  });
});

function initControls(){
  
};