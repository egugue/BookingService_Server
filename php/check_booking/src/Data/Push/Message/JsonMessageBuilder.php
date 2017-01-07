<?php
namespace Egugue\BookingSerivce\CheckBooking\Data\Push\Message;

use Egugue\BookingSerivce\CheckBooking\Util\Invariant;
use Egugue\BookingSerivce\CheckBooking\Util\Precondition;

/**
 * WIP
 *
 * @see https://firebase.google.com/docs/cloud-messaging/http-server-ref
 */
class JsonMessageBuilder
{
  private $contents = array();

  public function registrationIds(string $one, string ...$others): JsonMessageBuilder
  {
    Precondition::requireNotNull($one, "the first arg must not be null.");
    Precondition::require (count($others) > 999, "the number of id must be within 1000. See https://firebase.google.com/docs/cloud-messaging/http-server-ref");

    if ($others == null) {
      $this->contents["registration_ids"] = $one;
    } else {
      $others[] = $one;
      $this->contents["registration_ids"] = $others;
    }

    return $this;
  }

  public function to(string $value): JsonMessageBuilder
  {
    Precondition::requireNotNull($value);
    $this->contents["to"] = $value;
    return $this;
  }

  public function notification(JsonAndroidPayload $notification): JsonMessageBuilder
  {
    $this->contents["notification"] = $notification->get();
    return $this;
  }

  public function priority(Priority $priority): JsonMessageBuilder
  {
    Precondition::requireNotNull($priority);
    $this->contents["priority"] = $priority->__toString();
    return $this;
  }

  public function data(array $map): JsonMessageBuilder {
    $this->contents["data"] = $map;
    return $this;
  }

  public function build(): string
  {
    /*
    Invariant::require (isset($this->contents["registration_ids"],
      "registrationIds must be called before this method is called.");
    */

    return json_encode($this->contents);
  }
}