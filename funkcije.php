<?php
class ssl{
		var $baza;
		var $link;

		function otvaranje_baze($admin){
			global $baza;
			$folder = ($admin == 1) ? "" : "/".ADMIN;
			$baza = sqlite_open('.'.$folder.'/lista.db', 0666, $error);
			if (!$baza) die ($error);
			return $baza;

		}
		function lista_servera(){
			global $baza;
			$rezultat = sqlite_query($baza, "SELECT ip, naziv FROM serveri $limit");
				if (!$rezultat) die("Neuspesan query.");

			$serveri = array();
			while($red = sqlite_fetch_array($rezultat, SQLITE_ASSOC))
				array_push($serveri, $red);

			return $serveri;

		}
		function json_dekod($ip){
			$link 	= "http://api.gametracker.rs/demo/json/server_info/".$ip;
			$json 	= file_get_contents($link);
			$array 	= json_decode($json, true);

			return $array;

		}

		function lista_admin(){

		    global $baza;
		    $query = "SELECT * FROM serveri";
		    $rezultat = sqlite_query($baza, $query);
		    if (!$rezultat) die("Neuspesan query.");


		    while ($red = sqlite_fetch_array($rezultat, SQLITE_ASSOC))
		        { 

		            $serveri .= "<tr>";
		            $serveri .= "<td>".$red['naziv']."</td>";
		            $serveri .= "<td>".$red['ip']."</td>";
		            $serveri .= "<td class='action'><a href='./index.php?izmeni=".$red['id']."' class='edit'>Izmeni</a><a href='./process.php?izbrisi=".$red['id']."' class='delete'>Izbrisi</a></td>";
		            $serveri .= "</tr>";

		        }

		        if(!$serveri)
		            $serveri = "<td colspan='3'><b>Nema servera</b></td>";

		        return $serveri;
		    sqlite_close($baza);



		}
}

?>