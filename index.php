<?php
$cell_number = $_GET['MSISDN'];
$session_id = $_GET['SESSION_ID'];
$service_code = $_GET['SERVICE_CODE'];
$ussd_string = $_GET['USSD_STRING'];
define("COOKIE_FILE", "cookie.txt");

//set default level to zero
$level = 0;
$ussd_string = str_replace("#","*",$ussd_string);//Repalcing with 
print_r("ussd string: ".$ussd_string);
$ussd_string_exploded = explode("*",$ussd_string);
echo "orig". count($ussd_string_exploded)."<br><br>";
$ussd_string_exploded2 = array_shift($ussd_string_exploded);//Shift index
//echo "result ".count($ussd_string_exploded)."<br><br>";
//get level id from ussd_string reply
$level = count($ussd_string_exploded);//
print_r("level: ".$level);
$phone = $cell_number;

if($level == 0)
{
	display_menu();
}
if($level > 0)
{
	switch($ussd_string_exploded[0])
	{
		case 1:
			All_in_one($ussd_string_exploded,$phone);			
		break;
		case 2:
			Daily_Bundles($ussd_string_exploded,$phone);
			break;
		case 3:
			Week_Bundles($ussd_string_exploded,$phone);
			break;
		case 4;
			Monthly_Bundles($ussd_string_exploded,$phone);
			break;
		
	}	
}

function display_menu()
{
$ussd_text = "1.All In One Monthly Bundle <br><br>2. Daily Bundles <br><br> 3. 7 Day Bundle <br><br> 4. 30Day Bundle <br><br> 5. Giga Bundle <br><br> 6.Platinum <br><br> 7.Tunukiwa <br><br> 8. Okoa Data";
ussd_proceed($ussd_text);
}

function All_in_one($details,$phone)
{
	// $ussd_text =
	// "How much do you wish to spend?<br><br>1. KSHS 1000<br><br>2. KSHS 2000
	// 	<br><br>3. KSHS 3000<br><br>4. KSHS 5000 <br><br>5. KSHS 10000";
	// ussd_proceed($ussd_text);
	webservice();
	
}

function 	Daily_Bundles($details,$phone)
{
	$c = $details[0];
	if(count($details) == 1)
	{
		$ussd_text = "1. Sh 10:25MB+25SMS <br><br>2. Sh20: 70MB+70SMS+Whatsapp<br><br>
		3. Sh50: 200MB+200SMS+Whatsapp<br><br>4. 1GB+200SMS+Whatsapp <br><br>5. Semeni";
		ussd_proceed($ussd_text);
	}

  	if(count($details) == 2)
	{
		if($c == 1)
		{
			$ussd_text = "1. Buy Once <br><br>
			2. Auto Renew<br><br>3. to enroll";
			ussd_proceed($ussd_text);
		}

		if($c == 2)
		{
			$ussd_text = "1. Buy Once <br><br>
			2. Auto Renew<br><br>3. to enroll";
			ussd_proceed($ussd_text);
		}
		if($c == 3)
		{
			$ussd_text = "1. Buy Once <br><br>
			2. Auto Renew<br><br>3. to enroll";
			ussd_proceed($ussd_text);
		}
		if($c == 4)
		{
			$ussd_text = "1. Buy Once <br><br>
			2. Auto Renew<br><br>3. to enroll";
			ussd_proceed($ussd_text);
		}
		if($c == 5)
		{
			$ussd_text = "1. Buy Once <br><br>
			2. Auto Renew<br><br>3. to enroll";
			ussd_proceed($ussd_text);
		}
		
	}
	else if($c == 2)
		{
			webservice();
		}
	}
	function Week_Bundles($details,$phone)
		{
				$c = $details[1];

				if(count($details) == 1)
				{
					$ussd_text = "1. 100@Sh50<br><br>. 2.350MB + Whatsapp @Sh 100<br><br>
					3. 1GB + Whatsapp @Shs250<br><br>4. 4GB+Whatsapp@500 <br><br>5. 0:BACK 00:HOME";
					ussd_proceed($ussd_text);
				}
				if($c ==1)
			{
				$ussd_text = "BUY 100MB @SHS 50 using<br><br> 1.Airtime<br><br> 2. Mpesa<br><br>0;BACK 00;HOME";
				ussd_proceed($ussd_text);
			}
			if($c ==2)
			{
				$ussd_text = "BUY 100MB @SHS 50 using<br><br> 1.Airtime<br><br> 2. Mpesa<br><br>0;BACK 00;HOME";
				ussd_proceed($ussd_text);
			}
			if($c ==3)
			{
				$ussd_text = "BUY 350MB + wHatsapp @SHS 100 using: <br><br> 1.Airtime<br><br> 2. Mpesa<br><br>0;BACK 00;HOME";
				ussd_proceed($ussd_text);
			}
			if($c ==4)
			{
				$ussd_text = "BUY 1GB + wHatsapp @SHS 500 using: <br><br> 1.Airtime<br><br> 2. Mpesa<br><br>0;BACK 00;HOME";
				ussd_proceed($ussd_text);
			}
			if($c ==5)
			{
				$ussd_text = "BUY 4GB + wHatsapp @SHS 1000 using: <br><br> 1.Airtime<br><br>2. Mpesa<br><br>0 0;BACK 00;HOME 2. Mpesa<br><br>";
				ussd_proceed($ussd_text);

			}
		}
		


function ussd_proceed($ussd_text)
{
	echo "CON $ussd_text";
	exit(0);
}

//USSD stop reply
function ussd_stop($ussd_text)
{
	echo "END $ussd_text";
	exit(0);
}

function curl_post()
{
	$url = 'http://anpr.ardhisoft.com/api/app/login';

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header

	$curl_post_data = array(
	  'username' => 'staff123',
	  'password' => 'staff123',
	);

	$data_string = json_encode($curl_post_data);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	$curl_response = curl_exec($curl);
	ussd_proceed($curl_response);
}

function webservice(){
	$auth_url = 'IP ADRDRESS:8090/mpesaservice/authenticate';
	$stk_push_url = 'IP ADDRESS:8090/mpesaservice/api/stk/STKPush';
	$username= 'okoth@mail.com';
	$password = 'zg3qwfq52fawe';

	//setup the request, you can also use CURLOPT_URL
	$ch = curl_init($auth_url);

	$header = array(
	    'Content-Type: application/x-www-form-urlencoded',
	    'Authorization: Basic '. base64_encode("$username:$password")
	);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

	$fields = array(
	  'username'=> urlencode($username),
	  'password'=> urlencode($password),
	);

	$fields_string = '';

	//url-ify the data for the POST
	foreach($fields as $key=>$value) 
	{ 
		$fields_string .= $key.'='.$value.'&'; 
	}
	rtrim($fields_string, '&');

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE);
	curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE);
	//curl_setopt($ch, CURLOPT_HEADER, true);

	$data = curl_exec($ch);
	//print_r($data);

	$pattern = "#Set-Cookie: (.*?; path=.*?;.*?)\n#";
	preg_match_all($pattern, $data, $matches);
	array_shift($matches);
	$cookie = implode("\n", $matches[0]);
	//print_r("cookie: ".$cookie);

	curl_setopt($ch, CURLOPT_URL, $stk_push_url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

	$curl_post_data = array(
	  'Amount'=> 1,
	  'CallBackURL'=> 'http://197.232.25.77:8081/bimas_mbs/mpesa_lnmo/callback',
	  'PhoneNumber'=> '254703999262',
	  'PartyA'=> 'Bimas Customer',
	  'PartyB'=> 'Bimas',
	  'AccountReference'=> '346345634564567',
	  'TransactionDesc'=> 'Deposit Transaction to Bimas Account null',
	  'BusinessShortCode'=> '350050'
	);

	$data_string = json_encode($curl_post_data);
	//print_r($data_string."</br>");

	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	curl_setopt($ch, CURLOPT_AUTOREFERER, true);
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	//curl_setopt($ch, CURLOPT_HEADER, true);

	$curl_response = curl_exec($ch);
	ussd_proceed($curl_response); 
	curl_close($ch);
}
?>
