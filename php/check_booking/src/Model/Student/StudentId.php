<?php

namespace Egugue\BookingSerivce\CheckBooking\Model\Student;

/**
 * Representing an identifier of a student.
 */
class StudentId
{
  private $value;

  function __construct(string $value)
  {
    $this->value = $value;
    $this->value;
  }

  function value(): string {
    return $this->value;
  }
}