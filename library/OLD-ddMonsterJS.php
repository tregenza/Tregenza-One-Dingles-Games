<?php
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
  var newdiv = document.createElement('div');
  var divIdName = 'my'+num+'Div';
  newdiv.setAttribute('id',divIdName);
  newdiv.innerHTML = 'Element Number '+num+' has been added! <a href=\'#\' onclick=\'removeElement('+divIdName+')\'>Remove the div "'+divIdName+'"</a>';
  ni.appendChild(newdiv);
}
function removeElement(divNum) {
  var d = document.getElementById('myDiv');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}


	/* Returns array of valid skill focuses for classes */

	function getSkillFocusArray( classx ) {

		var classArray = new Array();

		<?PHP




		$loop = $loop + 1;
		$select = "SELECT class_tp from class ORDER BY class_tp";
		$link = getDBLink();;
		$result = mysqli_query($link, $select) ;
		while ($row = mysqli_fetch_array($result)) {
	    	$type = $row['class_tp'];
	     	if ($type != "") {
	     		$jScript = 'classArray["';

	     		$jScript .= $type . '"] = new Array( ';

		   		$select2 = "SELECT DISTINCT classf_focus from classfocus where classf_class = '$type' ORDER BY classf_class";
				//  echo $select . "</BR>";
				$link = getDBLink();
				$result2 = mysqli_query($link, $select2) ;
				$var = "";
				while ($row2 = mysqli_fetch_array($result2)) {
		        	  $classf_sel = $row2['classf_focus'] ;

		        	  $jScript .= '"'.$classf_sel . '", ';

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


	



	/** Replaces the OPTIONS for the Class Focus Select based on the class selected  */
	function changeField(selectField, classNumber, currentlySelected ) {
		
		if ( document.getElementById("classFocus_" + classNumber) === null ) {
			return;
		}
		
		//alert(selectField.value);
                //alert("Hello");
		var optionsA = document.getElementById("classFocus_" + classNumber).options;
		//alert (optionsA);
			
		/* Clear out old values */
		
		while ( optionsA.length > 0  ) { 
			optionsA[0] = null;
		}

		if (selectField.value != ""){
			
			//alert ( getSkillFocusArray(selectField.value) );

			var focusArray = getSkillFocusArray(selectField.value) ;
			
			for ( var lp = 0; lp < focusArray.length; lp++ ) {
				
				var optElement = document.createElement( "option" );
				optElement.text = focusArray[lp];
				optElement.value = focusArray[lp];
				optElement.selected = (  focusArray[lp] == currentlySelected ) ;
				optionsA.add(optElement);
				//alert( optElement );
				
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
		
	}

</SCRIPT>













