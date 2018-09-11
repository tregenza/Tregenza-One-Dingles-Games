<?php
/**
*
*		Javscript required for Display Monster
*
**/
?>

var req;
var test;

function addElement() {
  var ni = document.getElementById('myDiv');
  var numi = document.getElementById('theValue');
  var num = (document.getElementById('theValue').value -1)+ 2;
  numi.value = num;
  var newdiv = document.createElement('div');
  var divIdName = 'my'+num+'Div';
  newdiv.setAttribute('id',divIdName);
  newdiv.innerHTML = 'Element Number '+num+' has been added! <a href=\'#\' onclick=\'removeElement('+divIdName+')\'>Remove the div "'+divIdName+'"</a>';
  ni.appendChild(newdiv);
}
function removeElement(divNum) {
  var d = document.getElementById('myDiv');
  var olddiv = document.getElementById(divNum);
  alert(olddiv);
  d.removeChild(olddiv);
}
function processReqChange()
{
    // only if req shows "complete"
    if (req.readyState == 4) {
        // only if "OK"
        if (req.status == 200) {
        //    alert("status ok");
          var response  = req.responseXML.documentElement;
          helpTextDesc = response.getElementsByTagName('result')[0].firstChild.data;
//          alert(helpTextDesc);
          changeFieldHelp(helpTextDesc);
        } else {
            alert("There was a problem retrieving the XML data:" + req.statusText);
        }
    }
}
function loadXMLDoc(url)
{
    // branch for native XMLHttpRequest object
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChange;
        req.open("GET", url, true);
        req.send(null);
    // branch for IE/Windows ActiveX version
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChange;
            req.open("GET", url, true);
            req.send();
        }
    }
}
function changeText( test ) {
//    alert("here");
    var myfield = document.getElementById('helpFeat');
    var field = myfield.value;
//    alert (field);
    var field2 = field.replace(/ /gi, "_");
    field2 = field2.replace(/\(/gi, "_");
    field2 = field2.replace(/\-/gi, "_");
    field2 = field2.replace(/\,/gi, "_");
    field2 = field2.replace(/\+/gi, "_");
    field2 = field2.replace(/\*/gi, "_");
    field2 = field2.replace(/\[''""]/gi, "_");
    field2 = field2.replace(/\)/gi, "_") + "_h";
//    alert(field2);
    var helpTextDesc = window[field2];
//    alert (helpTextDesc);
//    alert (helpTextDesc.value);
    changeFieldHelp(helpTextDesc);

//    alert(field);
//    alert ("change text");
}
function changeFieldHelp(helpTextDesc) {
   document.getElementById('helpText').innerHTML = '<TEXTAREA class="helpText" rows="7" cols = "60" readonly>'
                                      + helpTextDesc + '</TEXTAREA>';
}

function calcGP(new_item, old_gp_v, item_v){
//          alert("old " + old_gp_v);
//          alert ("item_v=" + item_v +":");
//          alert ("new_item=" + new_item + ":");
//           alert ("kwal " +  magic_type_MSC_1);
           var old_gp = old_gp_v;
           var focusB = document.getElementById("total_GP");
           var focusC = document.getElementById("total_spent");
           var gp_total = focusC.value;
//           alert("total " + gp_total);
           if (isNaN(gp_total)){
              gp_total = 0;
           }
           gp_total = gp_total - old_gp;

           var myfield = new_item;
           var field = myfield.value;
           var field2 = field.replace(/ /gi, "_");
          field2 = field2.replace(/\(/gi, "_");
          field2 = field2.replace(/\-/gi, "_");
          field2 = field2.replace(/\+/gi, "_");
          field2 = field2.replace(/\,/gi, "_");
          field2 = field2.replace(/\)/gi, "_") + "_gp";
//          alert("field2=" + field2);
          var new_gp = window[field2];
          if (isNaN(new_gp)){
             new_gp = 0;
          }
//          alert("new " + new_gp);
          gp_total = gp_total + new_gp;
          focusB.innerHTML = '<INPUT TYPE="text" id="total_spent" NAME="total_spent" VALUE="' + gp_total + '" readonly>';
          window[item_v] = new_gp;
//          alert("updated " + window[item_v]);
}
function calcskill(new_skill, skill_v, skill_n,xskill){
           var old_val =  window[skill_n];
           if (isNaN(old_val)){
             old_val = skill_v;
           }
           skill_v = old_val;
  //        if (isNan(window[skill_n])){
  //           alert("old value _n " + window[skill_n]);
//             skill_v = window[skill_n];
  //        }
//          alert("old value _n " + window[skill_n]);
          var new_skill_val = new_skill.value;
//          var xskill_val = xskill.value;
  //        alert("new skill " + new_skill_val);
  //         alert ("skill_n=" + skill_n);
//           alert ("kwal " +  magic_type_MSC_1);
//           var old_skill = skill_v;
           var focusB = document.getElementById("total_skill");
           var focusC = document.getElementById("skill_spent");
           var skill_total = focusC.value;
//           alert("total " + gp_total);
           if (isNaN(skill_total)){
              skill_total = 0;
           }
           skill_total = skill_total * 1;
           new_skill_val = new_skill_val * 1;
//           alert("xskill_val " + xskill);
// if xskill (dd35) then costs twice as much
           if (xskill != "Y"){
             skill_total = skill_total - new_skill_val;
           }else{
             skill_total = skill_total - (new_skill_val * 2);
           }

//          alert("field2=" + field2);
          var old_skill = skill_v;
 //         var old_skill = window[skill_v];
          if (isNaN(old_skill)){
             old_skill = 0;
           }
    //      alert("old " + old_skill);

          old_skill = old_skill * 1;
          if (xskill != "Y"){
             skill_total = skill_total + old_skill;
          }else{
              skill_total = skill_total + (old_skill *2);
          }
    //      alert ("skill total " + skill_total);
          focusB.innerHTML = 'Skill Points to spend<INPUT TYPE="text" id="skill_spent" NAME="skill_spent" VALUE="' + skill_total + '" readonly>';
         window[skill_n] = new_skill_val;

   //       alert("updated " + window[skill_n]);
}
function calcattr(new_attr, attr_v, attr_n){
           var old_val =  window[attr_n];
           if (isNaN(old_val)){
             old_val = attr_v;
           }
           attr_v = old_val;
  //        if (isNan(window[skill_n])){
  //           alert("old value _n " + window[skill_n]);
//             skill_v = window[skill_n];
  //        }
//          alert("old value _n " + window[skill_n]);
          var new_attr_val = new_attr.value;
//          var xskill_val = xskill.value;
  //        alert("new skill " + new_skill_val);
  //         alert ("skill_n=" + skill_n);
//           alert ("kwal " +  magic_type_MSC_1);
//           var old_skill = skill_v;
           var focusB = document.getElementById("total_attr");
           var focusC = document.getElementById("attr_spent");
           var attr_total = focusC.value;
//           alert("total " + gp_total);
           if (isNaN(attr_total)){
              attr_total = 0;
           }
           attr_total = attr_total * 1;
           new_attr_val = new_attr_val * 1;
//           alert("xskill_val " + xskill);
// if xskill (dd35) then costs twice as much
           attr_total = attr_total - new_attr_val;


//          alert("field2=" + field2);
          var old_attr = attr_v;
 //         var old_skill = window[skill_v];
          if (isNaN(old_attr)){
             old_attr = 0;
           }
    //      alert("old " + old_skill);

          old_attr = old_attr * 1;
          attr_total = attr_total + old_attr;
    //      alert ("skill total " + skill_total);
          focusB.innerHTML = 'Attribute Points to spend<INPUT TYPE="text" id="attr_spent" NAME="attr_spent" VALUE="' + attr_total + '" readonly>';
         window[attr_n] = new_attr_val;

   //       alert("updated " + window[skill_n]);
}
function print_unhide(){
  if (document.getElementById("print_ind1") != undefined) {
  document.getElementById("print_ind1").style.display = "inline";
  document.getElementById("print_ind1").style.height="28px";
  document.getElementById("print_ind1").style.width="150px";
  document.getElementById("print_ind2").style.display = "inline";
  document.getElementById("print_ind2").style.height="28px";
  document.getElementById("print_ind2").style.width="150px";
  document.getElementById("print_ind3").style.display = "inline";
  document.getElementById("print_ind3").style.height="28px";
  document.getElementById("print_ind3").style.width="150px";
  document.getElementById("print_ind4").style.display = "inline";
  document.getElementById("print_ind4").style.height="28px";
  document.getElementById("print_ind4").style.width="100px";
  }
  if (document.getElementById("print_ind11") != undefined) {
  document.getElementById("print_ind11").style.display = "inline";
  document.getElementById("print_ind11").style.height="28px";
  document.getElementById("print_ind11").style.width="90px";
  document.getElementById("print_ind12").style.display = "inline";
  document.getElementById("print_ind12").style.height="28px";
  document.getElementById("print_ind12").style.width="140px";
  document.getElementById("print_ind13").style.display = "inline";
  document.getElementById("print_ind13").style.height="28px";
  document.getElementById("print_ind13").style.width="140px";
  document.getElementById("print_ind14").style.display = "inline";
  document.getElementById("print_ind14").style.height="28px";
  document.getElementById("print_ind14").style.width="50px";
  document.getElementById("print_ind15").style.display = "inline";
  document.getElementById("print_ind15").style.height="27px";
  document.getElementById("print_ind15").style.width="80px";
  }
//  changeInputType('print_ind', 'submit')
//  var x=document.getElementById("print_inda").style.display;
//  alert(x);
//  var input1=document.getElementById('print_inda');
//  var input2= input1.cloneNode(true);
//  alert(x);
//  input2.style.display ='block';
//  alert(x);
//  var x=document.getElementById("input2").style;
//  alert(x);
//  input1.parentNode.replaceChild(input2,input1);
//  var x=document.getElementById("print_inda").style;
//  alert(x);

//document.getElementById('print_ind').type = "submit";
//  elem.type = "submit";
//     alert("loaded " );
}
function changeInputType(oldObject, oType) {
  var newObject = document.createElement('input');
  newObject.type = oType;
  if(oldObject.size) newObject.size = oldObject.size;
  if(oldObject.value) newObject.value = oldObject.value;
  if(oldObject.name) newObject.name = oldObject.name;
  if(oldObject.id) newObject.id = oldObject.id;
  if(oldObject.className) newObject.className = oldObject.className;
  oldObject.parentNode.replaceChild(newObject,oldObject);
  return newObject;
}
window.onload = function() {
    print_unhide();
}
