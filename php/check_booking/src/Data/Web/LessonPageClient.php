<?php

namespace Egugue\BookingSerivce\CheckBooking\Data\Web;

use Egugue\BookingSerivce\CheckBooking\Model\Lesson\LessonList;
use Egugue\BookingSerivce\CheckBooking\Model\Teacher\TeacherId;

require_once __DIR__ . "/LessonPageParser.php";
require_once __DIR__ . "/HtmlFetcher.php";

class LessonPageClient
{
  private $parser;
  private $fetcher;

  public function __construct()
  {
    $this->parser = new LessonPageParser();
    $this->fetcher = new HtmlFetcher();
  }

  /**
   * Get a LessonList which is fetched from html.
   */
  public function getBy(TeacherId $id): LessonList
  {
    $dom = $this->fetcher->fetchBookingPage($id);
    return $this->parser->parse($dom, $id);
  }
}