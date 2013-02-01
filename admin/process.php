<?php
session_start();
include("../podesavanja.php");
include("../funkcije.php");

$func   = new ssl();
$baza   = $func->otvaranje_baze("1");

if($_POST['login']){


	if($_POST['user'] == 'admin' && $_POST['pass'] == SIFRA){
	 	$_SESSION['login'] = "1";
	 	header("Location: ./index.php");
	 	die();
	 }
	else{
		header("Location: ./login.php");
		die();
	}
}
else if(isset($_POST['dodaj'])){
	$ip 	= $_POST['ip'];
	$naziv 	= $_POST['naziv'];

	$ip 	= sqlite_escape_string($ip);
	$naziv 	= sqlite_escape_string($naziv);


	if(!preg_match('/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{1,5}/', $ip)) { 
		$_SESSION['poruka'] = "IP nije validan"; 
		header("Location: ./index.php");
		die();

	}
	else if(!empty($ip) && !empty($naziv)){
	 	$_SESSION['poruka'] = "Dodat server";


		$query = "INSERT INTO serveri VALUES (null ,'$ip', '$naziv')";
		$dodavanje = sqlite_exec($baza, $query);
		if (!$dodavanje) die("Neuspesno dodavanje.");

		header("Location: ./index.php");
		die();
	}
	else{
		$_SESSION['poruka'] = "Popuni sva polja";
		header("Location: ./index.php");
		die();

	}

	sqlite_close($baza);
}

else if(isset($_POST['izmeni'])){
	$ip 	= $_POST['ip'];
	$naziv 	= $_POST['naziv'];
	$id     = $_POST['id'];

	$ip 	= sqlite_escape_string($ip);
	$naziv 	= sqlite_escape_string($naziv);
    $id     = sqlite_escape_string($id);



	if(!preg_match('/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{1,5}/', $ip)) { 
		$_SESSION['poruka'] = "IP nije validan"; 
		header("Location: ./index.php");
		die();

	}
	else if(!empty($ip) && !empty($naziv)){
	 	$_SESSION['poruka'] = "Server je (".$naziv.") izmenjen.";


		$izmena = sqlite_exec($baza, "UPDATE serveri SET ip = '$ip', naziv = '$naziv' WHERE id = '$id'");
		if (!$izmena) die("Neuspesno menjanje.");

		header("Location: ./index.php");
		die();
	}
	else{
		$_SESSION['poruka'] = "Popuni sva polja";
		header("Location: ./index.php");
		die();

	}

	sqlite_close($baza);
}


else if(isset($_GET['izbrisi'])){
	$id = $_GET['izbrisi'];
	
	$dodavanje = sqlite_exec($baza, "DELETE FROM serveri WHERE id = '$id'");
	if (!$dodavanje) die("Neuspesno brisanje.");

	$_SESSION['poruka'] = "Uspesno izbrisan server";
	header("Location: ./index.php");
	die();


}
else if($_GET['logout']){


	unset($_SESSION['login']);
	header("Location: ./login.php");
	die();


}
else{
	header("Location: ./index.php");
	die();
}

?>