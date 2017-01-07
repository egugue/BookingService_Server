<?php

use Egugue\BookingSerivce\CheckBooking\Data\Db\LessonsDbDao;
use Egugue\BookingSerivce\CheckBooking\Data\Firebase\StudentFirebaseDao;
use Egugue\BookingSerivce\CheckBooking\Data\Push\Notification;
use Egugue\BookingSerivce\CheckBooking\Data\Web\LessonPageClient;
use Egugue\BookingSerivce\CheckBooking\Model\Lesson\LessonService;
use Egugue\BookingSerivce\CheckBooking\Model\Student\Student;

class CheckBookingAction
{
  private $dbDao;
  private $client;
  private $lessonService;

  private $studentDao;

  //TODO: Reduce some dependency.
  function __construct(LessonsDbDao $dbDao = null,
                       LessonPageClient $client = null,
                       LessonService $lessonService = null,
                       StudentFirebaseDao $studentDao = null)
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
    if ($studentDao == null) {
      $studentDao = new StudentFirebaseDao();
    }

    $this->lessonService = $lessonService;
    $this->dbDao = $dbDao;
    $this->client = $client;
    $this->studentDao = $studentDao;
  }

  function execute()
  {
    //TODO: Instantiate in the constructor.
    $notification = new Notification();
    $allStudents = $this->studentDao->getAll();

    foreach ($allStudents as $student) {
      $newlyAvailableList = $this->getNewlyAvailableList($student);
      if (count($newlyAvailableList) !== 0) {
        $notification->send($student, $newlyAvailableList);
      }
    }

    //TODO: Insert after sending notification.
    //$this->dbDao->insertOrUpdate($new);
  }

  private function getNewlyAvailableList(Student $student)
  {
    $newlyAvailableList = array();

    foreach ($student->favoriteTeacherIds() as $teacherId) {
      $old = $this->dbDao->selectByTeacherId($teacherId);
      $new = $this->client->getBy($teacherId);
      $newlyAvailable = $this->lessonService->extractNewlyAvailableLessons($old, $new);

      //TODO: Delete it later. Instead of it, we must call this method under the method.
      $this->dbDao->insertOrUpdate($new);

      if (count($newlyAvailable) !== 0) {
        $newlyAvailableList += $newlyAvailable;
      }
    }

    return $newlyAvailableList;
  }
}
