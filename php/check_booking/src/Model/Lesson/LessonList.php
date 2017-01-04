<?php

namespace Egugue\BookingSerivce\CheckBooking\Model\Lesson;

use ArrayIterator;
use Egugue\BookingSerivce\CheckBooking\Util\Precondition;
use Exception;
use IteratorAggregate;

/**
 * Representing a list of Lesson.
 */
class LessonList implements IteratorAggregate
{
  const MAX_DAY_INDEX = 6;
  const NUMBER_OF_LESSONS_PER_DAY = 48; // 2:00 ~ 25:30

  private $list = array();

  public static function from(array $list)
  {
    $expectedListSize = (self::MAX_DAY_INDEX + 1) * self::NUMBER_OF_LESSONS_PER_DAY;
    if (count($list) !== $expectedListSize) {
      throw new Exception("The size of the list must be {$expectedListSize}. but was " . count($list));
    }

    return new LessonList($list);
  }

  public function __construct(array $list)
  {
    foreach ($list as $lesson) {
      if (!($lesson instanceOf Lesson)) {
        throw new Exception("All items of the list must be Lesson instance.");
      }
    }

    usort($list, "LessonList_sortAscByTimestamp");
    $this->list = $list;
  }

  /**
   * Split the list into other LessonList by day index.
   */
  public function splitByDayIndex($index)
  {
    Precondition::require (0 <= $index && $index <= self::MAX_DAY_INDEX,
      "DayIndex must be between 0 and MAX_DAY_INDEX.");

    $offset = $this->calculateOffsetForSlicing($index);
    $res = array_slice($this->list, $offset, self::NUMBER_OF_LESSONS_PER_DAY);

    return new LessonList($res);
  }

  function size()
  {
    return count($this->list);
  }

  function getIterator()
  {
    return new ArrayIterator($this->list);
  }

  private function calculateOffsetForSlicing($dayIndex)
  {
    return self::NUMBER_OF_LESSONS_PER_DAY * $dayIndex;
  }
}

function LessonList_sortAscByTimestamp(Lesson $a, Lesson $b)
{
  return $a->time() - $b->time();
}
