<?php

namespace Egugue\BookingSerivce\CheckingService\Model\Lesson;

use Egugue\BookingSerivce\CheckingService\Model\Teacher\TeacherId;
use Egugue\BookingSerivce\CheckingService\Util\Precondition;

require_once __DIR__ . "/../Teacher/TeacherId.php";
require_once __DIR__ . "/../../Util/Precondition.php";
require_once __DIR__ . "/Status.php";

/**
 * Representing a Lesson which we want to book.
 */
class Lesson
{
  private $teacherId;
  private $time;
  private $status;

  public function __construct(TeacherId $teacherId, int $time, Status $status)
  {
    Precondition::requireNotNull($teacherId);
    Precondition::require($time > 0, "time must be a positive integer.");
    Precondition::requireNotNull($status);

    $this->teacherId = $teacherId;
    $this->time = $time;
    $this->status = $status;
  }

  public function teacherId()
  {
    return $this->teacherId;
  }

  public function time()
  {
    return $this->time;
  }

  public function status()
  {
    return $this->status;
  }
}
