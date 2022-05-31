##Installation

###Step 1: Download the Bundle

```composer require twin-elements/message```

###Step 2: If you do not use TwinElements/AdminBundle, enable the service 
```
#config/services.yaml
services:
    TwinElements\Component\Message\MessageBuilderFactory: ~
```
###Usage

```
public function index(
        MessageBuilderFactory $messageBuilderFactory,
        MailerInterface       $mailer
    )
    {
        $message = ($messageBuilderFactory->createMessageBuilder()->getMessage(
            'Subject',
            ['key' => 'value'],
            'email_template_path.html.twig'
        ))
            ->addTo('email@email.com');
        
            $mailer->send($message);          
    }
```
