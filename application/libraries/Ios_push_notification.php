<?php defined('BASEPATH') OR exit('No direct script access allowed');
// Usage: $this->ios->to('DEVICE_ID')->badge(3)->message('Hello world');
/**
 * @author Judhisthira Sahoo <jsahoo@du.sharadtechnologies.com>
 * @package name
 */
class Ios_push_notification{
        private $host_type='sandbox';
	private $host = 'gateway.sandbox.push.apple.com';
	private $port = 2195;
	//private $cert='/var/www/html/'.CURRENT_INSTANCE.'/'.CERTIFICA_PATH.'/'.IOS_PEM_FILE;
	private $cert='/var/www/html/';
	
	private $device = NULL;
	private $message = NULL;
	private $badge = NULL;
	private $sound = 'default';
	
	private $_CI;
	
	public function __construct(){
            $this->_CI =& get_instance();
            if($this->host_type=='sandbox'){
                $this->host='gateway.sandbox.push.apple.com';
            }else{
                $this->host='gateway.push.apple.com';
            }
	}
        
        public function app_cert($cert_path){
            $this->cert=$cert_path;
            return $this;
        }
	
	public function to($device){
		$this->device = $device;
		
		return $this;
	}
	
	public function message($message){
		$this->message = urlencode($message);
		return $this;
	}
	
	public function badge($badge = 1){
		$this->badge = $badge;
		return $this;
	}
	
	public function sound($sound = 'default'){
		$this->sound = $sound;
		return $this;
	}

	public function send(){
            error_reporting(E_ALL);
            @ini_set("display_errors", 1);
            $ctx = stream_context_create();
            //stream_context_set_option($ctx, 'ssl', 'local_cert', '/var/www/html/push/cert.pem');
            //echo $this->cert;die;
            stream_context_set_option($ctx, 'ssl', 'local_cert', $this->cert.CURRENT_INSTANCE.'/'.CERTIFICA_PATH.'/'.IOS_PEM_FILE);
            //stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

            // Open a connection to the APNS server
            $fp = stream_socket_client('ssl://' . $this->host . ':' . $this->port, $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
            //$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,$errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

            if (!$fp){
                @mail('jsahoo@du.sharadtechnologies.com','push notificaion send error',"Failed to connect: $err $errstr" . PHP_EOL);
                return '0';
            }        
            if (!$fp)
                    exit("Failed to connect: $err $errstr" . PHP_EOL);

            echo 'Connected to APNS' . PHP_EOL;

            // Create the payload body
            $body['aps'] = array(
                    'alert' => $this->message,
                    'sound' => 'default',
                    'badge'=> $this->badge
                    );

            // Encode the payload as JSON
            $payload = json_encode($body);

            // Build the binary notification
            $msg = chr(0) . pack('n', 32) . pack('H*',sprintf('%u', CRC32($this->device))) . pack('n', strlen($payload)) . $payload;
            //$token = pack('H*', str_replace(' ', '', sprintf('%u', CRC32($this->device))));
            //$msg = chr(0) . chr(0) . chr(32) . $token . chr(0) . chr(strlen($payload)) . $payload;
            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));
            echo '<pre>';print_r($result);
            // Close the connection to the server
            fclose($fp);
            if (!$result){
                //@mail('jsahoo@du.sharadtechnologies.com','push notificaion send error',"Failed to connect: $err $errstr" . PHP_EOL);
                $this->send_mail('jsahoo@du.sharadtechnologies.com','push notificaion send error',"Failed to connect: $err $errstr" . PHP_EOL);
                return '0';
                //echo ' not send ';
            }else{
                $this->send_mail('jsahoo@du.sharadtechnologies.com','push notificaion send',$msg);
                return '1';
                //echo ' send ';
            }   
	}
        
    function send_mail($email,$subject,$message){
        $CI=& get_instance();
        $CI->load->library('email');
        
        $config                 =   array();
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "sharadtechnologies.in@gmail.com"; 
        $config['smtp_pass'] = "Sharad1!";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['crlf']    = "\n"; 
        $config['wordwrap'] = TRUE;
        //$config['charset'] = 'iso-8859-1';
        
        $CI->email->initialize($config);

        $CI->email->from('no-reply@sharadtechnologies.com', 'No-reply');
        $CI->email->to($email);
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $CI->email->subject($subject);
        $CI->email->message($message);

        $CI->email->send();
        echo $CI->email->print_debugger();
    }    
}