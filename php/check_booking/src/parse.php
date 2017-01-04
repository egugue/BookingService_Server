<?php

use Egugue\BookingSerivce\CheckingService\Data\Db\LessonsDbDao;
use Egugue\BookingSerivce\CheckingService\Model\Lesson\Lesson;
use Egugue\BookingSerivce\CheckingService\Model\Lesson\LessonList;
use Egugue\BookingSerivce\CheckingService\Model\Lesson\Status;
use Egugue\BookingSerivce\CheckingService\Model\Teacher\TeacherId;

//TODO: Delete the following
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('./Data/Web/LessonPageClient.php');
require_once('./Data/Db/LessonsDbDao.php');

require_once('./Model/Teacher/TeacherId.php');
require_once('./Model/Lesson/Lesson.php');
require_once('./Model/Lesson/LessonList.php');
require_once('./Model/Lesson/LessonListRepository.php');

/*
TODO
require_once './php/loader/SqlClassLoader.php';

$appLoader = new SplClassLoader('Egugue', __DIR__);
$appLoader->register();
*/


$dao = new LessonsDbDao();
$time = time();
$teacherId = new TeacherId(3);
$lessonList = new LessonList(array(
  new Lesson($teacherId, $time, Status::CANCELLED())
));
$dao->insertOrUpdate($lessonList);
var_dump($dao->selectByTeacherId($teacherId));

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
exit;
