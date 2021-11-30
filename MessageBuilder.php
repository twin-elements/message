<?php

namespace TwinElements\Components\Message;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mime\Address;

class MessageBuilder
{
    /**
     * @var string|null
     */
    private $subject;

    /**
     * @var array
     */
    private $to = [];

    /**
     * @var string
     */
    private $from;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        if (!$parameterBag->has('postmaster_email')) {
            throw new \Exception('no postmaster email');
        }

        $this->from = new Address($parameterBag->get('postmaster_email'));
    }

    public function setSubject(string $subject)
    {
        $this->subject = $subject;
    }

    public function addTo(string $email, string $name = '')
    {
        $this->to[] = new Address($email, $name);
    }

    public function getMessage(MessageInterface $data, string $template): TemplatedEmail
    {
        if (count($this->to) === 0) {
            throw new \Exception('No recipient');
        }
        if (is_null($this->subject)) {
            throw new \Exception('No subject');
        }

        return (new TemplatedEmail())
            ->subject($this->subject)
            ->from($this->from)
            ->to(...$this->to)
            ->replyTo($data->getEmail())
            ->htmlTemplate($template)
            ->context([
                'data' => $data
            ]);
    }
}
