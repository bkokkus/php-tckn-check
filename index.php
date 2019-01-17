<?php 

	$client = new SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL");

	try {
		if (isset($_POST['btn'])){

				$tc = trim($_POST['tc']);
				$fullname = trim(tr_strtoupper($_POST['fullname']));
				$lastname = trim(tr_strtoupper($_POST['lastname']));
				$birthday = trim($_POST['birthday']);
		
		
				$requestData = array(
					"TCKimlikNo" => $tc,
					"Ad" => $fullname,
					"Soyad" => $lastname,
					"DogumYili" => $birthday
				);

				$result = $client->TCKimlikNoDogrula($requestData);
				
				$message = "";

				if($result->TCKimlikNoDogrulaResult){
					$message = "TC GEÇERLİ";
				} else {
					$message = "TC GEÇERSİZ";
				}
		}
	} catch (Exception $e) {
		echo $e->faultstring;
	}

	//toupper türkçe karakter destek fonksiyonu 
	function tr_strtoupper($text){
		$search=array("ç","i","ı","ğ","ö","ş","ü");
	    $replace=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
	    $text=str_replace($search,$replace,$text);
	    $text=strtoupper($text);
	    return $text;
	}


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>TCKN KONTROL</title>

	<style type="text/css">
		* {
			margin: 0px;
			padding: 0px;

		}

		body {
			font-family: Arial;
		}

		#tckn {
			padding: 10px;
			margin: 10px;
		}

	

		#kutu1 {
			margin: auto;
			margin-top: 50px;
			border:1px solid #000;
			width: 300px;
		}

		#response b {
			margin: 10px;
			padding: 10px;
			color:#000;
			margin-bottom: 10px;	
			
		}
		#response {
			color: red;
			font-size: 20px;
			margin-bottom: 10px;
			
		}

	</style>
</head>
<body>
	<div id="kutu1">
	
		<div id="tckn">
		<h2>TC Kimlik NO KONTROL</h2>
		<hr>
			<form method="POST">
				
				<label>T.C. Kimlik No : </label><br>
				<input type="text" name="tc">

				<br>

				<label>Tam Ad : </label><br>
				<input type="text" name="fullname" placeholder="Adem Badem">

				<br>

				<label>Soyad : </label><br>
				<input type="text" name="lastname" placeholder="Kaplan">

				<br>

				<label>Doğum Yılı : </label><br>
				<input type="text" name="birthday" placeholder="1991">

				<br><br>
				<input id="btn" type="submit" name="btn" value="Gönder">
				
			</form>
			
		</div>
	
		<div id="response">
		<b>Sonuç :</b> 
		<?php if(isset($message)) echo $message; ?> 
		</div>

	</div>
		
	
		
</body>
</html>
 