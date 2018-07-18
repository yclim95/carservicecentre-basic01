function AddClick(){
val1 = document.getElementById("textbox1").value;
val2 = document.getElementById("textbox2").value;
val3 = document.getElementById("textbox3").value;
 if(val1=="" && val2!="" && val3!=""){
  alert("first alert");
 }
 if(val1=="" && val2=="" && val3!=""){
  alert("Second alert");
 }
}