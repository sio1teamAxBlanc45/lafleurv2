<?php
	function send_mail()
	{
		$send_to = "XXXX@gmail.com";
		
		
		
		$subject_mail = $_POST['subject'];
		$message_mail = '<html>';
		

		if ($_POST['nom'] == "")
		{
			$message_mail .= '<p>'."Bonjour, ".'<br/>'."Vous avez reçu un message de ".$_POST['mail'].'</p>';
		}
		else
		{
			$message_mail .= '<p>'."Bonjour, ".'<br/>'."Vous avez reçu un message de ".$_POST['mail'].'</p>';
		}

		$message_mail .= '<p>'.'<strong>'.'<br/>'."Objet du message : ".'</strong>'.$subject_mail.'</p>';
		$message_mail .= '<p>'.'<strong>'."Contenu du message : ".'</strong>'.'</p>';
		$message_mail .= '<p>'.nl2br($_POST['message']).'</p>';
		$message_mail .= '</body>';
		$message_mail .= '</html>';

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";?>
		
<?php
		echo $message_mail;?></p>
<?php
		mail($send_to, $subject_mail, $message_mail, $headers);
	}

	if (isset($_POST['sendMail']))
	{
		send_mail();
	}
?>