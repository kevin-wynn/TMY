$(document).ready(function(){
  var signupForm = $('#signupForm');
  
  signupForm.validate({
    rules: {
      username: {
        required: true,
        minLength: 20
      },
      password: {
        required: true,
        minLength: 20
      },
      passwordConfirm: {
        required: true,
        equalTo: "#password",
        minLength: 20
      },
      email: {
        required: true,
        email: true
      }
    }
  });
});