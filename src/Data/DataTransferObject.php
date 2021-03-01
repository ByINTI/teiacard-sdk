<?php

namespace TeiaCardSdk\Data;

use JsonException;
use ReflectionClass;
use TeiaCardSdk\Data\Contracts\DataInterface;
use TeiaCardSdk\Exceptions\TeiaCardBaseException;

abstract class DataTransferObject implements DataInterface
{
    /**
     * @return string
     * @throws TeiaCardBaseException
     */
    public function toJson(): string
    {
        try {
            return json_encode(
                $this->toArray(),
                JSON_THROW_ON_ERROR
                | JSON_PRETTY_PRINT
                | JSON_UNESCAPED_SLASHES
                | JSON_UNESCAPED_UNICODE
                | JSON_PRESERVE_ZERO_FRACTION
            );
        } catch (JsonException $e) {
            throw new TeiaCardBaseException('Error encoding to JSON', $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];

        $class = new ReflectionClass(static::class);

        $properties = $class->getProperties();

        foreach ($properties as $reflectionProperty) {
            if ($reflectionProperty->isStatic()) {
                continue;
            }

            $reflectionProperty->setAccessible(true);

            $array[$reflectionProperty->getName()] = $reflectionProperty->getValue($this);
        }

        $array = $this->parseArray($array);

        return $array;
    }

    protected function parseArray(array $array): array
    {
        foreach ($array as $key => $value) {
            if ($value instanceof self) {
                $array[$key] = $value->toArray();
                continue;
            }

            if (!is_array($value)) {
                continue;
            }

            $array[$key] = $this->parseArray($value);
        }

        return $array;
    }
}
