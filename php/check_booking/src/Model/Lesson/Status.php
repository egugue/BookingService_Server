<?php

namespace Egugue\BookingSerivce\CheckBooking\Model\Lesson;

use Egugue\BookingSerivce\CheckBooking\Util\Enum;
use InvalidArgumentException;

require_once __DIR__ . "/../../Util/Enum.php";

/**
 * A status a Lesson has.
 */
final class Status extends Enum
{
  /**
   * A status that a lesson has already reserved.
   */
  const RESERVED = "reserved";

  /**
   * A status that booking is available.
   */
  const AVAILABLE = "available";

  /**
   * A status that a Lesson was finished.
   */
  const FINISHED = "finished";

  /**
   * A status that a lesson was cancelled.
   */
  const CANCELLED = "cancelled";

  /**
   * A status that a lesson was not yet assigned.
   */
  const UNASSIGNED = "unassigned";

  public static function from(string $bookingText): Status
  {
    if ($bookingText === "") {
      return self::UNASSIGNED;
    } else if ($bookingText === "予約済") {
      return self::RESERVED;
    } else if ($bookingText === "予約可") {
      return self::AVAILABLE;
    } else if ($bookingText === "終了") {
      return self::FINISHED;
    }

    throw new InvalidArgumentException("Unexpected bookingText: {$bookingText}");
  }
}
