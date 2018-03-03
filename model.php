<?php

Class DB
{
	private $arr = [
		'dbhost' => 'localhost',
		'dbname' => 'regtask',
		'dbuser' => 'root',
		'dbpass' => ''
		];
	
	public function not_found_email($email)
	{
		$not_found = true;
		$link = new PDO("mysql:host={$this->arr['dbhost']};dbname={$this->arr['dbname']}", $this->arr['dbuser'], $this->arr['dbpass']);
		$result = $link->query('SELECT `email` FROM `users` WHERE email="'.$email.'" limit 1');
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			if ($row['email'] != '') { $not_found = false; }
		}
		
		return $not_found;
	}
	
	public function save_db_hash($email, $hash)
	{
		$link = new PDO("mysql:host={$this->arr['dbhost']};dbname={$this->arr['dbname']}", $this->arr['dbuser'], $this->arr['dbpass']);
		$result = $link->query('UPDATE `users` SET `hash`="'.$hash.'" WHERE email="'.$email.'" limit 1');
		
		return $result;
	}
} 
// Class DB

Class PromoCodes
{
	public $promocodes = [
		'a1b6' => '10',
		'b2c9' => '20',
		'c8d1' => '30',
		'd6e2' => '40',
		'e4f5' => '50',
		'f3g7' => '60',
		'g4h3' => '70'
	];
	public $score = '0';
	
	public function __construct($code)
	{
		foreach ($this->promocodes AS $key => $score)
		{
			if ($key == $code) 
			{ 
				$this->score =  $score;
				break;
			}
		}
	} 
	// check_code
	
} 
// Class PromoCodes


Class User
{
	private $attr = [];
	public $approved = false;
	public $confirmed = false;
	private $id;
	private $hash;
	
	public function __construct($post_attr = [], $score = '0')
	{
		if  (isset($post_attr['title'])
			&& isset($post_attr['firstname'])	
			&& isset($post_attr['family'])	
			&& isset($post_attr['street'])	
			&& isset($post_attr['number'])	
			&& isset($post_attr['zip'])	
			&& isset($post_attr['email'])	
		){ 
			foreach($post_attr as $key => $value) {
				switch($key) {
					case 'email' : 
						$this->attr[$key] = $value;
						$this->approved = $score > '0' && $this->unique_email($post_attr['email']); 
						break;
					case 'birthday' : 
						$this->attr['birthday'] = $post_attr['day'] . '/' . $post_attr['month'] . '/' . $post_attr['year'];
						break;
					default : $this->attr[$key] = $value; break;
				}
			}
		}
		else 
		{
			// there aren't $_POST vars
			$this->approved = false;
		}
	} 
	// __construct
	
	private function unique_email($mail)
	{
		$db = new DB();
		return $db->not_found_email($mail);
	}
	// unique_email
	
	public function save_hash()
	{
		// random hash
		$this->hash = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
		$db = new DB();
		$db->save_db_hash($this->attr['email'], $this->hash);
	}
	
	public function send_email()
	{
		$this->save_hash();
		
		$email_to = $this->attr['email'];
		$email_from = 'no_reply@vuchkov.biz';
		$email_subject = 'Vuchkov.biz - Email confirmation';
		
		$email_message = "Please visit the following link to confirm your registration.\n\n";
		$email_message .= "http://www.vuchkov.biz/regtask/index.php?action=confirm&hash=".$this->attr['hash']."\n\n";
		
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/plain; charset=utf-8\r\n";
		$headers .= "From: <".$email_from.">\r\n";
		$headers .= "Reply-To: <".$email_from.">\r\n";
		$headers .= "Return-Path: <".$email_to.">\r\n";
		$headers .= "Date: ".date("r")."\r\n";
		$headers .= "Message-ID: <".time()."-".$email_to.">\r\n";
		$headers .= "X-Originating-IP: [".$_SERVER[REMOTE_ADDR]."]\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion();
		mail($email_to, $email_subject, $email_message, $headers);
		
		return true;
	}

}
// Class User