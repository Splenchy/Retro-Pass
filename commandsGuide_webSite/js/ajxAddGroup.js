  $(document).ready(function(){
//==============================================================================

/*==============================================================================
  Send ajax to server
==============================================================================*/


  // On keyup (login) : send ajax
  jQuery("body").on("keyup", "input[name='groupName']", function(key) {
    if (key.which == 13) {
      var groupName = jQuery(this).val();
      sendAjax("ajxAddGroup.php", {'groupName': groupName});
    };
  });

  jQuery("body").on("click", ".ok", function() {
    var groupName = jQuery("input[name='groupName']").val();
    sendAjax("ajxAddGroup.php", {'groupName': groupName});
  });





/*==============================================================================
  Receive ajax from server
==============================================================================*/

  // Receive ajax data
  function receiveAjax(data) {
    // TODO
    // On success : update html content
    if (data['success']) {
      redirect("commands.php")
    } else {
      alert(data['html']);
    }
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
