<?php

use Egugue\BookingSerivce\CheckBooking\Data\Db\LessonsDbDao;
use Egugue\BookingSerivce\CheckBooking\Data\Web\LessonPageClient;
use Egugue\BookingSerivce\CheckBooking\Model\Lesson\LessonService;
use Egugue\BookingSerivce\CheckBooking\Model\Teacher\TeacherId;

class CheckBookingAction
{
  private $dbDao;
  private $client;
  private $lessonService;

  function __construct(LessonsDbDao $dbDao = null, LessonPageClient $client = null,
                       LessonService $lessonService = null)
  {
    if ($dbDao === null) {
      $dbDao = new LessonsDbDao();
    }
    if ($client === null) {
      $client = new LessonPageClient();
    }
    if ($lessonService === null) {
      $lessonService = new LessonService();
    }

    $this->lessonService = $lessonService;
    $this->dbDao = $dbDao;
    $this->client = $client;
  }

  function execute(TeacherId $teacherId)
  {
    $old = $this->dbDao->selectByTeacherId($teacherId);
    $new = $this->client->getBy($teacherId);
    $newlyAvailable = $this->lessonService->extractNewlyAvailableLessons($old, $new);

    $this->dbDao->insertOrUpdate($new);
  }
}
