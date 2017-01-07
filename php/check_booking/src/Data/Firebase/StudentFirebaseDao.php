<?php

namespace Egugue\BookingSerivce\CheckBooking\Data\Firebase;


use Egugue\BookingSerivce\CheckBooking\Model\Student\Student;
use Egugue\BookingSerivce\CheckBooking\Model\Student\StudentId;
use Egugue\BookingSerivce\CheckBooking\Model\Teacher\TeacherId;
use Egugue\BookingSerivce\CheckBooking\SecretConst;
use Firebase\FirebaseLib;

class StudentFirebaseDao
{
  private $client;

  function __construct(FirebaseLib $client = null)
  {
    if ($client == null) {
      $client = new FirebaseLib(SecretConst::FIREBASE_DATABSE_URL, SecretConst::FIREBASE_API_KEY);
    }

    $this->client = $client;
  }

  /**
   * Retrieve all students using this system as list.
   * All items of the list must be Student instance each other.
   */
  function getAll(): array
  {
    var_dump("fadafs");
    $json = $this->client->get("users");
    $students = json_decode($json, true);

    $list = array();
    foreach ($students as $uid => $info) {
      $list[] = new Student(
        new StudentId($uid),
        $info["token"],
        $this->pickStudentIds($info["favorite_teachers"])
      );
    }

    return $list;
  }

  private function pickStudentIds(array $favoriteTeachers): array
  {
    $list = array();
    foreach ($favoriteTeachers as $teacherId) {
      $list[] = new TeacherId($teacherId);
    }
    return $list;
  }

}