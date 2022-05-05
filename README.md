##Installation

###Step 1: Download the Bundle

```composer require twin-elements/message```

###Step 2: If you do not use TwinElements/AdminBundle, enable the service 
```
#config/services.yaml
services:
    TwinElements\Component\Message\MessageBuilderFactory: ~```
