  $(document).ready(function(){
//==============================================================================

/*==============================================================================
  Send ajax to server
==============================================================================*/


  // On keyup (login) : send ajax
  jQuery("body").on("keyup", "input[name='gameOver']", function(key) {
    if (key.which == 13) {
      var gameOver = jQuery(this).val();
      sendAjax("ajxGameOver.php", {'gameOver': gameOver});
    };
  });

  jQuery("body").on("click", ".ok", function() {
    var gameOver = jQuery("input[name='gameOver']").val();
    sendAjax("ajxGameOver.php", {'gameOver': gameOver});
  });





/*==============================================================================
  Receive ajax from server
==============================================================================*/

  // Receive ajax data
  function receiveAjax(data) {
    // TODO
    // On success : update html content
    if (data['success']) {
      redirect("gameOver.php");
    } else if (data['logout']) {
      redirect("logout.php");
    } else {
      jQuery("span").html(data["html"]);
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
