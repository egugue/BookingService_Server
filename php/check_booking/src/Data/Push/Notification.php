<?php

namespace Egugue\BookingSerivce\CheckBooking\Data\Push;

use Egugue\BookingSerivce\CheckBooking\Data\Push\Message\Message;
use Egugue\BookingSerivce\CheckBooking\Data\Push\Message\Priority;
use Egugue\BookingSerivce\CheckBooking\Model\Student\Student;
use Egugue\BookingSerivce\CheckBooking\SecretConst;
use Firebase\FirebaseLib;

class Notification
{
  private $firebase;
  const BASE_PATH = "/" . SecretConst::FIREBASE_DATABSE_BASE_PATH . "/";

  function __construct(FirebaseLib $firebase = null)
  {
    if ($firebase == null) {
      $firebase = new FirebaseLib(SecretConst::FIREBASE_DATABSE_URL, SecretConst::FIREBASE_API_KEY);
    }

    $this->firebase = $firebase;
  }

  public function send(Student $student, $newlyAvailableList)
  {
    $teacherIdList = array();
    foreach ($newlyAvailableList as $lesson) {
      $id = $lesson->teacherId()->value();
      $teacherIdList[$id] = $id;
    }
    $text = "available teachers are " . implode(", ", $teacherIdList);

    $json = Message::asText()
      ->to($student->refreshToken())
      ->priority(Priority::HIGH())
      ->data(array(
        "title" => "You can book your favorite teacher's class now.",
        "text" => $text))
      ->build();

    $this->postNotificatoin($json);
  }

  //TODO: Extract it into other class.
  private function postNotificatoin($json)
  {
    $headers = array(
      "Content-Type: application/json",
      "Authorization: key=" . SecretConst::FIREBASE_SERVER_KEY,
    );

    $url = "https://fcm.googleapis.com/fcm/send";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    curl_close($ch); //終了

    return $result;
  }
}