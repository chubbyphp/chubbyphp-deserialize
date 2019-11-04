<?php

declare(strict_types=1);

namespace Chubbyphp\Deserialization\Policy;

use Chubbyphp\Deserialization\Denormalizer\DenormalizerContextInterface;

interface PolicyInterface
{
    /**
     * @param object|mixed $object
     */
    public function isCompliant(DenormalizerContextInterface $context, $object): bool;
}
