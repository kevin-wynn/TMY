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
            f_name = result[i].f_name;
            l_name = result[i].l_name;
            last_login = result[i].last_login;
            url_slug = result[i].url_slug;
        
        if(permissions == 100){
          permissions = 'user';
        } else if (permissions == 200) {
          permissions = 'admin';
        } else if (permissions == 300) {
          permissions = 'superAdmin'
        }
        
        usersContainer.append('<div id="row" class="row"><div id="edit" class="col-md-1"><i class="fa fa-pencil"></i></div><div class="col-md-1 first user">'+f_name+'</div><div class="col-md-1 last user">'+l_name+'</div><div class="col-md-1 user-id user">'+user_id+'</div><div class="col-md-3 username user">'+username+'</div><div class="col-md-2 url user">'+url_slug+'</div><div id="permissionsToggle" class="col-md-2 permissions user">'+permissions+'</div><div class="col-md-1 date user">'+last_login+'</div><div class="col-md-12 user-details"></div></div>');
      }
      initControls();
    }
  });
});

function initControls(){
  // get the row
  $('[id=row]').on('click', function(){
    var userId = $(this).find('.user-id').html(),
        firstName = $(this).find('.first').html(),
        lastName = $(this).find('.last').html(),
        email = $(this).find('.username').html(),
        url = $(this).find('.url').html();
        permissions = $(this).find('.permissions').html();
    
    if ($(this).find('.user-details').is(':visible')){
      console.log('hello please submit or hit cancel thats what its there for');
    } else {
      $(this).find('.user-details').slideDown();
    }
    
    $(this).find('.user-details').html('<h3>'+firstName+' '+lastName+' <span class="email-small">'+email+'</span></h3>'+
                                        '<div class="col-md-3 editing"><p>First:</p><input name="f_name" value='+firstName+'></div>'+
                                        '<div class="col-md-3 editing"><p>Last:</p><input name="l_name" value='+lastName+'></div>'+
                                        '<div class="col-md-4 editing"><p>URL:</p><input name="url" value="'+url+'"></div>'+
                                        '<div class="col-md-2 editing"><p>Level:</p><input name="permissions" value='+permissions+'></div>'+
                                        '<div class="col-md-12"><input class="login-submit" type="submit" value="Save" /></div>');
     
    console.log('user-id: ', userId);
    console.log('firstName: ', firstName);
    console.log('lastName: ', lastName);
    console.log('permissions: ', permissions);
  })
};