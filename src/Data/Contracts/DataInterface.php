<?php

namespace TeiaCardSdk\Data\Contracts;

interface DataInterface
{
    public function toArray(): array;

    public function toJson(): string;
}
