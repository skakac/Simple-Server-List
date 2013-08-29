<?php
include("./podesavanja.php");
include("./funkcije.php");

$func 	= new ssl();
$func->otvaranje_baze("0");
$serveri = $func->lista_servera();


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
   <head>
     <title>Lista</title>
     <link href="<?php echo STYLE ?>" rel="stylesheet" type="text/css" />

   </head>
   <body>
   	<div style='height:0px'><br /></div>
	<div style='text-align:center; font-size:11px; font-face:arial;'>
	    <table cellpadding='0' cellspacing='2' style='margin:auto'>
	    	<?php
	    	foreach ($serveri as $srv) {

				$ifno 	= array();
				$info 	= $func->json_dekod($srv["ip"]);
				$status = ($info['status'] == 1) ? "online" : "offline";
				$steam = STEAM ? "<td></td>" : "";

				if($info["apiError"] != 0)
					echo '<tr><td><img src="./slike/offline.png" height=12px /></td><td></td><td class="ime"><span class="naziv">'.$srv["naziv"].'</span></td>'.$steam.'<td class="greska">'.$info["errorText"].'</td><td></td><td></td><td></td></tr>';
				else{

			    	echo '<tr>';
			        echo '<td>';
			        	echo '<a href="http://www.gametracker.rs/server_info/'.$info['ip'].'/" target="_blank">';
			        	echo '<img alt="" src="http://beta.gametracker.rs/assets/favicon.ico" height=16px />';
			        echo '</td>';
			        echo '<td>';
			        echo '<a href="http://www.gametracker.com/server_info/'.$info['ip'].'/" target="_blank">';
			        	echo '<img alt="" src="./slike/gtcom.png" height=16px />';
			     	echo '</td>';

			             
			    	echo '<td title="Konektuj se preko STEAM-a" class="ime">';
			         	echo '<div class="ime2">';
			        	echo '<a href="steam://connect/'.$info['ip'].'" target="_blank" class="naziv">';
			        		echo $info['name'].' '.$bla;
			        	echo '</a>';
			        	echo '</div>';
			        echo '</td>';

			        if(STEAM){
						echo '<td>';
							echo '<a href="steam://connect/'.$info['ip'].'" target="_blank">';
								echo '<img src="./slike/steam.png" border="0" title="Steam Konekcija" />';
							echo '</a>';         
				        echo '</td>';
			    	}

			        echo '<td title="Konektuj se preko STEAM" class="ip">';
			          echo '<a href="steam://connect/'.$info['ip'].'">';
			         	echo ' '.$info['ip'].'';
			          echo '</a>';
			        echo '</td>'; 


			        echo '<td class="mapa">';
			        	 echo $info['map'];
			        echo '</td>';

			        echo '<td class="igraci"> ';
			        	 echo $info['players'].' / '.$info['playersmax'];
			        echo '</td>';

			        echo '<td class="zemlja"> ';
			        	 echo '<img src="http://static.gametracker.rs/flags/'.$info["iso2"].'.png" style="vertical-align:middle; border:none" title="Zemlja '.$info["countryname"].'" />';
			        echo '</td>';
			    echo '</tr>';
			  	}
	      	}
	      ?>
	    </table>
	   	<div style="opacity: 0.4; float:right; margin:auto;" onmouseover="this.style.opacity=0.8;this.filters.alpha.opacity=80" onmouseout="this.style.opacity=0.4;this.filters.alpha.opacity=40">
	   		<a href="http://skakac.com/ssl.php" target="_blank"><img src="http://skakac.com/other/ssl.png" height=30px border=0 /></a>
	   	</div>
	</div>
	</body>
</html>
