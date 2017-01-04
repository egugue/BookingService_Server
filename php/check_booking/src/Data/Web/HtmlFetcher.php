<?php

namespace Egugue\BookingSerivce\CheckBooking\Data\Web;

use Egugue\BookingSerivce\CheckBooking\Model\Teacher\TeacherId;
use Egugue\BookingSerivce\CheckBooking\SecretConst;

require_once(dirname(__FILE__) . "/../../php/simple_html_dom.php");

/**
 * A class responsible for fetching a html.
 */
class HtmlFetcher
{

  public function fetchBookingPage(TeacherId $id): \simple_html_dom
  {
    $url = SecretConst::createTeacherUrl($id);
    return file_get_html($url);
  }
}
