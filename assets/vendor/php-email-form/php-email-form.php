<?php

class PHP_Email_Form {
    private $to;
    private $from_name;
    private $from_email;
    private $subject;
    private $message;
    public $smtp = array();

    public function add_message($message, $label = '') {
        if ($label != '') {
            $this->message .= "<p><strong>$label:</strong> $message</p>";
        } else {
            $this->message .= "<p>$message</p>";
        }
    }

    public function send() {
        $headers = "From: $this->from_name <$this->from_email>\r\n";
        $headers .= "Reply-To: $this->from_email\r\n";
        $headers .= "Content-type: text/html\r\n";

        if (!empty($this->smtp)) {
            ini_set('SMTP', $this->smtp['host']);
            ini_set('smtp_port', $this->smtp['port']);
            ini_set('sendmail_from', $this->from_email);
            ini_set('auth_username', $this->smtp['username']);
            ini_set('auth_password', $this->smtp['password']);

            return mail($this->to, $this->subject, $this->message, $headers);
        } else {
            return mail($this->to, $this->subject, $this->message, $headers);
        }
    }
}

?>
