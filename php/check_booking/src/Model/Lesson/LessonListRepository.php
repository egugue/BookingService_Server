<?php

namespace Egugue\BookingSerivce\CheckBooking\Model\Lesson;

use Egugue\BookingSerivce\CheckBooking\Model\Teacher\TeacherId;

class LessonListRepository
{

  public function findBy(TeacherId $id)
  {
    var_dump($id);
  }
}
