var prefixUrl = window.location.pathname;

    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));
    prefixUrl = prefixUrl.substr(0, prefixUrl.lastIndexOf("/"));

function errorCB(data){
  console.log('error');
}

$(document).ready(function() {
  var usersContainer = $('#usersContainer');
  
  function getUsers(){
    usersContainer.empty();
    
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
  }
  
  getUsers();
  
  $('.add-user').on('click', function(){
    addUserForm();
  });
  
  function addUserForm(){
    $('#usersContainer').find('.new-user').html('');
    
    $('#usersContainer').append('<div id="row adding" class="row"><div class="col-md-12 user-details new-user">'+
                                '<h3>New User:</span></h3>' +
                                '<form class="login-form" name="createUser" method="post">'+
                                '<div class="col-md-3 editing"><p>First:</p><input name="f_name" value=""></div>'+
                                '<div class="col-md-2 editing"><p>Last:</p><input name="l_name" value=""></div>'+
                                '<div class="col-md-2 editing"><p>Email/Username:</p><input name="email" value=""><input type="hidden" value="" name="username"></div>'+
                                '<div class="col-md-3 editing"><p>URL:</p><input name="url" value=""></div>'+
                                '<div class="col-md-2 editing"><p>Level:</p>'+
                                '<select name="permissions" class="dropdown">'+
                                '<option value="300">superAdmin</option>'+
                                '<option value="200">admin</option>'+
                                '<option value="100" selected>user</option>'+
                                '</select>'+
                                '</div><div class="col-md-12"><button type="button" class="login-submit" value="ADD" name="add">ADD</button><div class="cancel">Cancel</div></div></form></div></div>').find('.new-user').slideDown();
    
    initCreateControls();
  }

  function initCreateControls(){
    $('.cancel').on('click', function(){
      $(this).parents('.new-user').slideUp();
    });
    $('[name=add]').on('click', function(){
      createUser();
    });
  }
  
  $('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('New message to ' + recipient)
    modal.find('.modal-body input').val(recipient)
  });

  function createUser(){
    var email= $('[name=email]').val();
    $('[name=username]').val(email);

    var form = $('[name=createUser]');
    $.ajax({
      type: "GET",
      url: "php/adminUserCreate.php",
      data: form.serialize(),
      dataType: "html",
      success: function(result) {
        if(result.indexOf("Failure") > -1) {
          var user = $('[name=f_name]').val();
          $('#alert').modal().find('.modal-title').text('Could Not Create User');
          $('#alert').modal().find('.modal-body').html('<p>There must have been an error with the database. Please try again later.</p><p>To report this issue - <a href="mailto:kevin@thismovieyear.com">send support an email</a>.</p>');
        } else {
          $('.new-user').slideUp().html('');
          $('#alert').modal().find('.modal-title').text('Created New User');
          $('#alert').modal().find('.modal-body').html('<p>Cool man you created a new user, they should be getting an email soon to set up their account.</p>');
        }
      }
      });
  }

  function initControls(){
    $('[id=row]').on('click', function(){
      var permissionsValue;
      if($('[id=row]').find('.user-details').is(':visible')) {
        return false;
      } else {
        var userId = $(this).find('.user-id').html(),
            firstName = $(this).find('.first').html(),
            lastName = $(this).find('.last').html(),
            email = $(this).find('.username').html(),
            url = $(this).find('.url').html();
            permissions = $(this).find('.permissions').html();

        if(permissions == 'user') {
          permissionsValue = 100;
        } else if (permissions == 'admin') {
          permissionsValue = 200;
        } else if (permissions == 'superAdmin') {
          permissionsValue = 300;
        }

        if ($(this).find('.user-details').is(':visible')){
          console.log('hello please submit or hit cancel thats what its there for');
        } else {
          $(this).find('.user-details').slideDown();
        }

        $(this).find('.user-details').html('<h3>'+firstName+' '+lastName+' <span class="email-small">'+email+'</span></h3>'+
                                            '<form class="login-form" name="detailsForm" method="post">' +
                                            '<div class="col-md-3 editing"><p>First:</p><input name="f_name" value='+firstName+'></div>'+
                                            '<div class="col-md-3 editing"><p>Last:</p><input name="l_name" value='+lastName+'></div>'+
                                            '<div class="col-md-4 editing"><p>URL:</p><input name="url" value="'+url+'"></div>'+
                                            '<div class="col-md-2 editing"><p>Level:</p>'+
                                            '<select name="permissions" class="dropdown">'+
                                            '<option value="'+permissionsValue+'" selected>'+permissions+'</option>'+
                                            '<option value="300">superAdmin</option>'+
                                            '<option value="200">admin</option>'+
                                            '<option value="100">user</option>'+
                                            '</select>'+
                                            '<input type="hidden" name="id" value="'+userId+'">'+
                                            '</div><div class="col-md-12"><button type="button" class="login-submit save pull-left" value="SAVE" name="save">SAVE</button><div class="cancel pull-left">Cancel</div><button type="button" class="login-submit  delete pull-right" vale="DELETE" name="delete">DELETE</button></div></form>');
        
        initSaveControls();
        initDeleteUserControls();

        console.log('user-id: ', userId);
        console.log('firstName: ', firstName);
        console.log('lastName: ', lastName);
        console.log('permissions: ', permissions); 
      }
    })
  }

  function initSaveControls(){
    $('.cancel').on('click', function(){
      $(this).parents('.user-details').slideUp();
    });
    $('[name=save]').on('click', function(){
      submitForm();
    });
  }

  function submitForm(formValue){
    var form = $('[name=detailsForm]');

    $.ajax({
        type: "GET",
        url: "php/adminUserEdit.php",
        data: form.serialize(),
        dataType: "json"
      });
    
    var divs = $('[id=row]').length;
    
    console.log(divs.length);

    $('[id=row]').find('.user-details').slideUp('fast', function(){
      --divs;
      if( divs === 0 ){
        getUsers();
      }
    });
  }
  
  function initDeleteUserControls(){
    $('[name=delete]').on('click', function(){
      var user = $('[name=id]').val();
      $.ajax({
          type: "GET",
          url: "php/adminUserDelete.php",
          data: {user:user},
          dataType: "json"
        });

      var divs = $('[id=row]').length;

      $('[id=row]').find('.user-details').slideUp('fast', function(){
        --divs;
        if( divs === 0 ){
          getUsers();
        }
      });

    });
  }
});