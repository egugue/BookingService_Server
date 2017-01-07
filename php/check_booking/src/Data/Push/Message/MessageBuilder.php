<?php

namespace Egugue\BookingSerivce\CheckBooking\Data\Push\Message;

interface MessageBuilder
{

  function build(): string ;
}