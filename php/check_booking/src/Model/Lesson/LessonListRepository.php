<?php

namespace Egugue\BookingSerivce\CheckingService\Model\Lesson;

use Egugue\BookingSerivce\CheckingService\Model\Teacher\TeacherId;

class LessonListRepository
{

  public function findBy(TeacherId $id)
  {
    var_dump($id);
  }
}
