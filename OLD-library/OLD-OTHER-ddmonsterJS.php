<?php
if ( is_page(260) or is_page(2013)){
    $key_1 = "path";
}else{
    $key_1 = "dd35";
}
//**
//*
//*	Javascript needed by the Monster generator - Select Monster page
//*
//**
//
?>

<SCRIPT>
function addElement() {
  var ni = document.getElementById('myDiv');
  var numi = document.getElementById('theValue');
  var num = (document.getElementById('theValue').value -1)+ 2;
  numi.value = num;
  var newclass = document.createElement('div');
  var classIdName = 'my'+num+'Class';
  newclass.setAttribute('id',classIdName);
<?
//  $num = num;
//  echo "number = " . $num;
  //newdiv.innerHTML = 'Element Number '+num+' has been added! <a href=\'#\' onclick=\'removeElement('+divIdName+')\'>Remove the div "'+divIdName+'"</a>';
//  newdiv.innerHTML = '<SELECT NAME="classFocus'+num+'" ID="classFocus_' +num+' ">';
?>
    newclass.innerHTML = '<div class="tableCell tableCellWidth30"><?echo getClassSelectionHTML( "1", $_POST["class_tp_1"] );?>'
  ni.appendChild(newclass);


   var newfocus = document.createElement('div');
   var focusIdName = 'my'+num+'Focus';
   newfocus.setAttribute('id',focusIdName);
<?
  //newdiv.innerHTML = 'Element Number '+num+' has been added! <a href=\'#\' onclick=\'removeElement('+divIdName+')\'>Remove the div "'+divIdName+'"</a>';
?>
  newfocus.innerHTML = '<SELECT NAME="classFocus'+num+'" ID="classFocus_' +num+' "></SELECT>';
  ni.appendChild(newfocus);






}
function removeElement(divNum) {
  var d = document.getElementById('myDiv');
  var olddiv = document.getElementById(divNum.value);
//  alert(divNum.value);
  d.removeChild(olddiv);
}


	/* Returns array of valid skill focuses for classes */

function getSkillFocusArray( classx ) {

		var classArray = new Array();

<?php
		$loop = $loop + 1;
		$select = "SELECT class_tp from class2 where mon_key_1 = '$key_1' ORDER BY class_tp";
		$link = getDBLink();;
		$result = mysqli_query($link, $select) ;
		while ($row = mysqli_fetch_array($result)) {
	    	$type = $row['class_tp'];
	     	if ($type != "" and $type != " ") {
	     		$jScript = 'classArray["';

	     		$jScript .= $type . '"] = new Array( ';

                        $select2 = "SELECT DISTINCT classf_focus from classfocus2 where classf_class = '$type' and mon_key_1 = '$key_1' " .
                                   "ORDER BY classf_class";
				//  echo $select . "</BR>";
			$link = getDBLink();
			$result2 = mysqli_query($link, $select2) ;
			$var = "";
			while ($row2 = mysqli_fetch_array($result2)) {
		        	$classf_sel = $row2['classf_focus'] ;
                                 if ($classf_sel != "Tickery Domain"){
		        	    $jScript .= '"'.$classf_sel . '", ';
                                 }
			}

		       	// Get rid of last comma and space
		       	$jScript = substr($jScript, 0, -2);

		       	$jScript .= "); \n";

		       echo $jScript;
	        }

		}

		?>

		return classArray[classx];


}


function monsterSelection(selectField){
      //  alert(selectField.value);
        if ( document.getElementById("mon_name") === null ) {

        }else{
           var optionsA = document.getElementById("mon_name").options;
           while ( optionsA.length > 0  ) {
			optionsA[0] = null;
                 }
         }
         if (selectField.value === "A"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("A")?>';
         }
         if (selectField.value === "B"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("B")?>';
         }
         if (selectField.value === "C"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("C")?>';
         }
         if (selectField.value === "D"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("D")?>';
         }
         if (selectField.value === "E"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("E")?>';
         }
         if (selectField.value === "F"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("F")?>';
         }
         if (selectField.value === "G"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("G")?>';
         }
         if (selectField.value === "H"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("H")?>';
         }
         if (selectField.value === "I"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("I")?>';
         }
         if (selectField.value === "J"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("J")?>';
         }
         if (selectField.value === "K"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("K")?>';
         }
         if (selectField.value === "L"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("L")?>';
         }
         if (selectField.value === "M"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("M")?>';
         }
         if (selectField.value === "N"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("N")?>';
         }
         if (selectField.value === "O"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("O")?>';
         }
         if (selectField.value === "P"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("P")?>';
         }
         if (selectField.value === "Q"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("Q")?>';
         }
         if (selectField.value === "R"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("R")?>';
         }
         if (selectField.value === "S"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("S")?>';
         }
         if (selectField.value === "T"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("T")?>';
         }
         if (selectField.value === "U"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("U")?>';
         }
         if (selectField.value === "V"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("V")?>';
         }
         if (selectField.value === "W"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("W")?>';
         }
         if (selectField.value === "X"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("X")?>';
         }
         if (selectField.value === "Y"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("Y")?>';
         }
         if (selectField.value === "Z"){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("Z")?>';
         }
         if (selectField.value === " "){
           var optionsB = document.getElementById("mon_name");
           var selectB = '<?echo monletter("")?>';
         }
  //       alert(selectB);
         optionsB.innerHTML = selectB;

}
	/** Replaces the OPTIONS for the Class Focus Select based on the class selected  */
function changeField(selectField, classNumber, currentlySelected ) {

		if ( document.getElementById("classFocus_" + classNumber) === null ) {
			return;
		}
              //  myphp?classNo=classNumber;
//		alert(<?echo $classNo;?>);
                //alert("Hello");
		var optionsA = document.getElementById("classFocus_" + classNumber).options;
		//alert (optionsA);

		/* Clear out old values */

		while ( optionsA.length > 0  ) {
			optionsA[0] = null;
		}

		if (selectField.value != "" && selectField.value !=" " ){

			// alert (getSkillFocusArray(selectField.value) );
                        // alert (selectField.value);
			var focusArray = getSkillFocusArray(selectField.value) ;

			for ( var lp = 0; lp < focusArray.length; lp++ ) {

				var optElement = document.createElement( "option" );
				optElement.text = focusArray[lp];
				optElement.value = focusArray[lp];
				optElement.selected = (  focusArray[lp] == currentlySelected ) ;
				optionsA.add(optElement);

			}
			if (selectField.value == "Cleric"){
                           <?
                           $domain_c = 0;
                           ?>
                           for  (var domainNumber = 1; domainNumber < 3; domainNumber++ ){
                             <?PHP
                             $domain_c += 1;
                             $domain_v = "domain_1" . $domain_c;
                             $domain = $_POST[$domain_v];
                             $domain_s = 'getDomainSelectionHTML(' . $domain . ')';
                             ?>
                      //        alert ("<?echo 'getDomainSelectionHTML(' . $domain . ')'?>");
                      //       alert ("<?echo $domain_v?>");
                             var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                             var selectB  =  'Cleric Domain' + domainNumber + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                  '<?echo getDomainSelectionHTML($domain); ?>';
                      //       var selectB  =  'Cleric Domain' + domainNumber + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                       //           '<?echo $domain_s ?>';
                       //     alert (selectB);
                             optionsB.innerHTML = selectB;
                           }
                        }
                        if (selectField.value == "Psion"){
                          //   alert("here");
                             var domainNumber = 1

                             var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                             var selectB  =  'Psionic Discilpine ' + domainNumber + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                   '<?echo getPsionSelectionHTML($domain); ?>';
                             optionsB.innerHTML = selectB;
                            // alert (selectB);
                        }
                        <?
                        if ($key_1 == "path"){
                        ?>
                             if (selectField.value == "Sorcerer"){

                                for  (var domainNumber = 1; domainNumber < 2; domainNumber++ ){

                                 var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                 var selectB  =  'Bloodline' + domainNumber + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                     '<?echo getBloodlineSelectionHTML($domain); ?>';
                                optionsB.innerHTML = selectB;
                                }
                             }


                        <?
                        }
                        ?>
                         <?
                        if ($key_1 == "path"){
                        ?>
                             if (selectField.value == "Oracle"){
                                 var domainNumber = 1
                                 var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                 var selectB  =  'Mystery' + domainNumber + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                     '<?echo getOracleSelectionHTML($domain); ?>';
                                 optionsB.innerHTML = selectB;

                                 var domainNumber = 2;
                                 var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                 var selectB  =  'Curse'  + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                     '<?echo getOracleCurseSelectionHTML($domain); ?>';
                                 optionsB.innerHTML = selectB;
                             }


                        <?
                        }
                        ?>
                        <?
                        if ($key_1 == "path"){
                        ?>

                              if (selectField.value == "Cavalier"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Order' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getOrderSelectionHTML($domain); ?>';
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                                var domainNumber = 2;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Archetype' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getCavalierSelectionHTML($domain); ?>';
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Samurai"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Order' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getOrderSelectionHTML($domain); ?>';
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Witch"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Patron' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getPatronSelectionHTML($domain); ?>';
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Bloodrager"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Patron' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getBloodragerSelectionHTML($domain); ?>';
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Inquisitor"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Cleric Domain' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getDomainSelectionHTML($domain); ?>'
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Psychic Warrior"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Warrior Path' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getPsyWarrSelectionHTML($domain); ?>'
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Ranger"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Archetype' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getRangerSelectionHTML($domain); ?>'
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Rogue"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Archetype' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getRogueSelectionHTML($domain); ?>'
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Druid"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Archetype' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getDruidSelectionHTML($domain); ?>'
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                                var domainNumber = 2;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Domain (Only if no animal Companion)' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getDruidDomainSelectionHTML($domain); ?>';
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Bard"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Archetype' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getBardSelectionHTML($domain); ?>'
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Barbarian"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Archetype' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getBarbarianSelectionHTML($domain); ?>'
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Fighter"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Archetype' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getFighterSelectionHTML($domain); ?>'
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Monk"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Archetype' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getMonkSelectionHTML($domain); ?>'
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Gunslinger"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Archetype' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getGunslingerSelectionHTML($domain); ?>'
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Summoner"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Archetype' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getSummonerSelectionHTML($domain); ?>'
                      //          alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Alchemist"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Archetype' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getAlchemistSelectionHTML($domain); ?>'
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                              if (selectField.value == "Warpriest"){
                                var domainNumber = 1;
                                var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                var selectB  =  'Blessing' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                    '<?echo getWarpriestSelectionHTML($domain); ?>'
                          //      alert (selectB)
                                optionsB.innerHTML = selectB;
                              }
                        <?
                        }
                        ?>




                        if (selectField.value == "Wizard"){

                            var domainNumber = 1;
                            var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                            var selectB  =  'Wizard School' + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                  '<?echo getSchoolSelectionHTML($domain); ?>';
                            optionsB.innerHTML = selectB;
                            var domainNumber = 2;
                            var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                            var selectB  =  'Prohibited 1'  + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                  '<?echo getSchoolSelectionHTML($domain); ?>';
                            optionsB.innerHTML = selectB;
                            var domainNumber = 3;
                            var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                            var selectB  =  'Prohibited 2'  + '<SELECT NAME="domain_'+ classNumber + domainNumber + '" id="domain_'+ classNumber + domainNumber + '">' +
                                  '<?echo getSchoolSelectionHTML($domain); ?>';
                            optionsB.innerHTML = selectB;
                        }

                        <?
                        if ($key_1 == "path"){
                        ?>
                            if (selectField.value != "Cleric" && selectField.value != "Wizard"  && selectField.value != "Sorcerer"
                               && selectField.value != "Psion"  && selectField.value != "Cavalier"  && selectField.value != "Samurai" 
                               && selectField.value != "Witch"  && selectField.value != "Inquisitor" 
                               && selectField.value != "Summoner"  && selectField.value != "Inquisitor"
                               && selectField.value != "Rogue"  && selectField.value != "Druid"
                               && selectField.value != "Bard"  && selectField.value != "Barbarian"
                               && selectField.value != "Warpriest"  && selectField.value != "Barbarian"
                               && selectField.value != "Fighter"  && selectField.value != "Monk"   && selectField.value != "Bloodrager"
                               && selectField.value != "Gunslinger"  && selectField.value != "Oracle"  && selectField.value != "Alchemist"
                               && selectField.value != "Psychic Warrior" && selectField.value != "Ranger" ){

                               for  (var domainNumber = 1; domainNumber < 4; domainNumber++ ){

                                  var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                  var selectB  =  '';
                                  optionsB.innerHTML = selectB;
                               }
                            }
                        <?
                        }else{
                        ?>
                             if (selectField.value != "Cleric" && selectField.value != "Wizard" && selectField.value != "Psion"){

                               for  (var domainNumber = 1; domainNumber < 4; domainNumber++ ){

                                 var optionsB = document.getElementById("domain_" + classNumber + domainNumber);
                                 var selectB  =  '';
                                optionsB.innerHTML = selectB;
                               }
                            }
                        <?
                        }
                        ?>

                        


               	}
               	//	function changelevel(selectField, classNumber, currentlySelected ) {

		if ( document.getElementById("class_tp_" + classNumber) === null ) {
			return;
		}
              //  myphp?classNo=classNumber;
//		alert(<?echo $classNo;?>);
//                alert(currentlySelected);
           //     alert (document.getElementById("class_tp_" + classNumber).value);

		if (selectField.value != "" && selectField.value !=" " ){

			// alert (getSkillFocusArray(selectField.value) );
          //               alert (selectField.value);
		//	var focusArray = getSkillFocusArray(selectField.value) ;


			if (selectField.value  == "Archmage" || selectField.value  == "Hierophant"){
        //                   alert ("Archmage");
                          // gets old options i.e 1-10
                          var optionsA = document.getElementById("classlevel_" + classNumber).options;
		//alert (optionsA);

		/* Clear out old values */
                          while ( optionsA.length > 0  ) {
		              optionsA[0] = null;
                           }
                            <?PHP
                           while ($count < 5){
                             $count +=1;
                             $html .= '<OPTION VALUE="'.$count.'" '.$sel.' >'.$count.'</OPTION>';
                           }
                           ?>

                           var optionsB = document.getElementById("classlevel_" + classNumber);
                           var selectB = '<SELECT class="width4em" NAME="classLevel_' + classNumber + '" id="classlevel_' + classNumber + '">' + '<? echo $html; ?>';
                           optionsB.innerHTML = selectB;

                           var optionsC = document.getElementById("classlevel_" + classNumber).options;
                           for  (var Number = 1; Number < 6; Number++ ){
		              optionsC[Number -1].selected = false;
                           }
                           optionsC.select.selectedIndex = currentlySelected -1 ;


                        }
                }

}





	/*  Load the Skill Focus when the page is laoded as this cannot be done before */
function onLoadEvent() {


<?php
		if ( isset( $_POST["class_tp_1"] ) ) {
			// Call Javascript to populate filed
?>
				//alert(document.getElementById("class_tp_1"));	
				changeField( document.getElementById("class_tp_1"), 1, "<?php echo $_POST["classFocus_1"]; ?>" );  
<?php
		}

?>	

<?php
		if ( isset( $_POST["class_tp_2"] ) ) {
			// Call Javascript to populate filed
?>
				//alert(document.getElementById("class_tp_2"));
				changeField( document.getElementById("class_tp_2"), 2, "<?php echo $_POST["classFocus_2"]; ?>" );
<?php
		}
						
?>
<?php
		if ( isset( $_POST["class_tp_3"] ) ) {
			// Call Javascript to populate filed
?>
				//alert(document.getElementById("class_tp_2"));
				changeField( document.getElementById("class_tp_3"), 3, "<?php echo $_POST["classFocus_3"]; ?>" );
<?php
		}

?>

}




</SCRIPT>













