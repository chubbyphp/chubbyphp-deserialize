<?php

declare(strict_types=1);

namespace Chubbyphp\Deserialization\Mapping;

use Chubbyphp\Deserialization\Denormalizer\FieldDenormalizerInterface;

interface DenormalizingFieldMappingBuilderInterface
{
    /**
     * @param string $name
     *
     * @return self
     */
    public static function create(string $name): self;

    /**
     * @param array $groups
     *
     * @return self
     */
    public function setGroups(array $groups): self;

    /**
     * @param FieldDenormalizerInterface $fieldDenormalizer
     *
     * @return self
     */
    public function setFieldDenormalizer(FieldDenormalizerInterface $fieldDenormalizer): self;

    /**
     * @return DenormalizingFieldMappingInterface
     */
    public function getMapping(): DenormalizingFieldMappingInterface;
}
