<?php

namespace Egugue\BookingSerivce\CheckBooking\Data\Web;

require_once __DIR__ . "/../../Model/Teacher/TeacherId.php";
require_once __DIR__ . "/../../Model/Lesson/Lesson.php";
require_once __DIR__ . "/../../Model/Lesson/LessonList.php";
require_once __DIR__ . "/../../Model/Lesson/LessonList.php";

use Egugue\BookingSerivce\CheckBooking\Model\Lesson\Lesson;
use Egugue\BookingSerivce\CheckBooking\Model\Lesson\LessonList;
use Egugue\BookingSerivce\CheckBooking\Model\Lesson\Status;
use Egugue\BookingSerivce\CheckBooking\Model\Teacher\TeacherId;
use Egugue\BookingSerivce\CheckBooking\SecretConst;
use Exception;
use simple_html_dom_node;

class LessonPageParser
{

  public function parse(simple_html_dom_node $dom, TeacherId $teacherId): LessonList
  {
    $schedulesList = $dom->find(SecretConst::HTML_TEACHER_PAGE_SCHEDULE_LIST_SELECTOR); //TODO: implement to be able to specify a date.

    $result = array();
    foreach ($schedulesList as $schedules) {

      foreach ($schedules->find('li') as $key => $value) {
        $isDateElement = $key === 0;

        if ($isDateElement) {
          $dateText = $value->plaintext;
          list($month, $day) = $this->convertDateTextIntoMonthAndDay($dateText);
        } else {
          $className = $value->attr["class"];
          list($hour, $minute) = $this->convertClassNameIntoHourAndMinute($className);

          $text = $value->plaintext;
          $text = trim($text);
          $time = mktime($hour, $minute, 0, $month, $day, 2017); // TODO: calclate an appropriate year.
          $status = Status::from($text);

          $result[] = new Lesson($teacherId, $time, $status);
        }
      }
    }

    return LessonList::from($result);
  }

  private function convertDateTextIntoMonthAndDay($dateText)
  {
    $r = preg_match_all("/[0-9]{2}/", $dateText, $matches);
    if ($r === false) {
      throw new Exception("searching targets couldn't do. {$dateText}");
    }
    if ($r !== 2) {
      throw new Exception("searching targets couldn't do. {$dateText}. ${r}");
    }

    $matches = $matches[0];
    return array((int)$matches[0], (int)$matches[1]); // month and day
  }

  private function convertClassNameIntoHourAndMinute($className)
  {
    $list = explode("-", $className);
    if ($list === $className) {
      throw new Exception("className must contain the character, '-'. but was {$className}");
    }
    if (count($list) !== 3) {
      throw new Exception("className must have three of the character, '-'. but was {$className}");
    }
    return array($list[1], $list[2]); // hour and minute
  }
}
