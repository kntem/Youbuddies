<?php
	require_once '../php-sdk/src/facebook.php';
	$facebook = new Facebook(array(
		'appId'  => '166815126764719',
		'secret' => '5db9fed1b100246aee7d84e80b185e5a',
	));

	$user = $facebook->getUser();
	$profile = array();
	try {
		$profile = $facebook->api("/me");
		$name = $profile['name'];
	} catch (FacebookApiException $e) {
		$loginUrl = $facebook->getLoginUrl(array(
			'canvas' => 1,
			'fbconnect' => 0,
			'scope' => 'publish_stream, read_stream',
			'redirect_uri' => 'http://cyberang3l.ath.cx:33335/youtube/AfterLogin/',
			'display' => 'popup'
		));
		$return['user'] = "error";
		$return['name'] = "error";
	}

	if ($user) { 
		try {
			$return['user'] = $user;
			$return['name'] = $name;
		} catch (FacebookApiException $e) {
			$loginUrl = $facebook->getLoginUrl(array(
				'canvas' => 1,
				'fbconnect' => 0,
				'scope' => 'publish_stream, read_stream',
				'redirect_uri' => 'http://cyberang3l.ath.cx:33335/youtube/AfterLogin/',
				'display' => 'popup'
			));
			$return['user'] = "error";
			$return['name'] = "error";
		}
	}
	else { 
		$loginUrl = $facebook->getLoginUrl(array(
			'canvas' => 1,
			'fbconnect' => 0,
			'scope' => 'publish_stream,  read_stream',
			'redirect_uri' => 'http://cyberang3l.ath.cx:33335/youtube/AfterLogin/',
			'display' => 'popup'
		));
		$return['user'] = "error";
		$return['name'] = "error";
	}
	echo json_encode($return);
?>