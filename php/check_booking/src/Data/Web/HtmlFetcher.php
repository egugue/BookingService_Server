<?php

namespace Egugue\BookingSerivce\CheckingService\Data\Web;

use Egugue\BookingSerivce\CheckingService\Model\Teacher\TeacherId;
use Egugue\BookingSerivce\CheckingService\SecretConst;

require_once(dirname(__FILE__) . "/../../php/simple_html_dom.php");

/**
 * A class responsible for fetching a html.
 */
class HtmlFetcher
{

  public function fetchBookingPage(TeacherId $id)
  {
    $url = SecretConst::createTeacherUrl($id);
    return file_get_html($url);
  }
}
