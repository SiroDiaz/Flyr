<?php namespace Flyr\Components;

class Mail {
	
	/**
	 * The instanced PHPMailer class 
	 *
	 * @access protected 
	 */

	protected $mail;
	
	/**
	 * The email server name
	 * for example smtp.google.com for Gmail
	 *
	 * @access protected
	 */

	protected $server;

	/**
	 * The server port
	 *
	 * @access protected
	 */

	protected $port;

	/**
	 * the email that sends the messages
	 *
	 * @access protected
	 */

	protected $email;

	/**
	 * The password for the email account
	 *
	 * @access protected
	 */

	protected $password;

	/**
	 *
	 */

	protected $charset;

	/**
	 * The data type that the email will contain
	 *
	 * @access protected
	 */

	protected $html;

	/**
	 * The template name
	 *
	 * @access protected
	 */

	protected $template;

	/**
	 * Initializes the email setting all the configuration
	 * related with the SMTP server.
	 * 
	 * Associative Array keys: server, port, email, password, charset
	 * 
	 * @param array $opt The configuration array
	 */	

	public function __construct($opt) {
		$this->mail = new \PHPMailer();
		
		$this->server = $opt['server'];
		$this->port = $opt['port'];
		$this->email = $opt['email'];
		$this->password = $opt['password'];
		$this->charset = $opt['charset'];
		
		$this->setMailConfig();
	}
	
	/**
	 * Set the template to render.
	 * 
	 * @param string $template The template name
	 */
	
	public function setTemplate($template) {
		$this->template = $template;
	}
	
	/**
	 * Returns the template name.
	 * 
	 * @return string The template name
	 */
	
	public function getTemplate() {
		return $this->template;
	}
	
	/**
	 * Set the PHPMailer configuration.
	 */
	
	public function setMailConfig() {
		$this->mail->isSMTP();
		$this->mail->Host = $this->server;
		$this->mail->SMTPDebug = 0;			// debug mode activated by default
		$this->mail->SMTPAuth = true;
		
		$this->mail->Port = $this->port;
		$this->mail->Username = $this->email;
		$this->mail->Password = $this->password;
		$this->mail->SMTPSecure = 'ssl';	// stablish secure connection
	}
	
	/**
	 * Set the transmitter and receiver email and name.
	 * 
	 * @param array $from transmitter data
	 * @param array $to receiver data
	 */
	
	public function setEmailHeaders($from, $to) {
		if(!empty($from['name']) && isset($from['name'])) {
			$this->mail->From = $from['email'];
			$this->mail->FromName = $from['name'];
		} else {
			$this->mail->From = $from['email'];
		}
		
		if(empty($to['name'])) {
			$this->mail->addAddress($to['email']);
		} else {
			$this->mail->addAddress($to['email'], $to['name']);
		}
	}
	
	/**
	 * Set the maximum line length.
	 */
	
	public function addWordWrap($wrap) {
		if(is_int($wrap)) {
			$this->mail->WordWrap = $wrap;
		}
	}
	
	/**
	 * Sets the subject, the body and the charset.
	 * 
	 * @param string $template The template name
	 * @param array $data The data to set to the template
	 * @para string $subject The message subject
	 */
	
	public function setEmailMessage($template, $data = [], $subject = '') {
		$view = new \Flyr\View();
		$this->setTemplate($template);
		$this->mail->Subject = $subject;
		$this->mail->isHTML(true);
		// by default false the third param to get the rendered template
		$body = $view->render($this->getTemplate(), $data, false);

		$this->mail->Body = $body;
		$this->mail->AltBody = strip_tags($body);
		$this->mail->CharSet = $this->charset;
	}
	
	/**
	 * Checks if it is a file and exists.
	 * 
	 * @return bool true if is a file and exists
	 */
	 
	private function isValidFile($file) {
		return (is_file($file) && file_exists($file));
	}
	
	/**
	 * Attach files to the email to be sent.
	 * 
	 * @param string $file The file route
	 */

	public function emailAttachFiles($file) {
		if($this->isValidFile($file)) {
			$this->mail->addAttachment($files);
		}
	}
	
	/**
	 * Send the email.
	 *
	 * @return bool
	 */

	public function send() {
		if($this->mail->send()) {
			return true;
		} else {
			throw new Exception($this->mail->ErrorInfo);	
		}
	}
}