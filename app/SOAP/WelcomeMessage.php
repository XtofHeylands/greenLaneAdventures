<?php


namespace App\SOAP;


class WelcomeMessage
{
    /**
     * @var string
     */
    protected $user;

    /**
     * WelcomeMessage constructor.
     * @param string $user
     */
    public function __construct($user){
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getName(){
       return $this->user;
    }

}
