<?php global $path; ?>
<script type="text/javascript" src="<?php echo $path; ?>Modules/notify/notify.js"></script>

<br>

<h2>Notify me on inactive feeds</h2>
<p>Receive an email notification when any feed become inactive for more than 2 hours</p>

<div class="input-prepend input-append">
  <span class="add-on">Send email to:</span>
  <input id="email" type="text" />
  <span id="enabledtag" class="add-on" style="display:none">Enabled!</span>
  <button id="notifybtn" class="btn btn-primary" type="button">Enable</button>
</div>

<p><i>The server checks for inactive feeds every 2 hours.<br>Feeds that are historically inactive are ignored.</i></p>

<script>
  var path = "<?php echo $path; ?>";
  var result = notify.status();

  var enabled = result.enabled*1;
  console.log("Enabled: "+enabled);
  
  var email = result.email;
  
  update();
      
  // Enable / disable button
  $("#notifybtn").click(function(){
    enabled = !enabled;
    console.log("Enabled: "+enabled);
    
    
    if (enabled) {
      var lastemail = email;
      email = $("#email").val();
      console.log("Sending email to: "+email);
      var result = notify.enable(email);
      if (result.success == false) {
        alert('ERROR: Please enter a valid email address');
        email = lastemail;
        enabled = false;
        update();
      }
    } else {
      notify.disable();
    }
        
    update();
  });
  
  function update()
  {
    if (enabled) {
      $("#notifybtn").removeClass("btn-primary");
      $("#notifybtn").html("Disable");
      $("#notifybtn").addClass("btn-danger");
      $("#enabledtag").show();
    } else {
      $("#notifybtn").removeClass("btn-danger");
      $("#notifybtn").html("Enable");
      $("#notifybtn").addClass("btn-primary");
      $("#enabledtag").hide();
    }
    $("#email").val(email);
  }

</script>

