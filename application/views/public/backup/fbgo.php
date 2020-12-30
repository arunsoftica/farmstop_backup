<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
<style>

#customBtn {display: inline-block;background: #ea4335;color: #fff;padding: 1px;padding-left: 4px;
padding-right: 8px;border-radius: 2px;white-space: nowrap;}
#customBtn:hover {cursor: pointer;}
.buttonText {display: inline-block;vertical-align: middle;font-size: 25px;font-weight: bold;}
#customBtn .icon{background: #fff;padding: 8px;border-radius: 2px;color: #e12a2a;font-size: 19px;
vertical-align: middle;}
.login-social{text-align: center;}
.login-social li{display: inline-block;vertical-align: middle;}

#customBtn1 {display: inline-block;background: #ea4335;color: #fff;padding: 1px;padding-left: 4px;
padding-right: 8px;border-radius: 2px;white-space: nowrap;}
#customBtn1:hover {cursor: pointer;}
.buttonText {display: inline-block;vertical-align: middle;font-size: 25px;font-weight: bold;}
#customBtn1 .icon{background: #fff;padding: 8px;border-radius: 2px;color: #e12a2a;font-size: 19px;
vertical-align: middle;}
.login-social{text-align: center;}
.login-social li{display: inline-block;vertical-align: middle;}

</style>
  <script src="https://apis.google.com/js/api:client.js"></script>
  
  <script>
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '982397917312-o3s61kerh0833bsdomhpjenhj20vg3ue.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachSignin(document.getElementById('customBtn'));
      attachSignin(document.getElementById('customBtn1'));
    });
  };

  function attachSignin(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUser) {
          /*document.getElementById('name').innerText = "Signed in: " +
              googleUser.getBasicProfile().getId();*/
              //alert(googleUser.getBasicProfile().getId());
                var id = googleUser.getBasicProfile().getId();
                var name= googleUser.getBasicProfile().getName();
                var email = googleUser.getBasicProfile().getEmail();
                var type = 3;
                var iurl = googleUser.getBasicProfile().getImageUrl();
                
                $.ajax({
                        type: "GET",
                        url: "<?php echo base_url("Ajaxcontroller/facebook_login") ?>",
                        data: {id:id,name:name,email:email,type:type,iurl:iurl},
                        success: function (data) {
                            //alert(data);
                            if(data == 'yes'){
                                location.reload();
                            }
                            
        
                        }
                    });
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
  }
  </script>
  
  <script>
  
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    
    if (response.status === 'connected') {
      
      testAPI();
    } else {
      
      /*document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';*/
    }
  }

  
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '625457114638665',
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v3.3' // The Graph API version to use for the call
    });

    

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };

  
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=id,name,email', function(response) {
      /*console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.id + response.email +response.name + '!';*/
        var id = response.id;
        var name= response.name;
        var email = response.email;
        var type = 2;
        var iurl = 'https://graph.facebook.com/'+response.id+'/picture';
        $.ajax({
                type: "GET",
                url: "<?php echo base_url("Ajaxcontroller/facebook_login") ?>",
                data: {id:id,name:name,email:email,type:type,iurl:iurl},
                success: function (data) {
                    //alert(data);
                    if(data == 'yes'){
                        location.reload();
                    }
                    

                }
            });
    
    });
  }
</script>