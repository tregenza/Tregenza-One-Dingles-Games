<?php
$url = get_site_url();
//echo "url = $url";
$domain =    $_SERVER['REQUEST_URI'];
//echo "domain = $domain";
$ddpost = $url . $domain;

/* New CT 15/6/18 */
$ddpost = home_url( add_query_arg( array(), $wp->request ) );


/*
*
*		HTML etc for displaying the monster
*
*/


/****   CT - TEMP HACK initialise variables to stop error ****/




?>
<?php
//ini_set('session.cache_limiter', 'private');
//header( 'Cache-Control: private, max-age=10800, pre-check=10800' );
?>


<?PHP



// Display Error message if any
if ($msg != ""){
	echo "<div class=\"error\">$msg</div>" ;
}

?>
	<FORM METHOD="post" class="tregenza_one_dg_form" ACTION="<?php echo $ddpost; ?>">
	<div class="buttonsWrapper">
<?php
  $x =  displayButtons1();
?>
		<p>Change any stats or equipment and add in any feats then press "Recalculate" to see the changes.</p>
		<p>Select "Plain Text Version" so you can copy and paste to your document.</p>
		</div>

			<ul class="stats">
				<li class="stats gainLayout">
					<h3 class="statsHeader">
                                        <?PHP echo $mon_name; if ($mon_temp != ""){
                                                                 if ($mon_temp2 != ""){
                                                                     echo "($mon_temp / $mon_temp2)";
                                                                 }else{
                                                                    echo "($mon_temp)";
                                                                 }
                                                              } ?>
                                        </h3>
					<p>
<?PHP
$cr_total = $cr + $cr_path;

if ( $class1_tp != "" and $class1_tp != " "  ) {
//    echo "level = $class1_level";
?>
<?php echo $class1_tp; ?>  [ <?php echo $class1_focus; ?> ]  Level:<?php echo getClassLevelHTML2( "1", "$class1_level")?>
<?php
        if ($domain_11 != "" ){
           if ($class1_tp == "Cleric"){
             echo "(Domains  $domain_11 and $domain_12)";
           }else{
                if ($class1_tp == "Wizard"){
                   echo "(School $domain_11  Prohibited  $domain_12 , $domain_13)";
                }else{
                      if ($class1_tp == "Sorcerer"){
                        echo "(Bloodline  $domain_11)";
                      }else{
                          if ($class1_tp == "Witch"){
                             echo "($domain_11)";
                          }else{
                             if ($class1_tp == "Cavalier"){
                                echo "($domain_11)";
                             }else{
                                 if ($class1_tp == "Inquisitor"){
                                      echo "(Domain  $domain_11)";
                                 }else{
                                    if ($class1_tp == "Ranger"){
                                      echo "(Archetype  $domain_11)";
                                    }else{
                                        if ($class1_tp == "Gunslinger"){
                                          echo "(Archetype  $domain_11)";
                                        }else{
                                          if ($class1_tp == "Bloodrager"){
                                           echo "($domain_11)";
                                          }else{
                                             if ($class1_tp == "Summoner"){
                                                echo "(Archetype $domain_11)";
                                             }
                                          }
                                        }
                                   }
                                 }
                             }
                          }
                      }
                }
           }
        }
	if ( $class2_tp	!= "" and $class2_tp != " " ) {
		echo " </p><p>";
?>
		<?php echo $class2_tp; ?> [ <?php echo $class2_focus; ?> ] Level: <?php echo getClassLevelHTML2( "2", "$class2_level")?>

<?php
           if ($domain_21 != "" ){
             if ($class2_tp == "Cleric"){
                  echo "(Domains  $domain_21 and $domain_22)";
             }else{
                  if ($class2_tp == "Wizard"){
                     echo "(School $domain_21  Prohibited  $domain_22 , $domain_23)";
                  }else{
                       if ($class2_tp == "Sorcerer"){
                         echo "(Bloodline  $domain_21)";
                       }
                  }
             }
           }



	}
 }
if ( $class3_tp != "" and $class3_tp != " ") {
   echo " </p><p>";
?>

   <?php echo $class3_tp; ?> [ <?php echo $class3_focus; ?> ] Level: <?php echo getClassLevelHTML2( "3", "$class3_level")?>
<?php
}

?>
					</p>

					<ul class="">
						<li><span class="greyText">Type test:</span> <span class="indent15">
                                                                   <?PHP if ((($mon_type == 'Animal' or $mon_type == 'Vermin') and $tem_type == 'Magical beast') or $tem_type != 'Magical beast'){
                                                                            echo $mon_type . ' '. $tem_type;
                                                                         }else{
                                                                            echo $mon_type;
                                                                         }
                                                                    ?>
                                                                   </span></li>
						<li ><span class="greyText">Size:</span> <span class="indent15"><SELECT NAME="mon_size" VALUE="<?PHP echo $mon_size ?>"><?PHP echo $sizeHTML; ?></SELECT></span></li>
						<li><span class="greyText">CR:</span> <span class="indent15"><?PHP echo $cr_total; ?></span></li>
					</ul>
				</li>
				<li class="stats gainLayout">
					<div class="bigBoxColumns">
						<div class="bigBoxColumn2">
							<div class="box">
								<p class="boxLabel">Racial Hit Dice</p>
								<p class="boxValue"> <?php echo $HD_HTML?></p>
							</div>
							<div class="box">
								<p class="boxLabel">Hit Points</p>
								<p class="boxValue greyText"><?php echo $total_hd ?></p>
								<p class="boxValue"><?php echo $total_hps ?></p>
							</div>
							<div class="attacks">
									<div class="box">
										<p class="boxLabel">Original Monster Base Attack</p>
										<p class="boxValue"><?php echo $mon_base_att ?></p>
		  								<div class="boxDetail fClearLeft">
                                             <p>Calculated Base Attack: +<?PHP echo $base_attack ?></p>
                                             <?php
                                             if ($key_1 != "path"){
								 echo  	"<p>Calculated Base Grapple: + $base_grapple </p>";
                                             }else{
                                                                 echo  	"<p>Calculated CMB: + $base_cmb </p>";
                                                                 echo  	"<p>Calculated CMD: + $base_cmd </p>";
                                             }
                                             ?>
		  								</div>
									</div>
									<div class="box">
										<p class="boxLabel">Primary Weapon</p>
										<p class="boxValue">
										<SELECT NAME="mon_weap_p" VALUE="<?PHP echo $mon_weap_p; ?>" >
											<?PHP echo $weaponHTML; ?>
										</SELECT>
										</p>
										<ul class="small">
											<li ><span class="greyText">Attack:</span><span class="indent40">+<?PHP echo $single_attack; ?></span></li>
											<li ><span class="greyText">Full Attack:</span><span class="indent40">+<?PHP echo $full_attack; ?></span></li>
											<li ><span class="greyText">Damage:</span><span class="indent40"><?PHP echo $damage_p; ?></span></li>
											<li><span class="greyText">Magic To Hit Mod:</span><span class="indent40"><?PHP echo $magic_tohit_p; ?></span></li>
											<li ><span class="greyText">Magic Damage Mod:</span><span class="indent40"><?PHP echo $magic_damage_p; ?></span></li>
										</ul>
									</div>

<INPUT class="button noPrint" TYPE="submit" NAME="extra_attack" VALUE="Add Extra Attack" style="height: 28px; width: 150px" />


 <?PHP

	foreach( $secondaryWeaponHTML as $sWHTML) {
		if ( $sWHTML ) {
	?>
									<div class="box">
										<?PHP echo $sWHTML; ?>
									</div>
	<?PHP
			}
	}
	?>
									<div class="box">
										<p class="boxLabel">Ranged Weapon</p>
										<p class="boxValue">
											<SELECT NAME="mon_weap_r" VALUE="<?PHP echo $mon_weap_r; ?>">
												<?PHP echo $rangeWeaponHTML; ?>
											</SELECT>
										</p>
										<ul class="small">
											<li ><span class="greyText">Attack:</span><span class="indent40">+<?PHP echo $single_ranged; ?></span></li>
											<li ><span class="greyText">Full Attack:</span><span class="indent40">+<?PHP echo $ranged_attack; ?></span></li>
											<li ><span class="greyText">Damage:</span><span class="indent40"><?PHP echo $damage_r; ?></span></li>
											<li><span class="greyText">Magic To Hit Mod:</span><span class="indent40"><?PHP echo $magic_tohit_r; ?></span></li>
											<li><span class="greyText">Magic Damage Mod:</span><span class="indent40"><?PHP echo $magic_damage_r; ?></span></li>
											<li ><span class="greyText">Range:</span><span class="indent40"><?PHP echo $weap_range_r; ?></span></li>
										</ul>
									</div>
							</div>
						</div>

						<div class="bigBoxColumn2  leftBorder">

						<div class="rightColWrapper ">
							<div class="box" >
								<p class="boxLabel">AC</p>
							        <?php
							  	$mon_ac_d = round($mon_ac,0);
								$ac_touch_d = round($ac_touch,0);
							  	$ac_flat_d = round($ac_flat,0);
							  	$magic_armour_d = round($magic_armour,0);
							  	$magic_shield_d = round($magic_shield,0);
							  	?>
								<p class="boxValue"><?PHP echo $mon_ac_d; ?></p>
								<ul class="small">

								        <li ><span class="greyText">Total AC:</span><span class="indent40"><?php echo $mon_ac_d; ?></span></li>
									<li ><span class="greyText">Deflection:</span><span class="indent40"><?php echo $ac_deflect; ?></span></li>
									<?php
									if ($ac_profane != ""){
                                                                        ?>
									  <li ><span class="greyText">Profane:</span><span class="indent40"><?php echo $ac_profane; ?></span></li>
                                                                        <?php
									}
									if ($ac_dodge != ""){
                                                                        ?>
                                                                          <li ><span class="greyText">Dodge:</span><span class="indent40"><?php echo $ac_dodge; ?></span></li>
									<?php
									}

                                                                        if ($ac_luck != ""){
                                                                        ?>
                                                                          <li ><span class="greyText">Luck:</span><span class="indent40"><?php echo $ac_luck; ?></span></li>
									<?php
									}
                                                                        if ($ac_insight != ""){
                                                                        ?>
                                                                          <li ><span class="greyText">Insight:</span><span class="indent40"><?php echo $ac_insight ?></span></li>
									<?php
									}
									$mon_ac_flat_1 = $mon_ac_flat - 10;
                                                                        ?>
                                                                        <li ><span class="greyText">Natural:</span><span class="indent40"><?php echo "($mon_ac_flat_1)" ?>
                                                                        + <?php echo $mon_nat_armour_ft . " = " . ($mon_ac_flat_1 + $mon_nat_armour_ft)?> </span></li>
									<li ><span class="greyText">Touch:</span><span class="indent40"><?php echo $ac_touch_d; ?></span></li>
									<li ><span class="greyText">Flat Footed:</span><span class="indent40"><?php echo $ac_flat_d; ?></span></li>
									<li ><span class="greyText">Armour:</span><span class="indent40">
									<SELECT NAME="mon_armour" VALUE="<?PHP echo $mon_armour ?>">
									<?PHP echo $armourHTML; ?>
									</SELECT></span>
									</li>
									<li ><span class="greyText">Magic Armour Mod:</span><span class="indent40"><?PHP echo $magic_armour_d; ?></span></li>
									<li ><span class="greyText">Shield:</span><span class="indent40">
									<SELECT NAME="mon_shield" VALUE="<?PHP echo $mon_shield ?>">
									<?PHP echo $shieldHTML; ?>
									</SELECT></span>
									</li>
									<li ><span class="greyText">Magic Shield Mod:</span><span class="indent40"><?PHP echo $magic_shield_d; ?></span></li>
								</ul>
							</div>
	 						<div class="box"  >
	 							<p class="boxLabel">Initiative</p>
								<p class="boxValue"><?php echo $init; ?></p>
								<ul class="boxDetail"></ul>
							</div>
							<div class="box" >
								<p class="boxLabel">Speed:</p>
								<p class="boxValue"><?php echo $monSpeedArray['land'] ?></p>
	 							<ul class="small">
	<?PHP
								foreach ($monSpeedArray as $speedKey => $speedValue ) {
										if ( $speedKey != 'base' && $speedKey != 'land' ) {
												if ( $speedValue !== "" and $speedValue !== "0" ) {
?>
	 								<li ><span class="greyText"><?php echo ucFirst($speedKey); ?>:</span><span class="indent40"><?PHP echo $speedValue; ?></span></li>
<?php
												}
										}
								}

	?>

							</div>
							<div class="box">
								<p class="boxLabel">Fortitude</p>
								<p class="boxValue"><?PHP echo $total_fort_sv ?></p>
								<ul class="boxDetail">
								</ul>
							</div>
							<div class="box">
								<p class="boxLabel">Reflex</p>
								<p class="boxValue"><?php echo $total_reflex_sv ?></p>
								<ul class="boxDetail">
								</ul>
							</div>
							<div class="box">

								<p class="boxLabel">Will</p>
								<p class="boxValue"><?php echo $total_will_sv ?></p>
								<ul class="boxDetail">
								</ul>
							</div>
						</div>

						</div>

					</div>


				</li>
				<div class="gainLayout">
				 <INPUT class="button noPrint" TYPE="submit" NAME="print_ind" VALUE="Recalculate" style="height: 28px; width: 150px" />
				</div>
				<li class="stats gainLayout">
					<div class="bigBoxColumns">
						<div class="bigBoxColumn2">
							<div class="box">
								<p class="boxLabel">Special Attacks</p>
	 							<ul>
	<?PHP
	echo $monkHTML;
	echo $monsterSpecialHTML;
	?>
								</ul>
							</div>
						</div>
						<div class="bigBoxColumn2 leftBorder">
							<div class="rightColWrapper">
								<div class="box">
									<p class="boxLabel">Race Special Abilities</p>
									<ul class="specialAbility">
		<?PHP
		echo $specialAbilitiesHTML;
		?>
                							</ul>
								</div>
							</div>
						</div>
					</div>
				</li>
				<div class="box">
				<p class="boxLabel">Attributes</p>
                                <p id="total_attr" >Attribute Points to spend <INPUT TYPE="text" id="attr_spent" NAME="attr_spent" VALUE="<?PHP echo $attr_spent; ?>" readonly></p>
				<TABLE>
				       <TR>
				       <TD width=100px>Ability</TD>
				       <TD width=100px>Original</TD>
				       <TD width=100px>Magic</TD>
				       <TD width=100px>Total</TD>
                                       <TD width=100px>Bonus</TD>
				       </TR>
				       <TR>
				          <TD>
				<?php
                                           disAttr2("Str",$mon_str);
                                ?>
                                         </TD>
                                         <TD>+ <?php echo $mon_str_m ?></TD>
                                         <TD>= <?php echo $mon_str + $mon_str_m?></TD>
                                         <TD>
                                            <?php if ($mon_str_bonus <= 0){
                                                      echo "";
                                                  }else{
                                                    echo "+";
                                                  }

                                                  echo $mon_str_bonus
                                             ?>
                                         </TD>
                                       </TR>
                                       <TR>
                                         <TD>
                                         <?php
					  disAttr2("Dex",$mon_dex);
                                         ?>
                                         </TD>
                                         <TD>+ <?php echo $mon_dex_m ?></TD>
                                         <TD>= <?php echo $mon_dex + $mon_dex_m?></TD>
                                         <TD>
                                            <?php if ($mon_dex_bonus <= 0){
                                                     echo "";
                                                  }else{
                                                     echo "+";
                                                  }

                                                  echo $mon_dex_bonus
                                             ?>
                                         </TD>
                                       </TR>
                                       <TR>
                                         <TD>
                                       <?php
					  disAttr2("Con",$mon_con);
                                       ?>
                                         <TD>+ <?php echo $mon_con_m ?></TD>
                                         <TD>= <?php echo $mon_con + $mon_con_m?></TD>
                                         <TD>
                                            <?php if ($mon_con_bonus <= 0){
                                                     echo "";
                                                  }else{
                                                    echo "+";
                                                 }

                                                 echo $mon_con_bonus
                                             ?>
                                         </TD>
                                       </TR>
                                       <TR>
                                         <TD>
                                <?php
                                	  disAttr2("Int",$mon_int);
                                ?>
                                         </TD>
                                         <TD>+ <?php echo $mon_int_m ?></TD>
                                         <TD>= <?php echo $mon_int + $mon_int_m?> </TD>
                                         <TD>
                                            <?php if ($mon_int_bonus <= 0){
                                                    echo "";
                                                  }else{
                                                    echo "+";
                                                  }

                                                  echo $mon_int_bonus
                                             ?>
                                         </TD>
                                       </TR>
                                        <TR>
                                         <TD>
                                       <?php
				          disAttr2("Wis",$mon_wis);
                                       ?>
                                         </TD>
                                         <TD>+ <?php echo $mon_wis_m ?></TD>
                                         <TD>= <?php echo $mon_wis + $mon_wis_m?></TD>
                                         <TD>
                                            <?php if ($mon_wis_bonus <= 0){
                                                    echo "";
                                                  }else{
                                                    echo "+";
                                                  }

                                                  echo $mon_wis_bonus
                                             ?>
                                         </TD>
                                       </TR>

                                       <TR>
                                         <TD>
                                       <?php
                                          disAttr2("Chr",$mon_chr);
                                       ?>
                                        </TD>
                                       <TD>+ <?php echo $mon_chr_m ?></TD>
                                       <TD>= <?php echo $mon_chr + $mon_chr_m?></TD>
                                       <TD>
                                            <?php if ($mon_chr_bonus <= 0){
                                                    echo "";
                                                  }else{
                                                    echo "+";
                                                  }

                                                  echo $mon_chr_bonus
                                             ?>
                                         </TD>
                                     </TR>
				</TABLE>
                                <li class="stats noBorder errorText">
<?php
if ( $attrErrorsHTML != "" ) {
?>
							<h4>Attribute Warning</h4>
<?php
echo $attrErrorsHTML;
}

?>
                                </li>
                                </div>
				<div class="gainLayout">

                                <INPUT class="button noPrint" TYPE="submit" NAME="print_ind" VALUE="Recalculate" style="height: 28px; width: 150px" />
				</div>
				<li class="stats noBorder">
					<div class="bigBoxThreeColumns">
						<p class="bigBoxLabel">Feats</p>
						<div class="bigBoxColumn3">
							<ul >
<?PHP
// General feats first
echo $featsHTML[3];
?>
							</ul>

						</div>
						<div class="bigBoxColumn3">
							<ul>
<?PHP
echo $featsHTML[1];
?>
							</ul>
						</div>
						<div class="bigBoxColumn3">
							<ul >
<?PHP
echo $featsHTML[2];
?>
							</ul>
						</div>
						<div class="bigBoxColumn3">
							<ul >
<?PHP
echo $featsHTML[4];
?>
							</ul>
						</div>
						<div class="bigBoxColumn3">
							<ul >
<?PHP
if (isset($featsHTML[6])){
   echo $featsHTML[5];
}
?>
							</ul>
						</div>
						<div class="bigBoxColumn3">
							<ul >
<?PHP
if (isset($featsHTML[6])){
   echo $featsHTML[6];
}
?>
							</ul>
						</div>
						<div class="bigBoxColumn3">
							<ul >
<?PHP
if (isset($featsHTML[7])){
  echo $featsHTML[7];
}
?>
							</ul>
						</div>



					</div>
				</li>
				<li class="stats noBorder errorText">
<?php
if ( $featErrorsHTML != "" ) {
?>
							<h4>Feat Errors</h4>
<?php
echo $featErrorsHTML;
}

?>
				</li>
<?php
if ($fighter_weapHTML != ""){
?>

                                <li class = "stats">
                                <div class = "box">
                                <p class="bigBoxLabel">
                                         Fighter Weapon Training
				</p>



<?php
echo $fighter_weapHTML;
?>
                                 </div>
                                 </li>
<?php
}
if ($path2_HTML != ""){
?>

                                <li class = "stats">
                                <div class = "box">
                                <p class="bigBoxLabel">
                                         Psionic warrior 2nd Path
				</p>


                                 <p>
<?php
echo $path2_HTML;
?>
                                 </p>
                                 </div>
                                 </li>
<?php
}

?>
<?php
if ($key_1 == "dd35" or $key_1 == "path" ){
?>
<li class="stats noPrint">
<p>
If Stats have changed (e.g. magic items added) other default feats may have become available</p>
<p>
Repopulate Feats? <SELECT NAME='repopulate_feats' style="width: 50px">
                 <OPTION VALUE = "N" SELECTED>N</OPTION>
                 <OPTION VALUE = "Y">Y</OPTION>
                 </SELECT>
</p>
</li>
<?php
}
?>
				<div class="gainLayout">
 <INPUT class="button noPrint" TYPE="submit" NAME="print_ind" VALUE="Recalculate" style="height: 28px; width: 150px" />
</div>
<li class="stats noPrint">
  <div class="box">
    <p class="boxLabel">
							Feat Help
    </p>

     <p>
	<SELECT id="helpFeat" NAME="feathelp" style="width: 700px"  onchange="changeText('feathelp')">
<?PHP
echo $featHelpHTML;
?>
	</SELECT>
						</p>
  </div>
</li>


<li class="stats noPrint">
  <TABLE>
     <TR>
       <TD id="helpText"></TD>
     </TR>
  </TABLE>
</li>

<li class="stats noPrint">
   <div class="box">
     <p>
<?php
if ($key_1 == "path"){
?>
         <a href="http://www.d20pfsrd.com/feats/feat-tree" target="pathsrdtree">Window to D20 pathfinder SRD Feats Tree</a>
 <?php
}else{
?>
         <a href="http://www.d20srd.org/indexes/feats.htm" target="d20srdtree">Window to D20 SRD Feats Tree</a>
<?php
}
?>
     </p>
  </div>
</li>

<?php
if ($psi_cmb_HTML != ""){
?>

                                <li class = "stats">
                                <div class = "box">
                                <p class="bigBoxLabel">
                                         Psionic Combat Modes   (Power Points = <?php echo $psi_pts; ?>)
				</p>



<?php
echo $psi_cmb_HTML;
}
?>

				<li class="stats noBorder">
					<div class="box">
						<p class="bigBoxLabel">Skills</p>
						<p class="fClear greyText">
						Skill Points -
						<?php
						        echo $mon_name.": ". $mon_skill_points_total;
							if ( $class1_tp != "" ) {
									echo "; " . $class1_tp.": ".$class1_skill_points;
									if ( $class2_tp != "" ) {
										echo "; ".$class2_tp.": ".$class2_skill_points;

									}
									if ( $class3_tp != "" ) {
										echo "; ".$class3_tp.": ".$class3_skill_points;

									}
							}
							if ($skill2_left > 0){
                                                           echo "; Unspent :" . $skill2_left;
                                                        }
                                                  //      if ($key_1 == "path"){
                                                        ?>
                                                        <p id="total_skill" >Skill Points to spend <INPUT TYPE="text" id="skill_spent" NAME="skill_spent" VALUE="<?PHP echo $skill_spent ?>" readonly></p>
                                                        <?php
                                                 //       }
                                                ?>

						<TABLE class="skills">
							<TR class="skillHeadings">
							   <TH></TH>
							   <TH>Total</TH>
							   <TH>Ranks</TH>
							   <TH>Stat Bonus</TH>
							   <TH>Misc Bonus</TH>
							</TR>
<?php
//if ($key_1 == "path"){
   echo $skillsHTML2;
   echo $skillsHTML3;
//}else{
//   echo $skillsHTML;
//}

?>

						</TABLE>
<?php
echo $skill_race_desc;
?>
					</div>
				</li>
				<li class="stats noBorder errorText">
<?php
if ( $skillErrorsHTML != "" ) {
?>
							<h4>Skill Warning</h4>
<?php
echo $skillErrorsHTML;
}

?>
				</li>
<p>
				<div class="gainLayout">

<INPUT class="button noPrint" TYPE="submit" NAME="print_ind" VALUE="Recalculate" style="height: 28px; width: 150px" />
</div>
</p>
<li class="stats noBorder">
<p class="bigBoxLabel">Pre-Buffed Spells/Powers</p>
<TABLE>
<TR>
<TD>
<?php
$html_level = buff_level(1);
echo $html_level;
echo "</TD></TR><TR><TD>";
$html_buff = buff_html(1);
echo $html_buff;
$html_buff = buff_html(2);
echo $html_buff;
$html_buff = buff_html(3);
echo $html_buff;
echo "</TD></TR><TR><TD>";
$html_level = buff_level(2);
echo $html_level;
echo "</TD></TR><TR><TD>";
$html_buff = buff_html(4);
echo $html_buff;
$html_buff = buff_html(5);
echo $html_buff;
$html_buff = buff_html(6);
echo $html_buff;
echo "</TD></TR><TR><TD>";
$html_level = buff_level(3);
echo $html_level;
echo "</TD></TR><TR><TD>";
$html_buff = buff_html(7);
echo $html_buff;
$html_buff = buff_html(8);
echo $html_buff;
$html_buff = buff_html(9);
echo $html_buff;
?>
</TD>
</TR>
</TABLE>
</li>
				<div class="gainLayout">

<INPUT class="button noPrint" TYPE="submit" NAME="print_ind" VALUE="Recalculate" style="height: 28px; width: 150px" />
</div>
<?php


if ($spellsOneHTML || $spellsTwoHTML || $spellsThreeHTML || $spellsMonHTML ) {
?>
				<li class="stats noBorder">
					<div class="box">
						<p class="bigBoxLabel">Spells</p>
						<TABLE class="skills">
							<TR class="skillHeadings">
								<TH></TH>
								<TH colspan="9">Spell Level</TH>
							</TR>
							<TR class="skillHeadings">
							   <TH class="width8em">Class</TH>
							   <TH class="width4em">0th</TH>
							   <TH class="width4em">1st</TH>
							   <TH class="width4em">2nd</TH>
							   <TH class="width4em">3rd</TH>
							   <TH class="width4em">4th</TH>
							   <TH class="width4em">5th</TH>
							   <TH class="width4em">6th</TH>
							   <TH class="width4em">7th</TH>
							   <TH class="width4em">8th</TH>
							   <TH class="width4em">9th</TH>
							</TR>
<?PHP
	echo $spellsOneHTML;
	echo $spellsTwoHTML;
	echo $spellsThreeHTML;
	echo $spellsMonHTML;
?>

						</TABLE>
					</div>

				</li>
                               <div>
<?PHP
         if ($class1_spat != "" or $class1_psi == "Y"){
            $HTML = spells(1);
            echo $HTML;
         }
         if ($class2_spat != "" or $class2_psi == "Y"){
            $HTML = spells(2);
            echo $HTML;
         }
         if ($class3_spat != "" or $class3_psi == "Y"){
            $HTML = spells(3);
             echo $HTML;
         }
         if ($classm_spat != ""){
            $HTML = spells("m");
            echo $HTML;
         }
?>
                               </div>
<?php
}	// End of spells

if ($classSpecialsOneHTML) {
?>
				<li class="stats noBorder">
					<div class="box">
						<p class="bigBoxLabel">Class Special Abilities</p>
<?PHP
	if ($classSpecialsOneHTML ) {
?>
						<TABLE class="classSpecials">
							<TR class="classSpecialHeading">
							   <TH  class="classSpecialName"></TH>
							   <TH  class="classSpecialDesc">Description</TH>
							   <TH  class="classSpecialValue">Number / Value</TH>
							</TR>
<?PHP
		echo $classSpecialsOneHTML;
?>

						</TABLE>
<?PHP
	}

?>
					</div>
				</li>
<?PHP
}	// END of Class Specials
?>

				<h4>Magic Items</h4>
				<TABLE>
				<TR>
				    <TH>Maximum gp</TH>
				    <TH>  </TH>
				    <TH>Total spent</TH>
                                 </TR>
                                 <TR>
                                    <TD><?php echo $total_gp?></TD>
                                    <TD>  </TD>
                                    <TD id="total_GP" > <INPUT TYPE="text" id="total_spent" NAME="total_spent" VALUE="<?PHP echo $total_spent ?>" readonly></TD>
                                 </TR>
                                 </TABLE>
				 <li class="stats">
				    <div class="box">
				       <p class = "boxLabel">
				        <TABLE>
				         <TR>
				         <TH></TH>
				         <TH></TH>
				         </TR>
				         <TR>

<?PHP
if ($class1_tp == "Psion" or $class2_tp == "Psion"){
      $HTML = magicItems("PSICRYSTAL","1");
      echo  "<TD>Psicrystal</TD>" ;
      echo  "<TD>" . $HTML . "</TD>" ;
      echo "</TR><TR>";
}
$HTML = magicItems("WEAPONA","1");
echo  "<TD>Weapon Primary</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
//if  ($mon_key_1 == "xxx"){
$HTML = magicItems("WEAPONA_SPEC","1");
echo  "<TD>Weapon Special Ability</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
//}
if ($mon_key_1 == "path" or $game == "path"){
   $HTML = magicItems("WEAPONA_MAT","1");
   echo  "<TD>Weapon Material</TD>" ;
   echo  "<TD>" . $HTML . "</TD>" ;
   echo "</TR><TR>";
}
$HTML = magicItems("WEAPONB","2");
echo  "<TD>Weapon Seondary</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
//if  ($mon_key_1 == "xxx"){
$HTML = magicItems("WEAPONB_SPEC","2");
echo  "<TD>Weapon Secondary Special Ability</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
//}
if ($mon_key_1 == "path" or $game == "path"){
   $HTML = magicItems("WEAPONB_MAT","2");
   echo  "<TD>Weapon Secondary Material</TD>" ;
   echo  "<TD>" . $HTML . "</TD>" ;
   echo "</TR><TR>";
}

$HTML = magicItems("WEAPONR","1");
echo  "<TD>Ranged Weapon</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
//if  ($mon_key_1 == "xxx"){
$HTML = magicItems("WEAPONR_SPEC","1");
echo  "<TD>Weapon Special Ability</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
//}
$HTML = magicItems("SHIELD","1");
echo  "<TD>Shield</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
//if  ($mon_key_1 == "xxx"){
$HTML = magicItems("SHIELD_SPEC","1");
echo  "<TD>Shield Special Ability</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
//}
$HTML = magicItems("HEAD","1");
echo  "<TD>Head</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("EYES","1");
echo  "<TD>Eyes</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("AMULET","1");
echo  "<TD>Neck</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("VEST","1");
echo  "<TD>Vest</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("ARMOUR","1");
echo  "<TD>Armour</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
//if  ($mon_key_1 == "xxx"){
$HTML = magicItems("ARMOUR_SPEC","1");
echo  "<TD>Armour Special Ability</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
if ($armour_cd == "1" and ($mon_key_1 == "path" or $game == "path")){
   $HTML = magicItems("ARMOURL_MAT","1");
   echo  "<TD>Armour Material</TD>" ;
   echo  "<TD>" . $HTML . "</TD>" ;
   echo "</TR><TR>";
}
if ($armour_cd == "2" and ($mon_key_1 == "path" or $game == "path")){
   $HTML = magicItems("ARMOURM_MAT","1");
   echo  "<TD>Armour Material</TD>" ;
   echo  "<TD>" . $HTML . "</TD>" ;
   echo "</TR><TR>";
}
if ($armour_cd == "3" and ($mon_key_1 == "path" or $game == "path")){
   $HTML = magicItems("ARMOURH_MAT","1");
   echo  "<TD>Armour Material</TD>" ;
   echo  "<TD>" . $HTML . "</TD>" ;
   echo "</TR><TR>";
}
$HTML = magicItems("BELT","1");
echo  "<TD>Belt</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("CLOAK","1");
echo  "<TD>Cloak</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("BRACERS","1");
echo  "<TD>Bracers</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("GLOVES","1");
echo  "<TD>Gloves</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("RING","1");
echo  "<TD>Ring -1 </TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("RING","2");
echo  "<TD>Ring -2</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("BOOTS","1");
echo  "<TD>Boots</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";

$HTML = magicItems("MISC","1");
echo  "<TD>Misc -1</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("MISC","2");
echo  "<TD>Misc -2</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("MISC","3");
echo  "<TD>Misc -3</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("MISC","4");
echo  "<TD>Misc -4</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("WAND","1");
echo  "<TD>Wand/Staff 1</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("WAND","2");
echo  "<TD>Wand/Staff 2</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("WAND","3");
echo  "<TD>Wand/Staff 3</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("WAND","4");
echo  "<TD>Wand/Staff 4</TD>" ;
echo  "<TD>" . $HTML . "</TD>" ;
echo "</TR><TR>";
$HTML = magicItems("POTIONS","1");
echo  "<TD>Potion 1</TD>" ;
echo  "<TD>" . $HTML . "</TD>";
echo "</TR><TR>";
$HTML = magicItems("POTIONS","2");
echo  "<TD>Potion 2</TD>" ;
echo  "<TD>" . $HTML . "</TD>";
echo "</TR><TR>";
$HTML = magicItems("POTIONS","3");
echo  "<TD>Potion 3</TD>" ;
echo  "<TD>" . $HTML . "</TD>";
echo "</TR><TR>";
$HTML = magicItems("POTIONS","4");
echo  "<TD>Potion 4</TD>" ;
echo  "<TD>" . $HTML . "</TD>";
echo "</TR><TR>";
$HTML = magicItems("SCROLL","1");
echo  "<TD>Scroll 1</TD>" ;
echo  "<TD>" . $HTML . "</TD>";
echo "</TR><TR>";
$HTML = magicItems("SCROLL","2");
echo  "<TD>Scroll 2</TD>" ;
echo  "<TD>" . $HTML . "</TD>";
echo "</TR><TR>";
$HTML = magicItems("SCROLL","3");
echo  "<TD>Scroll 3</TD>" ;
echo  "<TD>" . $HTML . "</TD>";
echo "</TR><TR>";
$HTML = magicItems("SCROLL","4");
echo  "<TD>Scroll 4</TD>" ;
echo  "<TD>" . $HTML . "</TD>";



//			</ul>
?>                                      </TR>
                                        </TABLE>
                                       </p>
                                    </div>
<?PHP

?>
        <p class="boxLabel"><b>Description/Notes</b></p>
        <div COLSPAN="4" ><TEXTAREA class="desc"  NAME="savemon_desc" ROWS="10" COLS="60"><?php echo $savemon_desc ?></TEXTAREA> </div>
                                 </li>

<?PHP
/*
style="background-color: lightgrey"
$print = "Name:" . "\n" .
         $mon_name . " (" . $mon_size . " " . $mon_type . ")" . "\n" .
         $class1_tp . " level " . $class1_level . " (skill points " . $class1_skill_points  . ") " . $class1_focus . "\n";
if ($domain_11 != ""){
   $print .= "Domains  $domain_11 and $domain_12 \n";
}
if ($class2_tp != ""){
     $print .=  $class2_tp . " level " . $class2_level . " (skill points " . $class2_skill_points  . ") " . $class2_focus . "\n";
     if ($domain_21 != ""){
         $print .= "Domains  $domain_21 and $domain_22 \n";
     }
}
$print .= "Hit die: " . $total_hd . "(" .$total_hps . "hp)" . "\n" .
          "Init: " . $init . "\n" .
          "Speed: " . $speed_land;
if (($mon_speed_fly != "0" or $mon_speed_climb != "0" or $mon_speed_swim != "0" or $mon_speed_burrow != "0") and
	    ($mon_speed_fly != "" or $mon_speed_climb != "" or $mon_speed_swim != "" or $mon_speed_burrow != "")) {
   $print .=  ",fly " . $mon_speed_fly . ",swim " . $mon_speed_swim . ",climb " . $mon_speed_climb . ",burrow " . $mon_speed_burrow . "\n";
}else{
  $print .= "\n";
}
if (substr($magic_armour,0,1) == "+"){
   $print .= "AC: " . $mon_ac . " " . $magic_armour . " " . $mon_armour . " " . $magic_shield . " " . $mon_shield . "\n";
}else{
   $print .= "AC: " . $mon_ac . " +" . $magic_armour . " " . $mon_armour . " +" . $magic_shield . " " . $mon_shield . "\n";
}

$print .=  "AC flat footed :" . $ac_flat . "\n";
$print .= "AC Touch: " . $ac_touch . "\n";
$print  .= "Base Attack/Grapple: " . $base_attack . "/" . $base_grapple . "\n";
if ($magic_tohit_p != "" or $magic_damage_p != ""){
   if (substr($magic_tohit_p,0,1) == "+"){
     $magic_p = "(" . $magic_tohit_p . "/" . $magic_damage_p . ") ";
   }else{
     $magic_p = "(+" . $magic_tohit_p . "/+" . $magic_damage_p . ") ";
   }
}else{
  $magic_p = " ";
}
if ($magic_tohit_r != "" or $magic_damage_r != ""){
  if (substr($magic_tohit_r,0,1) == "+"){
   $magic_r = "(" . $magic_tohit_r . "/" . $magic_damage_r . ") ";
  }else{
   $magic_r = "(+" . $magic_tohit_r . "/+" . $magic_damage_r . ") ";
  }
}else{
   $magic_r = " ";
}
$print .= "Attack: +" . $single_attack . " " . $magic_p . $mon_weap_p . " " . $damage_p . "\n";
if ($mon_weap_r != "None"){
    $print .=  "    or  +" . $single_ranged . " " . $magic_r . $mon_weap_r . " " . $damage_r . "\n";
}
$print .= "Full attack: +" . $full_attack . " "  . $magic_p . $mon_weap_p . " " . $damage_p . "\n";
if ($mon_weap_s1 != "No Melee"){
   $print .= $print_secondary_attacks;
}
if ($mon_weap_r != "None"){
    $print .=  "    or  +" . $ranged_attack . " " . $magic_r . $mon_weap_r . " " . $damage_r . "(range " . $weap_range_r .")"  ."\n";
}
if ($class1_tp == "Monk" or $class2_tp == "Monk") {
  $print .= "    or Flurry of blows +" . $flurry . " " . $flurry_damage ."\n";
}
$print .= "Space/Reach: " . $mon_space . "/" . $mon_reach . "\n";
$print .= "Special Attacks: "  . $print_special_attacks . "\n";
$print .= "Special Qualities: " . $print_special_qualities . "\n";
$print .= "Saves: Fort +" . $total_fort_sv . ", Ref +" . $total_reflex_sv . ", Will +" . $total_will_sv . "\n";
$print .= "Abilities: Str " . $mon_str . ", Dex " . $mon_dex . ", Con " . $mon_con . ", Int " . $mon_int . ", Wis " . $mon_wis . ", Chr " . $mon_chr ."\n";
$print .= "Skills: " . $print_skill . "\n";
$print .= "Feats: " . $print_feat . "\n";
$print .=  "CR: " . $cr . "\n";
//$print .= "Class Specials: " . $print_class_special . "\n";
$print .= "Spells Known: " ."\n";
//echo $class1_spat;
if ($class1_spat != ""){
   $print .= printSpells(1);
}
if ($class2_spat != ""){
   $print .= printSpells(2);
}
*/

$_POST[ "status" ] = "VETTED";
if(isset($mon_print)){
}else{
   $mon_print = "";
}
if(isset($domain_11)){
}else{
   $domain_11 = "";
}
if(isset($domain_12)){
}else{
   $domain_12 = "";
}
if(isset($domain_13)){
}else{
   $domain_13 = "";
}
if(isset($domain_21)){
}else{
   $domain_21 = "";
}
if(isset($domain_22)){
}else{
   $domain_22 = "";
}
if(isset($domain_23)){
}else{
   $domain_23 = "";
}
?>
<INPUT TYPE="hidden" NAME="status", VALUE="VETTED"/>
<INPUT TYPE="hidden" NAME="mon_sv_fort", VALUE="<?php echo $mon_sv_fort?>"/>
<INPUT TYPE="hidden" NAME="mon_sv_will", VALUE="<?php echo $mon_sv_will?>"/>
<INPUT TYPE="hidden" NAME="mon_space", VALUE="<?php echo $mon_space?>"/>
<INPUT TYPE="hidden" NAME="mon_reach", VALUE="<?php echo $mon_reach?>"/>
<INPUT TYPE="hidden" NAME="mon_sv_reflex", VALUE="<?php echo $mon_sv_reflex?>"/>
<INPUT TYPE="hidden" NAME="mon_print", VALUE="<?php echo $mon_print?>"/>
<INPUT TYPE="hidden" NAME="domain_11", VALUE="<?php echo $domain_11?>"/>
<?PHP
//echo "here";
if ($path2_HTML == "" or $class1_tp != "Psychic Warrior"){
?>
     <INPUT TYPE="hidden" NAME="domain_12", VALUE="<?php echo $domain_12?>"/>
<?PHP
}
?>
<INPUT TYPE="hidden" NAME="domain_13", VALUE="<?php echo $domain_13?>"/>
<INPUT TYPE="hidden" NAME="domain_21", VALUE="<?php echo $domain_21?>"/>
<?PHP
if ($path2_HTML == "" or $class2_tp != "Psychic Warrior"){
?>
			<INPUT TYPE="hidden" NAME="domain_22", VALUE="<?php echo $domain_22; ?>"/>
<?php
}
if (isset($savemon_name)){
}else{
    $savemon_name  = "";
    $savemon_camp  = "";
    $savemon_sub   = "";
}
if (isset($print_init)){
    $print_init = "";
}
if (isset($init_text)){
    $init_text = "";
}
if (!isset($skill_left_flag)){
     $skill_left_flag = "";
}
if  (isset($classm_spell_level)){
    $classm_spell_level = "";
}
if (!isset($magic_s1)){
    $magic_s1 = "";
}    
?>
<INPUT TYPE="hidden" NAME="domain_23", VALUE="<?php echo $domain_23?>"/>
<INPUT TYPE="hidden" NAME="domain_31", VALUE="<?php echo $domain_31?>"/>
<INPUT TYPE="hidden" NAME="domain_32", VALUE="<?php echo $domain_32?>"/>
<INPUT TYPE="hidden" NAME="domain_33", VALUE="<?php echo $domain_33?>"/>
<INPUT TYPE="hidden" NAME="class1_spat", VALUE="<?php echo $class1_spat?>"/>
<INPUT TYPE="hidden" NAME="class2_spat", VALUE="<?php echo $class2_spat?>"/>
<INPUT TYPE="hidden" NAME="class3_spat", VALUE="<?php echo $class3_spat?>"/>
<INPUT TYPE="hidden" NAME="classm_spat", VALUE="<?php echo $classm_spat?>"/>
<INPUT TYPE="hidden" NAME="print_special_attacks", VALUE="<?php echo $print_special_attacks?>"/>
<INPUT TYPE="hidden" NAME="print_special_attacks_s", VALUE="<?php echo $print_special_attacks_s?>"/>
<INPUT TYPE="hidden" NAME="print_special_qualities", VALUE="<?php echo $print_special_qualities?>"/>
<INPUT TYPE="hidden" NAME="htmlp_special_qualities_s", VALUE="<?php echo $htmlp_special_qualities_s?>"/>
<INPUT TYPE="hidden" NAME="print_skill", VALUE="<?php echo $print_skill?>"/>
<INPUT TYPE="hidden" NAME="print_feat", VALUE="<?php echo $print_feat?>"/>
<INPUT TYPE="hidden" NAME="flurry", VALUE="<?php echo $flurry?>"/>
<INPUT TYPE="hidden" NAME="flurry_damage", VALUE="<?php echo $flurry_damage?>"/>
<INPUT TYPE="hidden" NAME="class1_skill_points", VALUE="<?php echo $class1_skill_points?>"/>
<INPUT TYPE="hidden" NAME="class2_skill_points", VALUE="<?php echo $class2_skill_points?>"/>
<INPUT TYPE="hidden" NAME="class3_skill_points", VALUE="<?php echo $class3_skill_points?>"/>
<INPUT TYPE="hidden" NAME="user", VALUE="<?php echo $user?>"/>
<INPUT TYPE="hidden" NAME="total_hd", VALUE="<?php echo $total_hd?>"/>
<INPUT TYPE="hidden" NAME="init", VALUE="<?php echo $init?>"/>
<INPUT TYPE="hidden" NAME="mon_ac", VALUE="<?php echo $mon_ac?>"/>
<INPUT TYPE="hidden" NAME="mon_environment", VALUE="<?php echo $mon_environment?>"/>
<INPUT TYPE="hidden" NAME="ac_flat", VALUE="<?php echo $ac_flat?>"/>
<INPUT TYPE="hidden" NAME="ac_touch", VALUE="<?php echo $ac_touch?>"/>
<INPUT TYPE="hidden" NAME="base_attack", VALUE="<?php echo $base_attack?>"/>
<INPUT TYPE="hidden" NAME="base_grapple", VALUE="<?php echo $base_grapple?>"/>
<INPUT TYPE="hidden" NAME="single_attack", VALUE="<?php echo $single_attack?>"/>
<INPUT TYPE="hidden" NAME="single_ranged", VALUE="<?php echo $single_ranged?>"/>
<INPUT TYPE="hidden" NAME="full_attack", VALUE="<?php echo $full_attack?>"/>
<INPUT TYPE="hidden" NAME="ranged_attack", VALUE="<?php echo $ranged_attack?>"/>
<INPUT TYPE="hidden" NAME="total_fort_sv", VALUE="<?php echo $total_fort_sv?>"/>
<INPUT TYPE="hidden" NAME="total_reflex_sv", VALUE="<?php echo $total_reflex_sv?>"/>
<INPUT TYPE="hidden" NAME="total_will_sv", VALUE="<?php echo $total_will_sv?>"/>
<INPUT TYPE="hidden" NAME="mon_str_bonus", VALUE="<?php echo $mon_str_bonus?>"/>
<INPUT TYPE="hidden" NAME="mon_dex_bonus", VALUE="<?php echo $mon_dex_bonus?>"/>
<INPUT TYPE="hidden" NAME="mon_con_bonus", VALUE="<?php echo $mon_con_bonus?>"/>
<INPUT TYPE="hidden" NAME="mon_int_bonus", VALUE="<?php echo $mon_int_bonus?>"/>
<INPUT TYPE="hidden" NAME="mon_wis_bonus", VALUE="<?php echo $mon_wis_bonus?>"/>
<INPUT TYPE="hidden" NAME="mon_chr_bonus", VALUE="<?php echo $mon_chr_bonus?>"/>
<INPUT TYPE="hidden" NAME="mon_type", VALUE="<?php echo $mon_type?>"/>
<INPUT TYPE="hidden" NAME="damage_r", VALUE="<?php echo $damage_r?>"/>
<INPUT TYPE="hidden" NAME="damage_p", VALUE="<?php echo $damage_p?>"/>
<INPUT TYPE="hidden" NAME="weap_range_r", VALUE="<?php echo $weap_range_r?>"/>
<INPUT TYPE="hidden" NAME="total_gp", VALUE="<?php echo $total_gp?>"/>
<INPUT TYPE="hidden" NAME="total_hps", VALUE="<?php echo $total_hps?>"/>
<INPUT TYPE="hidden" NAME="cr", VALUE="<?php echo $cr?>"/>
<INPUT TYPE="hidden" NAME="mon_size_old", VALUE="<?php echo $mon_size_old?>"/>
<INPUT TYPE="hidden" NAME="mon_level_old", VALUE="<?php echo $mon_level_old?>"/>
<INPUT TYPE="hidden" NAME="die_increase", VALUE="<?php echo $die_increase?>"/>
<INPUT TYPE="hidden" NAME="mon_str_m", VALUE="<?php echo $mon_str_m?>"/>
<INPUT TYPE="hidden" NAME="mon_dex_m", VALUE="<?php echo $mon_dex_m?>"/>
<INPUT TYPE="hidden" NAME="mon_con_m", VALUE="<?php echo $mon_con_m?>"/>
<INPUT TYPE="hidden" NAME="mon_int_m", VALUE="<?php echo $mon_int_m?>"/>
<INPUT TYPE="hidden" NAME="mon_wis_m", VALUE="<?php echo $mon_wis_m?>"/>
<INPUT TYPE="hidden" NAME="mon_chr_m", VALUE="<?php echo $mon_chr_m?>"/>
<INPUT TYPE="hidden" NAME="crit_p", VALUE="<?php echo $weap_crit_p?>"/>
<INPUT TYPE="hidden" NAME="crit_r", VALUE="<?php echo $weap_crit_r?>"/>
<INPUT TYPE="hidden" NAME="crit_s1", VALUE="<?php echo $weap_crit_s1?>"/>
<INPUT TYPE="hidden" NAME="crit_s2", VALUE="<?php echo $weap_crit_s2?>"/>
<INPUT TYPE="hidden" NAME="crit_s3", VALUE="<?php echo $weap_crit_s3?>"/>
<INPUT TYPE="hidden" NAME="crit_s4", VALUE="<?php echo $weap_crit_s4?>"/>
<INPUT TYPE="hidden" NAME="crit_s5", VALUE="<?php echo $weap_crit_s5?>"/>
<INPUT TYPE="hidden" NAME="crit_s6", VALUE="<?php echo $weap_crit_s6?>"/>
<INPUT TYPE="hidden" NAME="crit_s7", VALUE="<?php echo $weap_crit_s7?>"/>
<INPUT TYPE="hidden" NAME="crit_s8", VALUE="<?php echo $weap_crit_s8?>"/>
<INPUT TYPE="hidden" NAME="crit_s9", VALUE="<?php echo $weap_crit_s9?>"/>
<INPUT TYPE="hidden" NAME="crit_s10", VALUE="<?php echo $weap_crit_s10?>"/>
<INPUT TYPE="hidden" NAME="crit_ch_p", VALUE="<?php echo $weap_crit_ch_p?>"/>
<INPUT TYPE="hidden" NAME="crit_ch_r", VALUE="<?php echo $weap_crit_ch_r?>"/>
<INPUT TYPE="hidden" NAME="crit_ch_s1", VALUE="<?php echo $weap_crit_ch_s1?>"/>
<INPUT TYPE="hidden" NAME="crit_ch_s2", VALUE="<?php echo $weap_crit_ch_s2?>"/>
<INPUT TYPE="hidden" NAME="crit_ch_s3", VALUE="<?php echo $weap_crit_ch_s3?>"/>
<INPUT TYPE="hidden" NAME="crit_ch_s4", VALUE="<?php echo $weap_crit_ch_s4?>"/>
<INPUT TYPE="hidden" NAME="crit_ch_s5", VALUE="<?php echo $weap_crit_ch_s5?>"/>
<INPUT TYPE="hidden" NAME="crit_ch_s6", VALUE="<?php echo $weap_crit_ch_s6?>"/>
<INPUT TYPE="hidden" NAME="crit_ch_s7", VALUE="<?php echo $weap_crit_ch_s7?>"/>
<INPUT TYPE="hidden" NAME="crit_ch_s8", VALUE="<?php echo $weap_crit_ch_s8?>"/>
<INPUT TYPE="hidden" NAME="crit_ch_s9", VALUE="<?php echo $weap_crit_ch_s9?>"/>
<INPUT TYPE="hidden" NAME="crit_ch_s10", VALUE="<?php echo $weap_crit_ch_s10?>"/>
<INPUT TYPE="hidden" NAME="save_count", VALUE="<?php echo $save_count?>"/>
<INPUT TYPE="hidden" NAME="savemon_camp", VALUE="<?php echo $savemon_camp?>"/>
<INPUT TYPE="hidden" NAME="savemon_sub", VALUE="<?php echo $savemon_sub?>"/>
<INPUT TYPE="hidden" NAME="savemon_name", VALUE="<?php echo $savemon_name?>"/>
<INPUT TYPE="hidden" NAME="save_key_old", VALUE="<?php echo $save_key_old?>"/>
<INPUT TYPE="hidden" NAME="encounter", VALUE="<?php echo $encounter?>"/>
<INPUT TYPE="hidden" NAME="ac_desc", VALUE="<?php echo $ac_desc?>"/>
<INPUT TYPE="hidden" NAME="monlang1", VALUE="<?php echo $monlang1?>"/>
<INPUT TYPE="hidden" NAME="monlang2", VALUE="<?php echo $monlang2?>"/>
<INPUT TYPE="hidden" NAME="monlang3", VALUE="<?php echo $monlang3?>"/>
<INPUT TYPE="hidden" NAME="monlang4", VALUE="<?php echo $monlang4?>"/>
<INPUT TYPE="hidden" NAME="monlang5", VALUE="<?php echo $monlang5?>"/>
<INPUT TYPE="hidden" NAME="monlang6", VALUE="<?php echo $monlang6?>"/>
<INPUT TYPE="hidden" NAME="mon_alignment", VALUE="<?php echo $mon_alignment?>"/>
<INPUT TYPE="hidden" NAME="class_tp_3", VALUE="<?php echo $class_tp_3?>"/>
<INPUT TYPE="hidden" NAME="classLevel_3", VALUE="<?php echo $classLevel_3?>"/>
<INPUT TYPE="hidden" NAME="classFocus_3", VALUE="<?php echo $classFocus_3?>"/>
<INPUT TYPE="hidden" NAME="class3_tp", VALUE="<?php echo $class3_tp?>"/>
<INPUT TYPE="hidden" NAME="class3_focus", VALUE="<?php echo $class3_focus?>"/>
<INPUT TYPE="hidden" NAME="base_cmb", VALUE="<?php echo $base_cmb?>"/>
<INPUT TYPE="hidden" NAME="base_cmd", VALUE="<?php echo $base_cmd?>"/>
<INPUT TYPE="hidden" NAME="key_1", VALUE="<?php echo $key_1?>"/>
<INPUT TYPE="hidden" NAME="class1_psi", VALUE="<?php echo $class1_psi?>"/>
<INPUT TYPE="hidden" NAME="class2_psi", VALUE="<?php echo $class2_psi?>"/>
<INPUT TYPE="hidden" NAME="class3_psi", VALUE="<?php echo $class3_psi?>"/>
<INPUT TYPE="hidden" NAME="classm_psi", VALUE="<?php echo $classm_psi?>"/>
<INPUT TYPE="hidden" NAME="psi_cmb", VALUE="<?php echo $psi_cmb?>"/>
<INPUT TYPE="hidden" NAME="psi_pts", VALUE="<?php echo $psi_pts?>"/>
<INPUT TYPE="hidden" NAME="psidcstr", VALUE="<?php echo $psidcstr?>"/>
<INPUT TYPE="hidden" NAME="psidcint", VALUE="<?php echo $psidcint?>"/>
<INPUT TYPE="hidden" NAME="psidcdex", VALUE="<?php echo $psidcdex?>"/>
<INPUT TYPE="hidden" NAME="psidccon", VALUE="<?php echo $psidccon?>"/>
<INPUT TYPE="hidden" NAME="psidcwis", VALUE="<?php echo $psidcwis?>"/>
<INPUT TYPE="hidden" NAME="psidcchr", VALUE="<?php echo $psidcchr?>"/>
<INPUT TYPE="hidden" NAME="print_sen", VALUE="<?php echo $print_sen?>"/>
<INPUT TYPE="hidden" NAME="print_sub", VALUE="<?php echo $print_sub?>"/>
<INPUT TYPE="hidden" NAME="print_def", VALUE="<?php echo $print_def?>"/>
<INPUT TYPE="hidden" NAME="print_hp", VALUE="<?php echo $print_hp?>"/>
<INPUT TYPE="hidden" NAME="print_speed", VALUE="<?php echo $print_speed?>"/>
<INPUT TYPE="hidden" NAME="print_space", VALUE="<?php echo $print_space?>"/>
<INPUT TYPE="hidden" NAME="print_reach", VALUE="<?php echo $print_reach?>"/>
<INPUT TYPE="hidden" NAME="print_spell_abil", VALUE="<?php echo $print_spell_abil?>"/>
<INPUT TYPE="hidden" NAME="htmlp_spell_abil", VALUE="<?php echo $htmlp_spell_abil?>"/>
<INPUT TYPE="hidden" NAME="htmlp_spell_abil_s", VALUE="<?php echo $htmlp_spell_abil_s?>"/>
<INPUT TYPE="hidden" NAME="print_buff", VALUE="<?php echo $print_buff?>"/>
<INPUT TYPE="hidden" NAME="print_aura", VALUE="<?php echo $print_aura?>"/>
<INPUT TYPE="hidden" NAME="htmlp_buff", VALUE="<?php echo $htmlp_buff?>"/>
<INPUT TYPE="hidden" NAME="add_extra_attack", VALUE="<?php echo $add_extra_attack?>"/>
<INPUT TYPE="hidden" NAME="htmlp_special_attacks", VALUE="<?php echo $htmlp_special_attacks?>"/>
<INPUT TYPE="hidden" NAME="htmlp_special_qualities", VALUE="<?php echo $htmlp_special_qualities?>"/>

<INPUT TYPE="hidden" NAME="featsArray", VALUE="<?php echo urlencode(base64_encode(serialize($featsArray))); ?>"/>
<INPUT TYPE="hidden" NAME="skillArray", VALUE="<?php echo urlencode(base64_encode(serialize($skillArray))); ?>"/>
<INPUT TYPE="hidden" NAME="specialAbilitiesArray", VALUE="<?php echo urlencode(base64_encode(serialize($specialAbiltiesArray))); ?>"/>
<INPUT TYPE="hidden" NAME="secondaryWeaponArray", VALUE="<?php echo urlencode(base64_encode(serialize($secondaryWeaponArray))); ?>"/>
<INPUT TYPE="hidden" NAME="monSpeedArray", VALUE="<?php echo urlencode(base64_encode(serialize($monSpeedArray))); ?>"/>
<INPUT TYPE="hidden" NAME="specialAttackArray", VALUE="<?php echo urlencode(base64_encode(serialize($specialAttackArray))); ?>"/>


<INPUT TYPE="hidden" NAME="htmlp_def", VALUE="<?php echo $htmlp_def?>"/>

<INPUT TYPE="hidden" NAME="mon_name", VALUE="<?php echo $mon_name?>"/>
<INPUT TYPE="hidden" NAME="class1_tp", VALUE="<?php echo $class1_tp?>"/>
<INPUT TYPE="hidden" NAME="class1_focus", VALUE="<?php echo $class1_focus?>"/>
<INPUT TYPE="hidden" NAME="class2_tp", VALUE="<?php echo $class2_tp?>"/>
<INPUT TYPE="hidden" NAME="class2_focus", VALUE="<?php echo $class2_focus?>"/>
<INPUT TYPE="hidden" NAME="oldmon_key", VALUE="<?php echo $oldmon_key?>"/>
<INPUT TYPE="hidden" NAME="elite", VALUE="<?php echo $elite?>"/>
<INPUT TYPE="hidden" NAME="mon_temp", VALUE="<?php echo $mon_temp?>"/>
<INPUT TYPE="hidden" NAME="mon_temp2", VALUE="<?php echo $mon_temp2?>"/>
<INPUT TYPE="hidden" NAME="user", VALUE="<?php echo $user?>"/>
<INPUT TYPE="hidden" NAME="old_grapple", VALUE="<?php echo $old_grapple?>"/>
<INPUT TYPE="hidden" NAME="new_grapple", VALUE="<?php echo $new_grapple?>"/>
<INPUT TYPE="hidden" NAME="new_size_no", VALUE="<?php echo $new_size_no?>"/>
<INPUT TYPE="hidden" NAME="old_size_no", VALUE="<?php echo $old_size_no?>"/>
<INPUT TYPE="hidden" NAME="tem_type", VALUE="<?php echo $tem_type?>"/>
<INPUT TYPE="hidden" NAME="first_pass", VALUE="<?php echo $first_pass?>"/>
<INPUT TYPE="hidden" NAME="cr_path", VALUE="<?php echo $cr_path?>"/>
<INPUT TYPE="hidden" NAME="title_desc", VALUE="<?php echo $title_desc?>"/>
<INPUT TYPE="hidden" NAME="skill_no_extra", VALUE="<?php echo $skill_no_extra?>"/>
<INPUT TYPE="hidden" NAME="skill_changed", VALUE="<?php echo $skill_changed?>"/>
<INPUT TYPE="hidden" NAME="skill_changed_old", VALUE="<?php echo $skill_changed_old?>"/>
<INPUT TYPE="hidden" NAME="total_skill_points_old", VALUE="<?php echo $total_skill_points_old?>"/>
<INPUT TYPE="hidden" NAME="skill_left_flag", VALUE="<?php echo $skill_left_flag?>"/>
<INPUT TYPE="hidden" NAME="total_level_old", VALUE="<?php echo $total_level_old?>"/>
<INPUT TYPE="hidden" NAME="print_attack", VALUE="<?php echo $print_attack?>"/>
<INPUT TYPE="hidden" NAME="print_ranged", VALUE="<?php echo $print_ranged?>"/>
<INPUT TYPE="hidden" NAME="print_init", VALUE="<?php echo $print_init?>"/>
<INPUT TYPE="hidden" NAME="print_CMB", VALUE="<?php echo $print_CMB?>"/>
<INPUT TYPE="hidden" NAME="print_CMD", VALUE="<?php echo $print_CMD?>"/>
<INPUT TYPE="hidden" NAME="magic_armour", VALUE="<?php echo $magic_armour?>"/>
<INPUT TYPE="hidden" NAME="magic_shield", VALUE="<?php echo $magic_shield?>"/>
<INPUT TYPE="hidden" NAME="mon_size_u", VALUE="<?php echo $mon_size_u?>"/>
<INPUT TYPE="hidden" NAME="mon_size_m", VALUE="<?php echo $mon_size_m?>"/>
<INPUT TYPE="hidden" NAME="class1_spell_level", VALUE="<?php echo $class1_spell_level?>"/>
<INPUT TYPE="hidden" NAME="class2_spell_level", VALUE="<?php echo $class2_spell_level?>"/>
<INPUT TYPE="hidden" NAME="class3_spell_level", VALUE="<?php echo $class3_spell_level?>"/>
<INPUT TYPE="hidden" NAME="classm_spell_level", VALUE="<?php echo $classm_spell_level?>"/>
<INPUT TYPE="hidden" NAME="print_specdesc", VALUE="<?php echo $print_specdesc?>"/>
<INPUT TYPE="hidden" NAME="new_animal_comp_level", VALUE="<?php echo $new_animal_comp_level?>"/>
<INPUT TYPE="hidden" NAME="old_animal_comp_level", VALUE="<?php echo $old_animal_comp_level?>"/>
<INPUT TYPE="hidden" NAME="spec_first_time", VALUE="<?php echo $new_animal_comp_level?>"/>
<INPUT TYPE="hidden" NAME="magic_tohit_s1", VALUE="<?php echo $magic_tohit_s1?>"/>
<INPUT TYPE="hidden" NAME="magic_damage_s1", VALUE="<?php echo $magic_damage_s1?>"/>
<INPUT TYPE="hidden" NAME="magic_s1", VALUE="<?php echo $magic_s1?>"/>
<INPUT TYPE="hidden" NAME="path2", VALUE="<?php echo $path2?>"/>
<INPUT TYPE="hidden" NAME="mon_desc", VALUE="<?php echo $mon_desc?>"/>
<INPUT TYPE="hidden" NAME="save_text", VALUE="<?php echo $save_text?>"/>
<INPUT TYPE="hidden" NAME="AC_text", VALUE="<?php echo $AC_text?>"/>
<INPUT TYPE="hidden" NAME="sen_text", VALUE="<?php echo $sen_text?>"/>
<INPUT TYPE="hidden" NAME="init_text", VALUE="<?php echo $init_text?>"/>
<INPUT TYPE="hidden" NAME="speed_text", VALUE="<?php echo $speed_text?>"/>
<INPUT TYPE="hidden" NAME="reach_text", VALUE="<?php echo $reach_text?>"/>
<INPUT TYPE="hidden" NAME="resist_text", VALUE="<?php echo $resist_text?>"/>
<INPUT TYPE="hidden" NAME="game", VALUE="<?php echo $game?>"/>
<INPUT TYPE="hidden" NAME="user_id", VALUE="<?php echo $user_id?>"/>

<INPUT TYPE="hidden" NAME="magic_tohit_p", VALUE="<?php echo $magic_tohit_p?>"/>
<INPUT TYPE="hidden" NAME="magic_damage_p", VALUE="<?php echo $magic_damage_p?>"/>
<?PHP
if (isset($edit_ind)){
echo <<<EOF
<INPUT TYPE="hidden" NAME="$save_key_r", VALUE="$savemon_key"/>
<INPUT TYPE="hidden" NAME="edit_ind", VALUE="$edit_ind"/>
<INPUT TYPE="hidden" NAME="encounter", VALUE="$encounter"/>
EOF;
}
$count = 0;
while ($count < $skill_no_extra){
  $count +=1;
  $skille_r = "skille_" . $count;
  $skille = $$skille_r;
  $ranke_r = "ranke_" . $count;
  $ranke = $$ranke_r;
  echo "<INPUT TYPE='hidden' NAME='" .$skille_r . "', VALUE='" . $skille . "'/>";
  echo "<INPUT TYPE='hidden' NAME='" .$ranke_r . "', VALUE='" . $ranke . "'/>";
}


?>

<?PHP
$count = 0;
While ($count  < 2 ){
  $count += 1;
  $level = 0;
  While ($level < 10){
    $spell_v  = "class" . $count . "_spell" . $level;
    $spell = $$spell_v;
    echo    "<INPUT TYPE='hidden' NAME='$spell_v', VALUE='$spell'/>";
    $level += 1;
  }
}
$count  ="m";
$level = 0;
While ($level < 10){
  $spell_v  = "class" . $count . "_spell" . $level;
		if ( isset($$spell_v)) {
  			$spell = $$spell_v;
		} else {
				$spell = "";
		}
  echo    "<INPUT TYPE='hidden' NAME='$spell_v', VALUE='$spell'/>";
  $level += 1;
}
$x = displayButtons2();


?>



</FORM>