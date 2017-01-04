<?php

namespace Egugue\BookingSerivce\CheckBooking\Util;

/**
 * Providing utility functions related to precondition.
 */
class Precondition
{

  /**
   * Throw InvalidArgumentException having the given message if the given condition is false.
   */
  static function require (bool $condition, string $message)
  {
    if (!$condition) {
      throw new \InvalidArgumentException($message);
    }
  }

  /**
   * Throw InvalidArgumentException if the given value is null.
   *
   * @param string $name the value's name. If assigned, it is used to explain an error message.
   */
  static function requireNotNull($value, string $name = null)
  {
    if ($value !== null) {
      return;
    }

    $message = $name === null
      ? "the value must not be null."
      : "{$name} must not be null.";
    throw new \InvalidArgumentException($message);
  }
}