<?php
//TODO: Use ClassLoader instead of it if possible.

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('./Util/Precondition.php');
require_once('./Util/Enum.php');
require_once('./Util/Invariant.php');

require_once('./Data/Web/LessonPageClient.php');
require_once('./Data/Db/LessonsDbDao.php');

require_once('./Data/Push/Notification.php');
require_once('./Data/Push/Message/Message.php');
require_once('./Data/Push/Message/Priority.php');
require_once('./Data/Push/Message/MessageBuilder.php');
require_once('./Data/Push/Message/JsonAndroidPayload.php');
require_once('./Data/Push/Message/JsonMessageBuilder.php');
require_once('./Data/Push/Message/TextMessageBuilder.php');

require_once('./Data/Firebase/StudentFirebaseDao.php');

require_once('./Model/Teacher/TeacherId.php');
require_once('./Model/Lesson/Lesson.php');
require_once('./Model/Lesson/LessonList.php');
require_once('./Model/Lesson/LessonListRepository.php');
require_once('./Model/Lesson/LessonService.php');
require_once('./Model/Student/Student.php');
require_once('./Model/Student/StudentId.php');

require_once('./App/CheckBookingAction.php');

require_once('../vendor/ktamas77/firebase-php/src/firebaseLib.php');
