<?php
  include("conn.php");
?>

<script type="text/javascript">
//Maintain Material Javascript
var checkEditing = false;
var currentWorkingRow_Options;

var materialName;
var description;
var points;

function editButton(vButton){
  if(checkEditing==true){
    var confirm = window.confirm("You're currently editing on other material. Are you sure to leave?\nPrevious data will be recovered.");
    if(confirm){
      checkEditing = false;

      var columns = currentWorkingRow_Options.parentNode.getElementsByTagName("td");
      columns[1].innerHTML = materialName;
      columns[2].innerHTML = description;
      columns[3].innerHTML = points;

      for(var i=1;i<4;i++){
        columns[i].contentEditable = false;
        columns[i].classList.remove("bg-warning");
      }

      currentWorkingRow_Options.getElementsByClassName("editBtn")[0].classList.remove("d-none");
      currentWorkingRow_Options.getElementsByClassName("confirmBtn")[0].classList.add("d-none");
      currentWorkingRow_Options.getElementsByClassName("deleteBtn")[0].classList.add("d-none");
      currentWorkingRow_Options.getElementsByClassName("cancelBtn")[0].classList.add("d-none");
    }else{
      return;
    }
  }
  var columns = vButton.parentNode.parentNode.getElementsByTagName("td");
  checkEditing = true;
  currentWorkingRow_Options = vButton.parentNode; //Notice

  materialName = columns[1].innerHTML;
  description = columns[2].innerHTML;
  points = columns[3].innerHTML;

  for(var i=1;i<4;i++){
    columns[i].contentEditable = true;
    columns[i].classList.add("bg-warning");
  }
  columns[1].focus();

  vButton.classList.add("d-none");
  vButton.parentNode.getElementsByClassName("confirmBtn")[0].classList.remove("d-none");
  vButton.parentNode.getElementsByClassName("deleteBtn")[0].classList.remove("d-none");
  vButton.parentNode.getElementsByClassName("cancelBtn")[0].classList.remove("d-none");
}

function cancelButton(vButton){
  var columns = vButton.parentNode.parentNode.getElementsByTagName("td");
  var materialName_Edited = columns[1].innerHTML;
  var description_Edited = columns[2].innerHTML;
  var points_Edited = columns[3].innerHTML;

  if((materialName!=materialName_Edited) || (description!=description_Edited) || (points!=points_Edited)){
    var confirm = window.confirm("Are you sure to cancel?\nPrevious data will be recovered.");
    if(confirm){
      checkEditing = false;

      columns[1].innerHTML = materialName;
      columns[2].innerHTML = description;
      columns[3].innerHTML = points;

      for(var i=1;i<4;i++){
        columns[i].contentEditable = false;
        columns[i].classList.remove("bg-warning");
      }

      vButton.classList.add("d-none");
      vButton.parentNode.getElementsByClassName("confirmBtn")[0].classList.add("d-none");
      vButton.parentNode.getElementsByClassName("deleteBtn")[0].classList.add("d-none");
      vButton.parentNode.getElementsByClassName("editBtn")[0].classList.remove("d-none");
    }
  }else{
    checkEditing = false;

    for(var i=1;i<4;i++){
      columns[i].contentEditable = false;
      columns[i].classList.remove("bg-warning");
    }

    vButton.classList.add("d-none");
    vButton.parentNode.getElementsByClassName("confirmBtn")[0].classList.add("d-none");
    vButton.parentNode.getElementsByClassName("deleteBtn")[0].classList.add("d-none");
    vButton.parentNode.getElementsByClassName("editBtn")[0].classList.remove("d-none");
  }
}

function confirmButton(vButton){
  var columns = vButton.parentNode.parentNode.getElementsByTagName("td");
  var materialID_Selected = columns[0].innerHTML;
  var materialName_Edited = columns[1].innerHTML;
  var description_Edited = columns[2].innerHTML;
  var points_Edited = columns[3].innerHTML;

  if((materialName!=materialName_Edited) || (description!=description_Edited) || (points!=points_Edited)){
    var confirm = window.confirm("Are you sure to save?");
    if(confirm){
      var letters = /^[a-zA-Z]+$/;
      var integers = /^[0-9]+$/;

      if(materialName_Edited.length>0 && description_Edited.length>0 && points_Edited.length>0){
        if(letters.test(materialName_Edited)){
          if((description_Edited.length >= 20) && (description_Edited.length <= 50)){
            if(integers.test(points_Edited) && (points_Edited.length<=3)){
              checkEditing = false;

              for(var i=1;i<4;i++){
                columns[i].contentEditable = false;
                columns[i].classList.remove("bg-warning");
              }

              //send request to another php file to do update query
              var xmlhttp = new XMLHttpRequest();

              xmlhttp.open("GET", "materialUpdate.php?mid="+materialID_Selected+"&mn="+materialName_Edited+"&desc="+description_Edited+"&p="+points_Edited, true);
              xmlhttp.send();

              vButton.classList.add("d-none");
              vButton.parentNode.getElementsByClassName("cancelBtn")[0].classList.add("d-none");
              vButton.parentNode.getElementsByClassName("deleteBtn")[0].classList.add("d-none");
              vButton.parentNode.getElementsByClassName("editBtn")[0].classList.remove("d-none");

              alert("Data saved successfully.");
            }else{
              alert('"Points" must contain only integer number and less than equal to 3 numbers.')
            }
          }else{
            alert('"Description" must contain between 20 to 50 characters.');
          }
        }else{
          alert('"Material Name" must contain only alphabet.');
        }
      }else{
        alert("All fields must be filled.");
      }
    }
  }else{
    checkEditing = false;

    for(var i=1;i<4;i++){
      columns[i].contentEditable = false;
      columns[i].classList.remove("bg-warning");
    }

    vButton.classList.add("d-none");
    vButton.parentNode.getElementsByClassName("cancelBtn")[0].classList.add("d-none");
    vButton.parentNode.getElementsByClassName("deleteBtn")[0].classList.add("d-none");
    vButton.parentNode.getElementsByClassName("editBtn")[0].classList.remove("d-none");

    alert("No data changed.");
  }
}

function deleteButton(vButton){
  var confirm = window.confirm("Are you sure to delete?");
  if(confirm){
    checkEditing = false;

    var columns = vButton.parentNode.parentNode.getElementsByTagName("td");
    var materialID_Selected = columns[0].innerHTML;

    vButton.parentNode.parentNode.remove();

    //send request to another php file to do delete query
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "materialDelete.php?mid="+materialID_Selected, true);
    xmlhttp.send();

    alert("Data deleted successfully.");
  }
}

//Manage Profile Javascript
var password;
var fullname;

function editProfile(vButton){
  var field = vButton.parentNode.parentNode.getElementsByTagName("input");

  password = field[1].value;
  fullname = field[2].value;

  field[1].value = "";

  for(var i=1;i<3;i++){
    field[i].readOnly = false;
  }

  vButton.classList.add("d-none");
  document.getElementById("confirmProfileBtn").classList.remove("d-none");
  document.getElementById("cancelProfileBtn").classList.remove("d-none");
}

var formSubmitted=false;

function checkFormSubmitted(){
  formSubmitted=true;
}

function confirmProfile(vButton){
  var field = vButton.parentNode.parentNode.getElementsByTagName("input");

  var username = field[0].value;
  var password_Edited = field[1].value;
  var fullname_Edited = field[2].value;

  if((password_Edited!="") || (fullname!=fullname_Edited)){
    if(confirm("Are you sure to save?")){
      var submitBtn = document.getElementById("submit");
      submitBtn.click();
      //document.profileForm.submit();
      if(formSubmitted){
        //formSubmitted=false; -- Because included location.reload() to refresh page, the value will be reseted to false (So not required)
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.open("GET", "updateAdminProfile.php?username="+username+"&password="+password_Edited+"&fullname="+fullname_Edited, true);
        xmlhttp.send();

        alert("Data saved successfully.");
        location.reload();
      }

    }
  }else{
    field[1].value ="******";

    for(var i=1;i<3;i++){
      field[i].readOnly = true;
    }

    vButton.classList.add("d-none");
    document.getElementById("cancelProfileBtn").classList.add("d-none");
    document.getElementById("editProfileBtn").classList.remove("d-none");

    alert("No data changed.");
  }
}

function cancelProfile(vButton){
  var field = vButton.parentNode.parentNode.getElementsByTagName("input");

  var password_Edited = field[1].value;
  var fullname_Edited = field[2].value;

  if((password_Edited!="") || (fullname!=fullname_Edited)){
    var confirm = window.confirm("Are you sure to discard changes?\nPrevious data will be recovered.");
    if(confirm){
      field[1].value = password;
      field[2].value = fullname;

      for(var i=1;i<3;i++){
        field[i].readOnly = true;
      }

      vButton.classList.add("d-none");
      document.getElementById("confirmProfileBtn").classList.add("d-none");
      document.getElementById("editProfileBtn").classList.remove("d-none");
    }
  }else{
    field[1].value ="******";

    for(var i=1;i<3;i++){
      field[i].readOnly = true;
    }

    vButton.classList.add("d-none");
    document.getElementById("confirmProfileBtn").classList.add("d-none");
    document.getElementById("editProfileBtn").classList.remove("d-none");
  }
}
</script>
