<?php

namespace TeiaCardSdk\Data\Contracts;

interface DataInterface
{
    public static function createFromArray(array $data): DataInterface;

    public function toArray(): array;

    public function toJson(): string;
}
