<?php
namespace Emizen\Smtp\Model;


class Transport extends \Zend_Mail_Transport_Smtp implements \Magento\Framework\Mail\TransportInterface
{
    /**
     * @var \Magento\Framework\Mail\MessageInterface
     */
    protected $_message;
    protected $_scopeConfig;

    /**
     * @param MessageInterface $message
     * @param null $parameters
     * @throws \InvalidArgumentException
     */
    public function __construct(\Magento\Framework\Mail\MessageInterface $message, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {

        if (!$message instanceof \Zend_Mail) {
            throw new \InvalidArgumentException('The message should be an instance of \Zend_Mail');
        }

        $this->_scopeConfig = $scopeConfig;

        
         $host = $this->_scopeConfig->getValue('smtp/configuration/hostname', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

         $portData = $this->_scopeConfig->getValue('smtp/configuration/port', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
         $username = $this->_scopeConfig->getValue('smtp/configuration/login', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
         $password = $this->_scopeConfig->getValue('smtp/configuration/password', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
         $ssl_tls = $this->_scopeConfig->getValue('smtp/configuration/ssl', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);


         if(!empty($host) && !empty($portData) && !empty($username) && !empty($password) && !empty($ssl_tls) ){

             $smtpHost = $host;

             $smtpConf = [
            'auth' => 'login',//auth type
            $ssl_tls => $ssl_tls, 
            'port' => $portData,
            'username' => $username,//smtm user name
            'password' => $password//smtppassword 
            ];

          
         parent::__construct($smtpHost, $smtpConf);

        }else{
           parent::__construct();
       }
   $this->_message = $message;
}

    /**
     * Send a mail using this transport
     * @return void
     * @throws \Magento\Framework\Exception\MailException
     */
    public function sendMessage()
    {
        try {
            parent::send($this->_message);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\MailException(new \Magento\Framework\Phrase($e->getMessage()), $e);
        }
    }

    public function getMessage()
    {
        return $this->message;
    }
}
