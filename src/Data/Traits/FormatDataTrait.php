<?php

namespace TeiaCardSdk\Data\Traits;

use TeiaCardSdk\Data\Contracts\DataInterface;

trait FormatDataTrait
{
    /**
     * @param array $data
     * @return DataInterface
     */
    public static function createFromArray(array $data): DataInterface
    {
        /** @var DataInterface $self */
        $self = new self();

        foreach ($data as $key => $value) {
            $self->{$key} = $value;
        }

        return $self;
    }
}
