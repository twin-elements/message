<?php

namespace TwinElements\Component\Message;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MessageBuilderFactory
{
    private ParameterBagInterface $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        if (!$parameterBag->has('postmaster_email')) {
            throw new \Exception('no postmaster email');
        }
        $this->parameterBag = $parameterBag;
    }

    public function createMessageBuilder(): MessageBuilder
    {
        return new MessageBuilder($this->parameterBag);
    }
}
