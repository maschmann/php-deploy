<?php

namespace Core\Processor;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class SessionRequestProcessor
 *
 * @package CoreBundle\Processor
 * @author Marc Aschmann <maschmann@maschmann@gmail.com>
 */
class SessionRequestProcessor
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var string
     */
    private $token;

    /**
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param array $record
     * @return array
     */
    public function processRecord(array $record)
    {
        if (null === $this->token) {
            try {
                $this->token = substr($this->session->getId(), 0, 8);
            } catch (\RuntimeException $e) {
                $this->token = '????????';
            }
            $this->token .= substr(uniqid(), -8);
        }
        $record['extra']['token'] = $this->token;

        return $record;
    }
}
