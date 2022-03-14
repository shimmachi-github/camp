function checkclear(){
  var checkbox = document.getElementsByName("check[]");
  var select = document.getElementById("select");
  
  for (var i=0;i<checkbox.length;i++){
      checkbox[i].checked = false;
  }
  select.options[0].selected = true;
}
