<?php

namespace Egugue\BookingSerivce\CheckBooking\Util;

/**
 * Providing functions related to Class Invariant.
 */
class Invariant
{

  /**
   * Throw Exception having the given message if the given condition is false
   */
  static function require (bool $condition, string $message) {
    if (!$condition) {
      throw new \Exception($message);
    }
  }

}