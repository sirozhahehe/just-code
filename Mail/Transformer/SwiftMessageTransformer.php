<?php

namespace Bodyshops\AppBundle\Mail\Transformer;

use Bodyshops\AppBundle\Exception\NotImplementedException;
use Bodyshops\AppBundle\Mail\ReadableMessage;

class SwiftMessageTransformer implements MessageTransformerInterface
{

    public function transformMessage(ReadableMessage $message)
    {
        throw new NotImplementedException('Method not implemented yet.');
    }
}