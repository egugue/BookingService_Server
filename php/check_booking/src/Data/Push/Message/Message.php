<?php

namespace Egugue\BookingSerivce\CheckBooking\Data\Push\Message;

class Message
{

  public static function asText(): TextMessageBuilder
  {
    return new TextMessageBuilder();
  }

  public static function asJson(): JsonMessageBuilder
  {
    return new JsonMessageBuilder();
  }
}