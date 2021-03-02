<?php

namespace TeiaCardSdk\Data\Interfaces;

interface DataInterface
{
    public function toArray(): array;

    public function toJson(): string;
}
