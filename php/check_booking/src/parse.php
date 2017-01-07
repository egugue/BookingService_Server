<?php

use Egugue\BookingSerivce\CheckBooking\Data\Db\LessonsDbDao;
use Egugue\BookingSerivce\CheckBooking\Data\Firebase\StudentFirebaseDao;
use Egugue\BookingSerivce\CheckBooking\Data\Push\Notification;
use Egugue\BookingSerivce\CheckBooking\Data\Web\LessonPageClient;
use Egugue\BookingSerivce\CheckBooking\Model\Lesson\Lesson;
use Egugue\BookingSerivce\CheckBooking\Model\Lesson\LessonList;
use Egugue\BookingSerivce\CheckBooking\Model\Lesson\LessonListRepository;
use Egugue\BookingSerivce\CheckBooking\Model\Lesson\LessonService;
use Egugue\BookingSerivce\CheckBooking\Model\Lesson\Status;
use Egugue\BookingSerivce\CheckBooking\Model\Teacher\TeacherId;

//TODO: Delete the following
require_once("./initialize.php");

$action = new CheckBookingAction();
$action->execute();

/*
$notification = new Notification();
$notification->foo();
*/
/*
$dao = new StudentFirebaseDao();
var_dump($dao->getAll());
*/

/*
TODO
require_once './php/loader/SqlClassLoader.php';

$appLoader = new SplClassLoader('Egugue', __DIR__);
$appLoader->register();
*/


/*
$dao = new LessonsDbDao();
$time = time();
$teacherId = new TeacherId(3);
$lessonList = new LessonList(array(
  new Lesson($teacherId, $time, Status::CANCELLED())
));
$dao->insertOrUpdate($lessonList);
var_dump($dao->selectByTeacherId($teacherId));
*/

/*
$teacherId = new TeacherId(3);
$previous = new LessonList(array(
  new Lesson($teacherId, mktime(2, 30, 0, 1, 4, 2017), Status::AVAILABLE()),
  new Lesson($teacherId, mktime(3, 30, 0, 1, 4, 2017), Status::AVAILABLE()),
  new Lesson($teacherId, mktime(4, 30, 0, 1, 4, 2017), Status::CANCELLED()),
  new Lesson($teacherId, mktime(5, 30, 0, 1, 4, 2017), Status::CANCELLED()),
  new Lesson($teacherId, mktime(6, 30, 0, 1, 4, 2017), Status::CANCELLED())
));

$current = new LessonList(array(
  new Lesson($teacherId, mktime(2, 30, 0, 1, 4, 2017), Status::AVAILABLE()),
  new Lesson($teacherId, mktime(3, 30, 0, 1, 4, 2017), Status::AVAILABLE()),
  new Lesson($teacherId, mktime(4, 30, 0, 1, 4, 2017), Status::CANCELLED()),
  new Lesson($teacherId, mktime(5, 30, 0, 1, 4, 2017), Status::AVAILABLE()),
  new Lesson($teacherId, mktime(6, 30, 0, 1, 4, 2017), Status::CANCELLED()),
  new Lesson($teacherId, mktime(7, 30, 0, 1, 4, 2017), Status::AVAILABLE()),
  new Lesson($teacherId, mktime(8, 30, 0, 1, 4, 2017), Status::AVAILABLE()),
  new Lesson($teacherId, mktime(9, 30, 0, 1, 4, 2017), Status::AVAILABLE()),
  new Lesson($teacherId, mktime(10, 30, 0, 1, 4, 2017), Status::CANCELLED())
));

$se = new LessonService();
$hoge = $se->extractNewlyAvailableLessons($previous, $current);
var_dump($hoge);
*/

/*
$repo = new LessonListRepository();
$id = new TeacherId(2842);
$client = new LessonPageClient();
$lessonList = $client->getBy($id);
var_dump($lessonList->splitByDayIndex(6));
*/

/*
foreach($lessonList as $Lesson) {
    var_dump($Lesson);
}
*/
