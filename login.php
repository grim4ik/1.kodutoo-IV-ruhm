<?php 


	//var_dump($_GET);
	
	//echo "<br>";
	
	//var_dump($_POST);
	
	//MUTUJAD
	$signupEmailError = "*";
	$signupEmail = "";
	
	//kas keegi vajutas nuppu ja see on olemas
	
	if (isset ($_POST["signupEmail"])) {
		
		//on olemas
		// kas epost on tühi
		if (empty ($_POST["signupEmail"])) {
			
			// on tühi
			$signupEmailError = "* Väli on kohustuslik!";
			
		} else {
			//email on olemas õige
			$signupEmail = $_POST["signupEmail"];
		}
		
	}
	
	$signupPasswordError = "*";
	
	if (isset ($_POST["signupPassword"])) {
		
		if (empty ($_POST["signupPassword"])) {
			
			$signupPasswordError = "* Väli on kohustuslik!";
			
		} else {
			
			// parool ei olnud tühi
			
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "* Parool peab olema vähemalt 8 tähemärkki pikk!";
				
			}
			
		}
		
	}
	
	//vaikimisi väärtus
	$gender = "";
	
	if (isset ($_POST["gender"])) {
		if (empty ($_POST["gender"])) {
			$genderError = "* Väli on kohustuslik!";
		} else {
			$gender = $_POST["gender"];
		}
		
	} 
	
	
	
	
		if ($signupEmailError == "*" AND 
		 $signupPasswordError == "*" &&
		 isset($_POST["signupEmail"])&&
		 isset($_POST["signupPassword"])
			
			) 
			{
		
		//vigu ei olnud, k]ik on olemas
		echo "Salvestan...<br>";
		echo "email ".$signupEmail. "<br>";
		echo "parool  ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo $password;
		
		//loon ühenduse
		
		$database = "if16_kirikotk_4";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUE (?, ?)");
		
		echo $mysqli->error;
		
		//asendan küsimärgig
		//iga märgi kohta tuleb lisada üks täht - mis tüüpi muutuja on
		// s - string
		// i - int
		// d - double
		$stmt->bind_param("ss", $signupEmail, $password);
		
		//täida käsku
		if($stmt->execute() ) {
			echo "õnnestus";
			} else {
				echo "ERROR ".$stmt->error;
			}
		}
		
		
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise leht</title>
	</head>
	<center>
			<style>	
		body {
			background-image:	url("http://www.astro.spbu.ru/staff/afk/Teaching/Seminars/XimFak/bg/Fon5.gif");
			background-repeat: repeat;
			background-position: center top;
			background-attachment: fixed;
			}
		
		
		</style>
	<body>

		<h1>Logi sisse</h1>
		
		<form method="POST" >
			
			<input name="loginEmail" placeholder="E-post" type="email">
			
			<br><br>

			<input name="loginPassword" placeholder="Parool" type="password">
			
			<br><br>
			
			<input type="submit" value="Logi sisse">
		
		</form>
		
		<h1>Loo kasutaja</h1>
		
		<form method="POST" >
			
			<label>E-post</label><br>
			<input name="signupEmail" type="email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
			
			<br><br>
            
			<label>Parool</label><br>
			<input name="signupPassword" type="password"> <?php echo $signupPasswordError; ?>
			
			<br><br>

			<?php if ($gender == "female") { ?>
				<input type="radio" name="gender" value="female" checked> female<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="female" > female<br>
			<?php } ?>
			
			<?php if ($gender == "male") { ?>
				<input type="radio" name="gender" value="male" checked> male<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="male" > male<br>
			<?php } ?>
			
			
			<?php if ($gender == "other") { ?>
				<input type="radio" name="gender" value="other" checked> other<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="other" > other<br>
			<?php } ?>

			<br>
			
			Sünnipäev:<br>
		<input type="date" name="sünnipäev" max="2006-12-31">
		<br><br>
			
			<input type="submit" value="Loo kasutaja">
			
			
		
		</form>
		

	</body>
</html>


<br><br>
## Tahaksin teha reklaami veebilehekükg, kus oleksid bannerid, ja nendes oleks informatsiion kui avada neid.
</center>

