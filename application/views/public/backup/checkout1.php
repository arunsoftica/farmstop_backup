<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
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
                alert(id+name+email+type+iurl);
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
<style>
    #customBtn {
      display: inline-block;
      background: white;
      color: #444;
      width: 190px;
      border-radius: 5px;
      border: thin solid #888;
      box-shadow: 1px 1px 1px grey;
      white-space: nowrap;
    }
    #customBtn:hover {
      cursor: pointer;
    }
     .buttonText {
      display: inline-block;
      vertical-align: middle;
      padding-left: 42px;
      padding-right: 42px;
      font-size: 14px;
      font-weight: bold;
      /* Use the Roboto font that is loaded in the <head> */
      font-family: 'Roboto', sans-serif;
    }
</style>
  
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


<div style="padding-left:50px;">
  checkout page
  <br><br>
  <form method="post" id="checkout_page">
  Name
  <input type="text" name="name" id="name" value="<?php if(isset($_SESSION['login_name'])) echo $_SESSION['login_name']; ?>">
  <br><br>
  Mobile
    <input type="number" name="mobile">
    <br><br>
  Email
    <input type="email" name="email" id="email" value="<?php if(isset($_SESSION['login_email'])) echo $_SESSION['login_email']; ?>">
    <br><br>
  
  <button type="submit" name="submit" id="submit">Submit</button>
  </form>
  <br><br>
    register
  <form method="post" id="register_user">
  Name
  <input type="text" name="name">
  <br><br>
  Mobile
    <input type="number" name="mobile">
    <br><br>
  Email
    <input type="email" name="email">
    <br><br>
  Password
  <input type="password" name="passwd">
  <br><br>
  <button type="submit" name="submit" id="submit">Submit</button>
  </form>
  <br><br>
  login
  <br><br>
  <form method="post" id="login_user">
 
  Mobile or email
    <input type="text" name="usernm" value="">
    <br><br>
  Password
  <input type="password" name="passwd" value="">
  <br><br>
  <button type="submit" name="submit" id="submit">Submit</button>
  </form>
  <br><br>
  <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
  </fb:login-button>
  <div id="gSignInWrapper">
    <span class="label">Sign in with:</span>
    <div id="customBtn" class="customGPlusSignIn">
      <span class="icon"></span>
      <span class="buttonText">Google</span>
    </div>
  </div>
</div>
<script>startApp();</script>

<script >
  $(document).on('submit','#register_user',(function(e){
    
    e.preventDefault();
      $.ajax({
      url: "<?php echo base_url('Ajaxcontroller/register_user') ?>",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        $("#register_user")[0].reset();
        alert(data);
     }  
     });  
 }));

  $(document).on('submit','#login_user',(function(e){
    
    e.preventDefault();
      $.ajax({
      url: "<?php echo base_url('Ajaxcontroller/login_user') ?>",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        $("#login_user")[0].reset();
        //alert(data);
        if(data == 'yes'){
            location.reload();
        }
     }  
     });  
 }));
</script>
