<?php

namespace TeiaCardSdk;

use Illuminate\Support\Collection;
use RuntimeException;
use stdClass;

/**
 * Class Anonymous
 * @package TeiaCardSdk
 *
 * @method Collection login()
 * @method Collection list()
 * @method Collection status(int $id)
 * @method Collection send()
 */
class Anonymous extends stdClass
{
    /**
     * @param string $methodName
     * @param array $params
     * @return mixed
     */
    public function __call(string $methodName, array $params)
    {
        if (!isset($this->{$methodName})) {
            throw new RuntimeException('Call to undefined method ' . __CLASS__ . '::' . $methodName . '()');
        }

        return $this->{$methodName}->__invoke(... $params);
    }
}
