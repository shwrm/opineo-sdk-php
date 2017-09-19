<?php

namespace Shwrm\Opineo;

use Assert\Assertion;

class QueryParams
{
    /**
     * @var string
     */
    private $email;

    /**
     * how many days until email will be send
     *
     * @var string
     */
    private $waitDays;

    /**
     * @var null|string
     */
    private $order;

    public function __construct($email, $waitDays = 5, $order = null)
    {
        Assertion::email($email);
        Assertion::integer($waitDays);
        Assertion::nullOrString($order);

        $this->email    = $email;
        $this->waitDays = $waitDays;
        $this->order    = $order;
    }

    public function toArray()
    {
        $return = [
            'type'  => 'php',
            'email' => $this->email,
            'queue' => $this->waitDays,
        ];
        if (false === empty($this->order)) {
            $return['order_no'] = $this->order;
        }

        return $return;
    }
}
