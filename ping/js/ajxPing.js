  $(document).ready(function(){
//==============================================================================

/*==============================================================================
  Send ajax to server
==============================================================================*/

  // On keyup (login) : send ajax
  jQuery("body").on("keyup", "input[name='ping']", function(key) {
    var ipAddr = jQuery(this).val();
    if (key.which == 13) {
      sendAjax("ajxPing.php", {'ipAddr': ipAddr});
      jQuery(".answer").html("<h3>En cours d'exécution...</h3>");
      jQuery(this).val("");
    }
  });





/*==============================================================================
  Receive ajax from server
==============================================================================*/

  // Receive ajax data
  function receiveAjax(data) {
    // TODO

    // On success : update html content
    if (data['success']) jQuery(".answer").html(data['html']);
    // On fail : logout
    else jQuery(".answer").html(data['html']);
  }



















/*==============================================================================
  Usefull functions
==============================================================================*/

  // --- Send AJAX data to server
  function sendAjax(serverUrl, data) {
    jsonData = JSON.stringify(data);
    jQuery.ajax({type: 'POST', url: serverUrl, dataType: 'json', data: "data=" + jsonData,
      success: function(data) {
        receiveAjax(data);
      }
    });
  }



  // --- Redirect
  function redirect(serverUrl) {
    window.location.href = serverUrl;
  }



  // --- Test whether a variable is defined or not
  function defined(myVar) {
    if (typeof myVar != 'undefined') return true;
    return false;
  }

//==============================================================================
});
