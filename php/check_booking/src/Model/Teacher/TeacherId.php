<?php

namespace Egugue\BookingSerivce\CheckBooking\Model\Teacher;

use Egugue\BookingSerivce\CheckBooking\Util\Precondition;

require_once __DIR__ . "/../../Util/Precondition.php";

/**
 * Representing a Teacher's identifier.
 */
class TeacherId
{
  private $id;

  public function __construct(int $id)
  {
    Precondition::require($id > 0, "id must be a positive integer").
    $this->id = $id;
  }

  /**
   * Retrieve the identifier as int type.
   */
  public function value()
  {
    return $this->id;
  }
}
