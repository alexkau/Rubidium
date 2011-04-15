<?php
/**
 * Output handler for contact form module
 * @package rubidium 
 */

/**
 * Output handler for contact form module * @author alex
 * @package rubidium
 */
class module_contact {
	static public $post		= null;
	static public $pageContent	= null;
	
	/**
	 * Will always be true (-> form or email confirmation)
	 * @return boolean
	 */
	function validateLoad() {
		return true;
	}
	
	/**
	 * Returns true if the request was valid, otherwise sends the appropriate error
	 * @return boolean
	 */
	function checkPostData() {
		self::$post = rubidium::$request['POST'];
		if (self::$post['subject'] != '') {
			if (self::$post['message'] != '') {
				if (self::$post['return_addr'] != '') {
					if (self::validateCaptcha()) {
						return true;
					} else {
						outputHandler::setLoadInfoVar('error', 'You did not enter the validation code correctly.');
						return false;
					}
				} else {
					outputHandler::setLoadInfoVar('error', 'You must enter a return address.');
					return false;
				}
			} else {
				outputHandler::setLoadInfoVar('error', 'You must enter a message.');
				return false;
			}
		} else {
			outputHandler::setLoadInfoVar('error', 'You must enter a subject for the email.');
			return false;
		}
	}
	
	/**
	 * Sends the email
	 */
	function sendMessage() {
		self::$post['content'] = wordwrap(self::$post['content'], 70);
		mail(rubidium::$settings['contact_email']['value'], self::$post['subject'], self::$post['message']);
	}
	
	/**
	 * Validates the captcha against the reCaptcha servers
	 * @return boolean
	 */
	function validateCaptcha() {
		require_once(ROOT_PATH . '3rdparty/recaptchalib.php');
		$privatekey = rubidium::$settings['recaptcha_private_key']['value'];
		$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
		if ($resp->is_valid) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Displays the contact form or a confirmation if the message was successfully sent
	 * @return array
	 */
	function returnPage() {
		//Can't nest these if statements or it'll throw errors on a newly-loaded page
		if (rubidium::$request['GET']['submit'] == 'true') {
			if (self::checkPostData()) {
				self::sendMessage();
				outputHandler::setLoadInfoVar('message', 'The message was successfully sent.');
				self::$pageContent['templateToLoad']	= 'confirm';
			} else {
				require_once(ROOT_PATH . '3rdparty/recaptchalib.php');
				self::$pageContent['templateToLoad']	= 'form';
				outputHandler::setLoadInfoVar('recaptcha', recaptcha_get_html(rubidium::$settings['recaptcha_public_key']['value']));
			}
		} else {
			require_once(ROOT_PATH . '3rdparty/recaptchalib.php');
			self::$pageContent['templateToLoad']	= 'form';
			outputHandler::setLoadInfoVar('recaptcha', recaptcha_get_html(rubidium::$settings['recaptcha_public_key']['value']));
		}
		self::$pageContent['templateCategory']	= 'modules/contact';
		return self::$pageContent;
	}
}
