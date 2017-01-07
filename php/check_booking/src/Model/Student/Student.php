<?php

namespace Egugue\BookingSerivce\CheckBooking\Model\Student;

use Egugue\BookingSerivce\CheckBooking\Model\Teacher\TeacherId;
use Egugue\BookingSerivce\CheckBooking\Util\Precondition;

/**
 * The class representing a student.
 */
class Student
{
  private $id;
  private $favoriteTeacherIds;
  private $refreshToken;

  function __construct(StudentId $id, string $refreshToken, array $favoriteTeacherIds)
  {
    Precondition::requireNotNull($id, "id must not be null.");
    Precondition::requireNotNull($refreshToken, "refresh token must not be null.");
    foreach ($favoriteTeacherIds as $teacherId) {
      Precondition::require ($teacherId instanceof TeacherId, "favorite teacher id must be instance of TeacherId.");
    }

    $this->id = $id;
    $this->refreshToken = $refreshToken;$this->refreshToken;
    $this->favoriteTeacherIds = $favoriteTeacherIds;
  }

  public function id(): StudentId
  {
    return $this->id;
  }

  /**
   * Return the student's favorite teacherId as list.
   * All items of the list must be TeacherId.
   */
  public function favoriteTeacherIds(): array
  {
    return $this->favoriteTeacherIds;
  }

  public function refreshToken(): string
  {
    return $this->refreshToken;
  }
}