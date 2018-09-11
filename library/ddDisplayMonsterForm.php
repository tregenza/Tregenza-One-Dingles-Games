<?php
/*
*
*		HTML etc for displaying the monster
*
*/




?>
<div class="noPrint">
	<h1>D&D 3.5 Monster Generator</h1>
</div>

<div id="monsterGenerator" >

<?PHP



// Display Error message if any
if ($msg != ""){
	echo "<div class=\"error\">$msg</div>" ;
}

?>
	<FORM METHOD="post" ACTION="<?php echo $baseDomain.$urlPATH; ?>">
		<INPUT class="button noPrint" TYPE="submit" NAME="print_ind" VALUE="Recalculate" />
		<INPUT class="button noPrint" TYPE="submit" NAME="print_ind" VALUE="Plain Text Version"/>
		<p>Change any stats or equipment and add in any feats then press "Recalculate" to see the changes.</p>
		<p>Select "Plain Text Version" so you can copy and paste to your document.</p>

			<ul class="stats">
				<li class="stats gainLayout">
					<h3 class="statsHeader"><?PHP echo $mon_name; ?></h3>
					<p class="statsHeader">
<?PHP 
if ( $class1_tp ) {
?>
					<?php echo $class1_tp; ?>  [ <? echo $class1_focus; ?> ] Level: <INPUT TYPE="text" class="text width2em alignRight" NAME="class1_level" VALUE="<? echo $class1_level ?>">
<?php
	if ( $class2_tp	) {
		echo " / ";
?>
						<?php echo $class2_tp; ?> [ <? echo $class2_focus; ?> ] Level: <INPUT TYPE="text" class="text width2em alignRight" NAME="class2_level" VALUE="<? echo $class2_level ?>">
<?php
	}
}
$cr_total = $cr + $cr_path;
echo "cr_total = $cr_total";
?>
					</p>
						
					<ul class="">
						<li><span class="greyText">Type:</span> <span class="indent15"><?PHP echo $mon_type ?></span></li>
						<li ><span class="greyText">Size:</span> <span class="indent15"><SELECT NAME="mon_size" VALUE="<?PHP echo $mon_size ?>"><?PHP echo $sizeHTML; ?></SELECT></span></li>
						<li><span class="greyText">CR:</span> <span class="indent15"><?PHP echo $cr_total; ?></span></li>
					</ul>
				</li>
				<li class="stats gainLayout">
					<div class="bigBoxColumns">
						<div class="bigBoxColumn2">
							<div class="box">
								<p class="boxLabel">Racial Hit Dice</p>
								<p class="boxValue"><INPUT TYPE="text" class="text width4em" NAME="mon_hd" VALUE="<?PHP echo $mon_hd; ?>"/></p>	
							</div>
							<div class="box">
								<p class="boxLabel">Hit Points</p>
								<p class="boxValue greyText"><?php echo $total_hd ?></p>	
								<p class="boxValue"><?php echo $total_hps ?></p>	
							</div>
							<div class="box">
								<ul class="attacks">
									<div class="box">
										<p class="boxLabel">Original Monster Base Attack</p>
										<p class="boxValue"><INPUT TYPE="text" class="text width2em" NAME="mon_base_att" VALUE="<? echo $mon_base_att ?>"/></p>
		  								<div class="boxDetail fClearLeft">
                                             <p>Calculated Base Attack: +<?PHP echo $base_attack ?></p>
											<p>Calculated Base Grapple: +<?PHP echo $base_grapple ?></p>
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
											<li><span class="greyText">Magic To Hit Mod:</span><span class="indent40"><INPUT TYPE="text" class="text width4em" NAME="magic_tohit_p" VALUE="<?PHP echo $magic_tohit_p; ?>"/></span></li>
											<li ><span class="greyText">Magic Damage Mod:</span><span class="indent40"><INPUT TYPE="text" class="text width4em" NAME="magic_damage_p" VALUE="<?PHP echo $magic_damage_p; ?>"/></span></li>
										</ul>
									</li>
									</div>


 <?PHP

	foreach( $secondaryWeaponHTML as $sWHTML) {
	?>
									<div class="box">
										<?PHP echo $sWHTML; ?>
									</div>
	<?PHP
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
											<li><span class="greyText">Magic To Hit Mod:</span><span class="indent40"><INPUT TYPE="text"  class="text width4em" NAME="magic_tohit_r" VALUE="<?PHP echo $magic_tohit_r; ?>"  /></span></li>
											<li><span class="greyText">Magic Damage Mod:</span><span class="indent40"><INPUT TYPE="text"  class="text width4em" NAME="magic_damage_r" VALUE="<?PHP echo $magic_damage_r; ?>" /></span></li>
											<li ><span class="greyText">Range:</span><span class="indent40"><?PHP echo $weap_range_r; ?></span></li>
										</ul>
									</div>
								</ul>
							</div>
						</div>
						
						<div class="bigBoxColumn2  leftBorder">
							
						<div class="rightColWrapper ">
							<div class="box" >
								<p class="boxLabel">AC</p>
								<p class="boxValue"><?PHP echo $mon_ac; ?></p>
								<ul class="small">
									<li ><span class="greyText">Natural:</span><span class="indent40"><INPUT TYPE="text" class="text width2em" NAME="mon_ac_flat" VALUE="<? echo $mon_ac_flat ?>" ></span></li>
									<li ><span class="greyText">Touch:</span><span class="indent40"><?echo $ac_touch; ?></span></li>
									<li ><span class="greyText">Flat Footed:</span><span class="indent40"><?echo $ac_flat; ?></span></li>
									<li ><span class="greyText">Armour:</span><span class="indent40">
									<SELECT NAME="mon_armour" VALUE="<?PHP echo $mon_armour ?>">
									<?PHP echo $armourHTML; ?>
									</SELECT></span>
									</li>
									<li ><span class="greyText">Magic Armour Mod:</span><span class="indent40"><INPUT TYPE="text" class="text width2em indent40" NAME="magic_armour" VALUE="<?PHP echo $magic_armour; ?>"/></span></li>
									<li ><span class="greyText">Shield:</span><span class="indent40">
									<SELECT NAME="mon_shield" VALUE="<?PHP echo $mon_shield ?>">
									<?PHP echo $shieldHTML; ?>
									</SELECT></span>
									</li>
									<li ><span class="greyText">Magic Shield Mod:</span><span class="indent40"><INPUT TYPE="text" class="text width2em" NAME="magic_shield" VALUE="<?PHP echo $magic_shield; ?>"/></span></li>
								</ul>
							</div>  
	 						<div class="box"  >
	 							<p class="boxLabel">Initiative</p>
								<p class="boxValue"><?php echo $init; ?></p>
								<ul class="boxDetail"></ul>
							</div>
							<div class="box" >  
								<p class="boxLabel">Speed:</p>
								<p class="boxValue"> <INPUT TYPE="text" class="text width4em" NAME="speed_land" VALUE="<?php echo $speed_land ?>" /></p>	
	<?PHP
	if (($mon_speed_fly != "0" or $mon_speed_climb != "0" or $mon_speed_swim != "0" or $mon_speed_burrow != "0") and
	    ($mon_speed_fly != "" or $mon_speed_climb != "" or $mon_speed_swim != "" or $mon_speed_burrow != "")) {
	?>
	 							<ul class="small">
	 								<li  ><span class="greyText">Fly:</span><span class="indent40"><INPUT TYPE="text" class="text width4em" NAME="mon_speed_fly" VALUE="<?PHP echo $mon_speed_fly; ?>"/></span></li>
	 								<li ><span class="greyText">Swim:</span><span class="indent40"><INPUT TYPE="text" class="text width4em" NAME="mon_speed_swim" VALUE="<?PHP echo $mon_speed_swim; ?>"/></span></li>
	 								<li ><span class="greyText">Climb:</span><span class="indent40"><INPUT TYPE="text" class="text width4em" NAME="mon_speed_climb" VALUE="<?PHP echo $mon_speed_climb; ?>"/></span></li>
	 								<li ><span class="greyText">Borrow:</span><span class="indent40"><INPUT TYPE="text" class="text width4em" NAME="mon_speed_burrow" VALUE="<?PHP echo $mon_speed_burrow; ?>"/></span></li>
	 							</ul>

	<?PHP
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
								<p class="boxValue"><? echo $total_reflex_sv ?></p>
								<ul class="boxDetail">
								</ul>
							</div>
							<div class="box">
			
								<p class="boxLabel">Will</p>
								<p class="boxValue"><? echo $total_will_sv ?></p>
								<ul class="boxDetail">
								</ul>
							</div>
						</div>
							
						</div>						

					</div>


				</li>
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
				<li class="stats gainLayout">
					<div class="bigBoxColumn3">
						<div class="coreStat">
							<div class="box">
								<p class="boxLabel">Str</p>
								<p class="boxValue"><INPUT TYPE="text" class="text width2em"  NAME="mon_str" VALUE="<?PHP echo $mon_str ?>"/></p>
								<p class="boxDetail"></p>
							</div>
						</div>
						<div class="coreStat">
							<div class="box">
								<p class="boxLabel">Int</p>
								<p class="boxValue"><INPUT TYPE="text" class="text width2em" NAME="mon_int" VALUE="<?PHP echo $mon_int ?>"/></p>
								<p class="boxDetail"></p>
							</div>
						</div>
					</div>
					<div class="bigBoxColumn3">
						<div class="coreStat">
							<div class="box">
								<p class="boxLabel">Dex</p>
								<p class="boxValue"><INPUT TYPE="text" class="text width2em" NAME="mon_dex" VALUE="<?PHP echo $mon_dex ?>"/></p>
								<p class="boxDetail"></p>
							</div>
						</div>
						<div class="coreStat">
							<div class="box">
								<p class="boxLabel">Wis</p>
								<p class="boxValue"><INPUT TYPE="text" class="text width2em" NAME="mon_wis" VALUE="<? echo $mon_wis ?>"/></p>
								<p class="boxDetail"></p>
							</div>
						</div>
					</div>
					<div class="bigBoxColumn3">
						<div class="coreStat">
							<div class="box">
								<p class="boxLabel">Con</p>
								<p class="boxValue"><INPUT TYPE="text" class="text width2em" NAME="mon_con" VALUE="<?PHP echo $mon_con ?>"/></p>
								<p class="boxDetail"></p>
							</div>
						</div>
						<div class="coreStat">
							<div class="box">
								<p class="boxLabel">Chr</p>
								<p class="boxValue"><INPUT TYPE="text" class="text width2em" NAME="mon_chr" VALUE="<?PHP echo $mon_chr ?>"/></p>
								<p class="boxDetail"></p>
							</div>
						</div>
					</div>
				</li>
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
				<li class="stats noPrint">
					<div class="box">
						<p class="boxLabel">
							Feat Help
						</p>
						<p>
							<SELECT id="helpFeat" NAME="feathelp"  onchange="changeText('feathelp')">
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
                </TABLE>
				<li class="stats noBorder">
					<div class="box">
						<p class="bigBoxLabel">Skills</p>
						<p class="fClear greyText">
						<?php 
							if ( $class1_tp != "" ) {
								?>
								Skill Points - 
								<?php 
									echo $class1_tp.": ".$class1_skill_points;
									if ( $class2_tp != "" ) {
										echo "; ".$class2_tp.": ".$class2_skill_points;
	
									}
							}
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
echo $skillsHTML;	
?>						
						</TABLE>
					</div>
				</li>
<?PHP
if ($spellsOneHTML || $spellsTwoHTML ) {
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
?>
						
						</TABLE>
					</div>
				</li>				
<?PHP
}	// End of spells


if ($classSpecialsOneHTML || $classSpecialsTwoHTML ) {
?>
				<li class="stats noBorder">					
					<div class="box">
						<p class="bigBoxLabel">Class Special Abilities</p>
<?PHP
	if ($classSpecialsOneHTML ) {
?>
						<TABLE class="classSpecials">
							<TR class="classSpecialHeading">
								<TH colspan="3"><?PHP echo $class1_tp; ?></TH>
							</TR>
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
	if ($classSpecialsTwoHTML ) {
?>
						<TABLE class="classSpecials">
							<TR class="classSpecialHeading">
								<TH colspan="3"><?PHP echo $class2_tp; ?></TH>
							</TR>
							<TR class="classSpecialHeading">
							   <TH class="classSpecialName"></TH>
							   <TH class="classSpecialDesc">Description</TH>
							   <TH class="classSpecialValue">Number / Value</TH>
							</TR>
<?PHP
		echo $classSpecialsTwoHTML;
	}
?>
						</TABLE>
					</div>
				</li>
<?PHP
}	// END of Class Specials

?>
			</ul>
<?PHP
$print = "Name:" . "\n" .
         $mon_name . " (" . $mon_size . " " . $mon_type . ")" . "\n" .
         $class1_tp . " level " . $class1_level . " (skill points " . $class1_skill_points  . ") " . $class1_focus . "\n";
if ($class2_tp != ""){
     $print .=  $class2_tp . " level " . $class2_level . " (skill points " . $class2_skill_points  . ") " . $class2_focus . "\n";
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
$print .= "Spells: ". $print_spell ."\n";
$_POST[ "status" ] = "VETTED";
?>
                        <INPUT TYPE="hidden" NAME="status", VALUE="VETTED"/>
			<INPUT TYPE="hidden" NAME="mon_sv_fort", VALUE="<?echo $mon_sv_fort?>"/>
			<INPUT TYPE="hidden" NAME="mon_sv_will", VALUE="<?echo $mon_sv_will?>"/>
			<INPUT TYPE="hidden" NAME="mon_space", VALUE="<?echo $mon_space?>"/>
			<INPUT TYPE="hidden" NAME="mon_reach", VALUE="<?echo $mon_reach?>"/>
			<INPUT TYPE="hidden" NAME="mon_sv_reflex", VALUE="<?echo $mon_sv_reflex?>"/>
			<INPUT TYPE="hidden" NAME="mon_print", VALUE="<?echo $print?>"/>
			<INPUT TYPE="hidden" NAME="domain_11", VALUE="<?echo $domain_11?>"/>
			<INPUT TYPE="hidden" NAME="domain_12", VALUE="<?echo $domain_12?>"/>
			<INPUT TYPE="hidden" NAME="domain_21", VALUE="<?echo $domain_21?>"/>
			<INPUT TYPE="hidden" NAME="domain_22", VALUE="<?echo $domain_22?>"/>
			<INPUT TYPE="hidden" NAME="class1_spat", VALUE="<?echo $class1_spat?>"/>
                        <INPUT TYPE="hidden" NAME="class2_spat", VALUE="<?echo $class2_spat?>"/>
                        <INPUT TYPE="hidden" NAME="print_special_attacks", VALUE="<?echo $print_special_attacks?>"/>
                        <INPUT TYPE="hidden" NAME="print_special_qualities", VALUE="<?echo $print_special_qualities?>"/>
                        <INPUT TYPE="hidden" NAME="print_skill", VALUE="<?echo $print_skill?>"/>
                        <INPUT TYPE="hidden" NAME="print_feat", VALUE="<?echo $print_feat?>"/>
                        <INPUT TYPE="hidden" NAME="print_spell", VALUE="<?echo $print_spell?>"/>
                        <INPUT TYPE="hidden" NAME="flurry", VALUE="<?echo $flurry?>"/>
                        <INPUT TYPE="hidden" NAME="flurry_damage", VALUE="<?echo $flurry_damage?>"/>
                        <INPUT TYPE="hidden" NAME="print_secondary_attacks", VALUE="<?echo $print_secondary_attacks?>"/>
                        <INPUT TYPE="hidden" NAME="class1_skill_points", VALUE="<?echo $class1_skill_points?>"/>
                        <INPUT TYPE="hidden" NAME="class2_skill_points", VALUE="<?echo $class2_skill_points?>"/>
                        <INPUT TYPE="hidden" NAME="user", VALUE="<?echo $user?>"/>
                        <INPUT TYPE="hidden" NAME="total_hd", VALUE="<?echo $total_hd?>"/>
                        <INPUT TYPE="hidden" NAME="init", VALUE="<?echo $init?>"/>
                        <INPUT TYPE="hidden" NAME="mon_ac", VALUE="<?echo $mon_ac?>"/>
                        <INPUT TYPE="hidden" NAME="ac_flat", VALUE="<?echo $ac_flat?>"/>
                        <INPUT TYPE="hidden" NAME="ac_touch", VALUE="<?echo $ac_touch?>"/>
                        <INPUT TYPE="hidden" NAME="base_attack", VALUE="<?echo $base_attack?>"/>
                        <INPUT TYPE="hidden" NAME="base_grapple", VALUE="<?echo $base_grapple?>"/>
                        <INPUT TYPE="hidden" NAME="single_attack", VALUE="<?echo $single_attack?>"/>
                        <INPUT TYPE="hidden" NAME="single_ranged", VALUE="<?echo $single_ranged?>"/>
                        <INPUT TYPE="hidden" NAME="full_attack", VALUE="<?echo $full_attack?>"/>
                        <INPUT TYPE="hidden" NAME="ranged_attack", VALUE="<?echo $ranged_attack?>"/>
                        <INPUT TYPE="hidden" NAME="print_secondary_attacks", VALUE="<?echo $print_secondary_attacks?>"/>
                        <INPUT TYPE="hidden" NAME="total_fort_sv", VALUE="<?echo $total_fort_sv?>"/>
                        <INPUT TYPE="hidden" NAME="total_reflex_sv", VALUE="<?echo $total_reflex_sv?>"/>
                        <INPUT TYPE="hidden" NAME="total_will_sv", VALUE="<?echo $total_will_sv?>"/>
                        <INPUT TYPE="hidden" NAME="damage_r", VALUE="<?echo $damage_r?>"/>
                        <INPUT TYPE="hidden" NAME="damage_p", VALUE="<?echo $damage_p?>"/>
                        <INPUT TYPE="hidden" NAME="cr", VALUE="<?echo $cr?>"/>
                        <INPUT TYPE="hidden" NAME="mon_name", VALUE="<?echo $mon_name?>"/>
                        <INPUT TYPE="hidden" NAME="class1_tp", VALUE="<?echo $class1_tp?>"/>
                        <INPUT TYPE="hidden" NAME="class1_focus", VALUE="<?echo $class1_focus?>"/>
                        <INPUT TYPE="hidden" NAME="class2_tp", VALUE="<?echo $class2_tp?>"/>
                        <INPUT TYPE="hidden" NAME="class2_focus", VALUE="<?echo $class2_focus?>"/>
                        <INPUT TYPE="hidden" NAME="oldmon_key", VALUE="<?echo $oldmon_key?>"/>
                        <INPUT TYPE="hidden" NAME="elite", VALUE="<?echo $elite?>"/>
                        <INPUT TYPE="hidden" NAME="mon_temp", VALUE="<?echo $mon_temp?>"/>
                        <INPUT TYPE="hidden" NAME="user", VALUE="<?echo $user?>"/>

                        <INPUT TYPE="hidden" NAME="total_hps", VALUE="<?echo $total_hps?>"/>
			<INPUT class="button noPrint" TYPE="submit" NAME="print_ind" VALUE="Recalculate" />
			<INPUT class="button noPrint" TYPE="submit" NAME="print_ind" VALUE="Plain Text Version"/>

			</FORM>
	</div>







