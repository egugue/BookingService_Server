<?php

namespace Egugue\BookingSerivce\CheckBooking\Data\Push\Message;

use Egugue\BookingSerivce\CheckBooking\Util\Enum;

/**
 * @see https://firebase.google.com/docs/cloud-messaging/concept-options#setting-the-priority-of-a-message
 */
class Priority extends Enum
{
  const NORMAL = "normal";
  const HIGH = "high";
}