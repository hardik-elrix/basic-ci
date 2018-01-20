<?php

class Utility
{
	/*
	 * REFERENCE BY :
	 * http://stackoverflow.com/questions/27633584/php-fatal-error-call-to-undefined-function-mcrypt-get-iv-size-in-appserv
	 */

	//public $skey = "WOADMIN0000000000-CRTD17032017\0\0";
	public $skey = "ZESTBRN0000000000-20171221HARDIK";

	function encodeText($value, $removeTags = false)
	{
		if (is_array($value))
		{
			foreach ($value as $k => $v)
			{
				$val = $removeTags ? strip_tags($v) : $v;
				$val = addslashes($val);
				$value [$k] = $val;
			}
		}
		else
		{
			$value = $removeTags ? strip_tags($value) : $value;
			$value = addslashes($value);
		}
		return $value;
	}

	function decodeText($value, $htmlEntity = false)
	{
		if (is_array($value))
		{
			foreach ($value as $k => $v)
			{
				$val = stripslashes($v);
				$value [$k] = $htmlEntity ? htmlentities($val) : $val;
			}
		}
		elseif (is_object($value))
		{
			foreach ($value as $k => $v)
			{
				$val = stripslashes($v);
				$value->$k = $htmlEntity ? htmlentities($val) : $val;
			}
		}
		else
		{
			$value = stripslashes($value);
			$value = $htmlEntity ? htmlentities($value) : $value;
		}
		return $value;
	}

	public function safe_b64encode($string)
	{
		$data = base64_encode($string);
		$data = str_replace(array(
			'+',
			'/',
			'='
			), array(
			'-',
			'_',
			''
			), $data);
		return $data;
	}

	public function safe_b64decode($string)
	{
		$data = str_replace(array(
			'-',
			'_'
			), array(
			'+',
			'/'
			), $string);
		$mod4 = strlen($data) % 4;
		if ($mod4)
		{
			$data .= substr('====', $mod4);
		}
		return base64_decode($data);
	}

	public function encode($value)
	{
		if (!$value)
		{
			return false;
		}
		$encoded      = mcrypt_encrypt( 'AES-256-CBC', md5( $this->skey ), $value, MCRYPT_MODE_CBC, md5( md5( $this->skey ) ) ) ;
		return trim($this->safe_b64encode($encoded));
	}

	public function decode($value)
	{
		if (!$value)
		{
			return false;
		}
        $decoded =  rtrim( mcrypt_decrypt( 'AES-256-CBC', md5( $this->skey ), base64_decode( $value ), MCRYPT_MODE_CBC, md5( md5( $this->skey ) ) ), "\0");
		return (trim($this->safe_b64decode($decoded)));
	}

	public function setFlashMessage($type, $message)
    {
		$CI = & get_instance();
		$template = '<div class="alert alert-' . $type . ' alert-dismissible text-center" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>' . $message . '</div>';
		$CI->session->set_flashdata("myMessage", $template);
	}

	public function sendMailSMTP($data)
	{
		$config ['protocol'] = "smtp";
		$config ['smtp_host'] = 'ssl://cs-mum-3.webhostbox.net';
		$config ['smtp_port'] = '465';
		$config ['smtp_user'] = 'hardik@elrix.org';
		$config ['smtp_pass'] = 'pass';
		$config ['smtp_timeout'] = 20;
		$config ['priority'] = 1;

		$config ['charset'] = 'utf-8';
		$config ['wordwrap'] = TRUE;
		$config ['crlf'] = "\r\n";
		$config ['newline'] = "\r\n";
		$config ['mailtype'] = "html";

		$CI = & get_instance();
		$message = $data ["message"];
		$CI->load->library('email', $config);
		$CI->email->clear();
		$CI->email->from($config ['smtp_user'], $data ['from_title']);
		$CI->email->to($data ["to"]);
		if (isset($data ["bcc"]))
		{
			$CI->email->bcc($data ["bcc"]);
		}
		$CI->email->reply_to($config ['smtp_user'], $data ['from_title']);
		$CI->email->subject($data ["subject"]);
		$CI->email->message($CI->utility->decodeText($message));
		$CI->email->send();
		return true;
	}

	// mail function
	function sendMail($row)
	{
		$CI = & get_instance();
		$to = $row ['to'];
		$subject = $row ['subject'];
		$data = $row ['extraData'];
		if (isset($row ['templatePath']))
		{
			$message = $CI->load->view($row ['templatePath'], $data, true);
		}
		else
		{
			$message = $row ['message'];
		}

		$from = $row ['from'];
		/*
		 * $headers = 'From: ' . $row ['fromTitle'] . '<noreply@websoptimization.com>' . "\r\n";
		 * $headers .= 'MIME-Version: 1.0' . "\r\n";
		 * $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		 * $headers .= 'Reply-To: noreply@websoptimization.com' . "\r\n";
		 * $headers .= 'Return-Path: noreply@websoptimization.com' . "\r\n";
		 * return mail($to, $subject, html_entity_decode($message), $headers, "-fnoreply@websoptimization.com");
		 */

		$bcc = isset($row ['bcc']) ? $row ['bcc'] : "";
		$emailData ['to'] = $to;
		$emailData ['bcc'] = $bcc;
		$emailData ['subject'] = $subject;
		$emailData ['message'] = $message;
		return $this->sendMailSMTP($emailData);
	}

	public function generate_OTP($length)
	{
		$chars = '1234567890987654321';
		$chars_length = (strlen($chars) - 1);
		$string = $chars{rand(0, $chars_length)};
		for ($i = 1; $i < $length; $i = strlen($string))
		{
			$r = $chars{rand(0, $chars_length)};
			if ($r != $string{$i - 1})
				$string .= $r;
		}
		return $string;
	}

	public function send_otp($number, $otp)
	{
		$number = '91' . $number;
		$msg = 'OTP+for+Jivika+Access+is+' . $otp . '+.+Please+call+us+on+9429572990+For+any+query.+Regards%2C+Team+Elrix.';
		//https://control.msg91.com/api/sendotp.php?authkey=162554Agtz20kI9d594e8116&mobile=9429572990&message=Your%20OTP%20is%200808&sender=TMRERA&otp=$otp
		$url = 'https://control.msg91.com/api/sendotp.php?authkey=162554AC1vfzRIo5953f08d&mobile=' . $number . '&message=' . $msg . '&sender=JIVIKA&otp=' . $otp;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		//  curl_setopt($ch,CURLOPT_HEADER, false);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}

	/**
	 * For SEO url
	 * This function is used for create seo url with alphabats, digits and dash only
	 */
	public function SEOUrl($string)
	{
		$pattern = '/[^a-zA-Z 0-9]+/i';
		$replacement = '';
		$string = preg_replace($pattern, $replacement, $string);
		return $catURL = str_replace(" ", "-", $string);
	}

	/*
	 * createPagination()
	 * This function is used to generate pagination on admin side.
	 * Developer - Jayesh Rathod
	 *
	 * Datetime - 11-01-2016 01:20 PM
	 * Update Date -
	 * @param:String $paginationUrl this is url of pagination for every contoller
	 * @param:Integer $totalRows total number of records.
	 * @param:Integer $perPage number of records per page.
	 * @param:Integer $uriSegment segment of url to get current page.
	 * wrapping.
	 * return: no return value;
	 */

	function createPagination($paginationUrl = "", $totalRows = 0, $perPage = 100, $uriSegment = 4)
	{
		$CI = & get_instance();
		// PAGINATION CLASS
		$config ['base_url'] = $paginationUrl;
		$config ['total_rows'] = $totalRows;
		$config ['per_page'] = $perPage;
		$config ['uri_segment'] = $uriSegment;
		$config ['full_tag_open'] = '<nav class="pagination_down"><ul class="pagination">';
		$config ['full_tag_close'] = '</ul></nav><!--pagination-->';
		$config ['first_link'] = '&laquo; &laquo;';
		$config ['first_tag_open'] = '<li class="prev page">';
		$config ['first_tag_close'] = '</li>';
		$config ['last_link'] = '&raquo;&raquo;';
		$config ['last_tag_open'] = '<li class="next page">';
		$config ['last_tag_close'] = '</li>';

		$config ['next_link'] = '&raquo;';
		$config ['next_tag_open'] = '<li class="next page">';
		$config ['next_tag_close'] = '</li>';

		$config ['prev_link'] = '&laquo;';
		$config ['prev_tag_open'] = '<li>';
		$config ['prev_tag_close'] = '</li>';

		$config ['cur_tag_open'] = '<li class="active"><a href="">';
		$config ['cur_tag_close'] = '</a></li>';

		$config ['num_tag_open'] = '<li class="page">';
		$config ['num_tag_close'] = '</li>';
		$CI->pagination->initialize($config);
	}

	public function send_push($tokens, $message)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
			'registration_ids' => $tokens,
			'data' => $message
		);
		$headers = array(
			'Authorization:key = ' . FCM_API_KEY,
			'Content-Type: application/json'
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		curl_close($ch);
		if ($result === FALSE)
		{
			//die('Curl failed: ' . curl_error($ch));
			return FALSE;
		}
		else
		{
			return $result;
		}
	}

	function send_sms($mobile, $message)
	{
		$mobileNumber = '91' . $mobile;
		//Your authentication key
		$authKey = '162554AC1vfzRIo5953f08d';
		$senderId = 'JIVIKA';
		//Your message to send, Add URL encoding here.
		$message = urlencode($message);
		//Define route
		$route = "4";
		$postData = array(
			'authkey' => $authKey,
			'mobiles' => $mobileNumber,
			'message' => $message,
			'sender' => $senderId,
			'route' => $route
		);
		$url = "https://control.msg91.com/api/sendhttp.php";
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData
		));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);
		if (curl_errno($ch))
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function send_sms_otp($number, $msg, $otp = '0000')
	{
		$number = '91' . $number;
		$msg = urlencode($msg);
		//$msg = 'OTP+for+Jivika+login+is+' . $otp . '+.+Please+call+us+on+9429572990+For+any+query.+Regards%2C+Team+Elrix.';
		//https://control.msg91.com/api/sendotp.php?authkey=162554Agtz20kI9d594e8116&mobile=9429572990&message=Your%20OTP%20is%200808&sender=TMRERA&otp=$otp
		$url = 'https://control.msg91.com/api/sendotp.php?authkey=162554AC1vfzRIo5953f08d&mobile=' . $number . '&message=' . $msg . '&sender=JIVIKA&otp=' . $otp;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		//  curl_setopt($ch,CURLOPT_HEADER, false);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}

	public function uploadImg($config, $upload_key)
	{
		$CI = & get_instance();
		$CI->load->library('upload', $config);
		if (!$CI->upload->do_upload($upload_key))
		{
			$data ['error'] = $CI->upload->display_errors();
			return false;
		}
		else
		{
			return true;
		}
	}

}
