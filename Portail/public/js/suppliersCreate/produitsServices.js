function checkedbox(me) {
    // Get the checkbox
    var checkBox = me;
    // Get the output text
    var text = document.getElementById("selected" + me.id);
  
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
      text.style.display = "block";
    } else {
      text.style.display = "none";
    }
  }