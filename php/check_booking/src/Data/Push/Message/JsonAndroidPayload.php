<?php

namespace Egugue\BookingSerivce\CheckBooking\Data\Push\Message;

/**
 * WIP
 */
class JsonAndroidPayload
{
  private $content = array();

  public function setTitle(string $title): JsonAndroidPayload
  {
    $this->content["title"] = $title;
    return $this;
  }

  public function setBody(string $body): JsonAndroidPayload
  {
    $this->content["body"] = $body;
    return $this;
  }

  public function get(): array
  {
    return $this->content;
  }
}