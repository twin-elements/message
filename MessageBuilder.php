<?php

namespace TwinElements\Component\Message;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mime\Address;

class MessageBuilder
{
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

    public function getMessage(string $subject, ?array $data, string $template): TemplatedEmail
    {
        return (new TemplatedEmail())
            ->subject($subject)
            ->from($this->from)
            ->htmlTemplate($template)
            ->context($data);
    }
}
