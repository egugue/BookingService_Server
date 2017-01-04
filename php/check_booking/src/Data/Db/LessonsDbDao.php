<?php

namespace Egugue\BookingSerivce\CheckingService\Data\Db;

use Egugue\BookingSerivce\CheckingService\Model\Lesson\Lesson;
use Egugue\BookingSerivce\CheckingService\Model\Lesson\LessonList;
use Egugue\BookingSerivce\CheckingService\Model\Lesson\Status;
use Egugue\BookingSerivce\CheckingService\Model\Teacher\TeacherId;
use Egugue\BookingSerivce\CheckingService\SecretConst;
use Exception;
use PDO;
use PDOException;

require_once __DIR__ . "/../../SecretConst.php";
require_once __DIR__ . "/../../Model/Lesson/LessonList.php";
require_once __DIR__ . "/../../Model/Lesson/Lesson.php";

/**
 * A Data access object communicating with "lessons" table.
 */
class LessonsDbDao
{
  private $pdo;
  private $table = "lessons";

  public function __construct()
  {
    try {
      $arg = 'mysql:host=' . SecretConst::MYSQL_HOST . ';dbname=' . SecretConst::MYSQL_DATABASE . ';chars=utf8';
      $this->pdo = new PDO(
        $arg,
        SecretConst::MYSQL_USER,
        SecretConst::MYSQL_PASSWORD,
        array(PDO::ATTR_EMULATE_PREPARES => false));
    } catch (PDOException $e) {
      throw new Exception('Could not connect a database. ' . $e->getMessage());
    }
  }

  /**
   * Insert a Lesson of the given list if it don't yet be registered.
   * Update a Lesson of the given list if it was already registered.
   * @param LessonList $lessons
   */
  public function insertOrUpdate(LessonList $lessons)
  {
    if ($lessons->size() == 0) {
      return; // do nothing
    }

    $sql = <<<SQL
INSERT
    INTO
        {$this->table}
        (teacher_id, time, status)
    VALUES
        (:teacher_id, :time, :status)
    ON DUPLICATE KEY UPDATE
        status = VALUES(status)
SQL;
    $statement = $this->pdo->prepare($sql);

    foreach ($lessons as $l) {
      $statement->bindValue(":teacher_id", $l->teacherId()->value());
      $statement->bindValue(":time", date("Y-m-d H:i:s", $l->time()));
      $statement->bindValue(":status", $l->status());
      $statement->execute();
    }
  }

  public function selectByTeacherId(TeacherId $id)
  {
    $rows = $this->pdo->query(
      "SELECT time, status FROM {$this->table} WHERE teacher_id = {$id->value()}"); //TODO: select only from today's Data.

    $list = array();
    foreach ($rows as $row) {
      $list[] = new Lesson(
        $id,
        strtotime($row["time"]),
        new Status($row["status"])
      );
    }

    return new LessonList($list);
  }
}
