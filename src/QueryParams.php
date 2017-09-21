<?php declare(strict_types=1);

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

    public function __construct($email, int $waitDays = 5, string $order = null)
    {
        Assertion::email($email);

        $this->email    = $email;
        $this->waitDays = $waitDays;
        $this->order    = $order;
    }

    public function toArray(): array
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
