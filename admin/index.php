<?php 
session_start();
if(!isset($_SESSION['login']))
    header("Location: ./login.php");

include("../podesavanja.php");
include("../funkcije.php");

$func   = new ssl();
$baza   = $func->otvaranje_baze("1");
$lista  = $func->lista_admin();


if(isset($_GET['izmeni']))
{
    $id     = $_GET['izmeni'];
    $id     = sqlite_escape_string($id);

    $rez = sqlite_query($baza, "SELECT * FROM serveri WHERE id = '$id' LIMIT 1");
    if (!$rez) die("Neuspesan query.");

    $info = sqlite_fetch_array($rez, SQLITE_ASSOC);


}
sqlite_close($baza);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple Server List</title>

<link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->

<script type="text/javascript" src="style/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#dodaj').hide();
    $('#pregled').click(function(){
      $('#dodaj').toggle('1000');
    });
  });

</script>
<script type="text/javascript" src="style/js/jNice.js"></script>
</head>

<body>
	<div id="wrapper">
    	
    	<h1><a href="#"><span>Simple Server List</span></a></h1>
        
       
        <ul id="mainNav">
        	<li><a href="./index.php" class="active">Pocetna</a></li>
        	<li><a href="#"id="pregled">Dodaj server</a></li>
        	<li class="logout"><a href="./process.php?logout=1">LOGOUT</a></li>
        </ul>
       
        
        <div id="containerHolder">
			<div id="container">
                <h2><a href="#">POCETNA</a> &raquo; <a href="#" class="active">Pregled dodatih servera</a></h2>
                <div id="main">
                    <?php if(isset($_SESSION['poruka'])) echo "<br /><h3><font color='#c66653'>". $_SESSION['poruka'] ."</font></h3>"; unset($_SESSION['poruka']) ?>

                    <?php 
                        if(isset($info)){
                        echo '
                        <form method="post" action="./process.php" class="jNice">
                        <input type="hidden" name="id" value="'.$info["id"].'" />
                        <h3>Izmeni server</h3>
                            <fieldset>
                                <p><label>Naziv servera:</label><input type="text" name="naziv" class="text-long" value="'.$info["naziv"].'" /></p>
                                <p><label>IP:</label><input type="text" name="ip" class="text-long" value="'.$info["ip"].'" /></p>
                                <input type="submit" name="izmeni" value="Izmeni" />
                            </fieldset>
                        </form>';
                        }
                    ?>

                	<form method="post" action="./process.php" class="jNice" id="dodaj">
					<h3>Dodaj server na listu</h3>
                    	<fieldset>
                        	<p><label>Naziv servera:</label><input type="text" name="naziv" class="text-long" /></p>
                        	<p><label>IP:</label><input type="text" name="ip" class="text-long" /></p>
                            <input type="submit" name="dodaj" value="Dodaj server" />
                        </fieldset>
                    </form>

                    <h3>Lista</h3>
                        <table cellpadding="0" cellspacing="0">
                            <?php echo $lista; ?>                        
                        </table>


                    <h3>Pregled liste</h3>
                    <fieldset>
                        <iframe src="../index.php" style="width:100%;height:100%;"  frameborder="0"></iframe>
                    </fieldset>


                </div>
                
                <div class="clear"></div>
            </div>
        </div>	

        
        <p id="footer">Simple Server List. <a href="http://skakac.com/">Dusan Stojadinovic.</a></p>
    </div>
</body>
</html>


