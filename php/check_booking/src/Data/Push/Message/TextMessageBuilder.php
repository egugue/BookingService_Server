<?php

namespace Egugue\BookingSerivce\CheckBooking\Data\Push\Message;

use Egugue\BookingSerivce\CheckBooking\Util\Invariant;
use Egugue\BookingSerivce\CheckBooking\Util\Precondition;

/**
 * @see https://firebase.google.com/docs/cloud-messaging/http-server-ref
 */
class TextMessageBuilder implements MessageBuilder
{
  private $contents = array();

  public function to(string $value): TextMessageBuilder
  {
    Precondition::requireNotNull($value);
    $this->contents["to"] = $value;
    return $this;
  }

  public function priority(Priority $priority): TextMessageBuilder
  {
    Precondition::requireNotNull($priority);
    $this->contents["priority"] = $priority->__toString();
    return $this;
  }

  public function data(array $map): TextMessageBuilder {
    $this->contents["data"] = $map;
    return $this;
  }

  function build(): string
  {
    Invariant::require (isset($this->contents["to"]),
      "to method must be called before this method is called.");

    return json_encode($this->contents);
  }
}