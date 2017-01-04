<?php

namespace Egugue\BookingSerivce\CheckBooking\Util;

use InvalidArgumentException;
use ReflectionObject;

/**
 * http://qiita.com/Hiraku/items/71e385b56dcaa37629fe
 */
abstract class Enum
{
  private $scalar;

  public function __construct($value)
  {
    $ref = new ReflectionObject($this);
    $consts = $ref->getConstants();
    if (!in_array($value, $consts, true)) {
      throw new InvalidArgumentException;
    }

    $this->scalar = $value;
  }

  final public static function __callStatic($label, $args)
  {
    $class = get_called_class();
    $const = constant("$class::$label");
    return new $class($const);
  }

  final public function valueOf()
  {
    return $this->scalar;
  }

  final public function __toString()
  {
    return (string)$this->scalar;
  }
}
