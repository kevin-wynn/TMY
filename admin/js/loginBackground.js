var prefixUrl = window.location.pathname.slice(0, -1);


$.ajax({
  type: "GET",
  url: "includes/background-image.php",             
  dataType: "json",                
  success: function(result) {
    for(i=0; i<result.length; i++){
      // grab content from json returned
      var backdrop_path = prefixUrl + '/../../' + result[i].backdrop_path;

      // build out html for injection
      backdrop_path = '<div class="banner-image" style="background-image: url('+backdrop_path+');"></div>';

      // inject html into container
      $('#bannerContainer').append(backdrop_path);
    }

    setBackground();
  }
});

function setBackground(){
  var t = setInterval(function(){

      $('.banner-image').last().fadeOut(2000,function(){ // 2 second fade duration
          $this = $(this);
          $parent = $this.parent();
          $this.remove().css('display','block'); // remove the faded element
          $parent.prepend($this); // put it as the first element
      });

  },3000); // every 3 seconds 
}