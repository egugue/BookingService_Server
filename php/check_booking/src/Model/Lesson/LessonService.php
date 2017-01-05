<?php

namespace Egugue\BookingSerivce\CheckBooking\Model\Lesson;

/**
 * A domain service related to lesson.
 */
class LessonService
{

  /**
   * Extract some lesson which a user can book.
   *
   * @return array a list of an available lesson. if there isn't such a lesson, it is empty.
   */
  function extractNewlyAvailableLessons(LessonList $oldList, LessonList $newList): array
  {
    $oldList = $this->createLessonArray($oldList);
    $newList = $this->createLessonArray($newList);
    $result = array();

    foreach ($oldList as $old) {
      $time = $old->time();
      if (isset($newList[$time])
        && $old->status() != Status::AVAILABLE()
        && $newList[$time]->status() == Status::AVAILABLE()
      ) {
        $result[] = $old;
      }
    }

    foreach ($newList as $new) {
      $time = $new->time();
      if (!isset($oldList[$time]) && $new->status() == Status::AVAILABLE()) {
        $result[] = $new;
      }
    }

    return $result;
  }

  private function createLessonArray(LessonList $list)
  {
    $arr = array();
    foreach ($list as $l) {
      $arr[$l->time()] = $l;
    }
    return $arr;
  }
}