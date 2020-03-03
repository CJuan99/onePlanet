<?php
  include("conn.php");


?>

<script type="text/javascript">
var checkEditing = false;

var materialID;
var materialName;
var description;
var points;

function editButton(vButton){
  var columns = vButton.parentNode.parentNode.getElementsByTagName("td");
  materialID = columns[0].innerHTML;
  materialName = columns[1].innerHTML;
  description = columns[2].innerHTML;
  points = columns[3].innerHTML;

  for(var i=0;i<4;i++){
    columns[i].contentEditable = true;
  }

  vButton.classList.add("d-none");
  vButton.parentNode.getElementsByClassName("confirmBtn")[0].classList.remove("d-none");
  vButton.parentNode.getElementsByClassName("deleteBtn")[0].classList.remove("d-none");
  vButton.parentNode.getElementsByClassName("cancelBtn")[0].classList.remove("d-none");
}

function cancelButton(vButton){
  var confirm = window.confirm("Are you sure to cancel?\nPrevious data will be recovered.");
  if(confirm){
    var columns = vButton.parentNode.parentNode.getElementsByTagName("td");
    columns[0].innerHTML = materialID;
    columns[1].innerHTML = materialName;
    columns[2].innerHTML = description;
    columns[3].innerHTML = points;

    for(var i=0;i<4;i++){
      columns[i].contentEditable = false;
    }

    vButton.classList.add("d-none");
    vButton.parentNode.getElementsByClassName("confirmBtn")[0].classList.add("d-none");
    vButton.parentNode.getElementsByClassName("deleteBtn")[0].classList.add("d-none");
    vButton.parentNode.getElementsByClassName("editBtn")[0].classList.remove("d-none");
  }
}

function confirmButton(vButton){
  var confirm = window.confirm("Are you sure to save?");
  if(confirm){
    var columns = vButton.parentNode.parentNode.getElementsByTagName("td");
    for(var i=0;i<4;i++){
      columns[i].contentEditable = false;
    }
    var materialID_Edited = columns[0].innerHTML;
    var materialName_Edited = columns[1].innerHTML;
    var description_Edited = columns[2].innerHTML;
    var points_Edited = columns[3].innerHTML;

    //send request to another php file to do update query
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "materialUpdate.php?mid="+materialID_Edited+"&mn="+materialName_Edited+"&desc="+description_Edited+"&p="+points_Edited, true);
    xmlhttp.send();
  }
  vButton.classList.add("d-none");
  vButton.parentNode.getElementsByClassName("cancelBtn")[0].classList.add("d-none");
  vButton.parentNode.getElementsByClassName("deleteBtn")[0].classList.add("d-none");
  vButton.parentNode.getElementsByClassName("editBtn")[0].classList.remove("d-none");
}

</script>
