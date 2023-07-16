<?php
declare(strict_types=1);

namespace App\Form;


use Laminas\Form\Form;
use Laminas\InputFilter\Input;
use Laminas\InputFilter\InputFilter;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\StringLength;

class TestForm extends Form
{
    public function __construct()
    {
        parent::__construct('TestForm', []);
        $this->add(
            [
                'name' => 'username',
                'type' => 'text'
            ],
            [
                'name' => 'email',
                'type' => 'text'
            ]
        );
        $username = new Input('username');
        $username->getValidatorChain()->attach(new stringLength(['min' => 5]));
        $email = new Input('email');
        $emailValidator = new EmailAddress();
        $emailValidator->getHostnameValidator()->useTldCheck('false');
        $email->getValidatorChain()->attach($emailValidator);
        $inputFilter = new InputFilter();
        $inputFilter->add($username);
        $inputFilter->add($email);
        $this->setInputFilter($inputFilter);
    }
}