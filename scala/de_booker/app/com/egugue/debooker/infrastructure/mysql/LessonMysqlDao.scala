package com.egugue.debooker.infrastructure.mysql

import java.sql.Timestamp
import java.time.LocalDateTime
import javax.inject.Inject

import com.egugue.debooker.domain.lesson.{Lesson, Status}
import com.egugue.debooker.domain.teacher.TeacherId
import play.api.db.slick.{DatabaseConfigProvider, HasDatabaseConfigProvider}
import slick.driver.JdbcProfile
import slick.lifted.ProvenShape

import scala.concurrent.Future
import scala.concurrent.ExecutionContext.Implicits.global

/**
  * A data access object communicating with "lessons" table.
  */
class LessonMysqlDao @Inject()(protected val dbConfigProvider: DatabaseConfigProvider)
  extends HasDatabaseConfigProvider[JdbcProfile] {

  import driver.api._

  private val lessons = TableQuery[LessonTable]

  implicit val teacherIdMapper: BaseColumnType[TeacherId] = MappedColumnType.base[TeacherId, Long](
    _.value,
    TeacherId)

  implicit val statusMapper: BaseColumnType[Status] = MappedColumnType.base[Status, String](
    _.value,
    Status.of)

  implicit val javaDateMapper: BaseColumnType[LocalDateTime] = MappedColumnType.base[LocalDateTime, Timestamp](
    Timestamp.valueOf,
    _.toLocalDateTime)

  /**
    * Retrieve some lesson as seq. It has the given [[TeacherId]].
    */
  def selectBy(teacherId: TeacherId): Future[Seq[Lesson]] = {
    db.run(lessons
      .filter(_.teacherId === teacherId)
      .sortBy(_.time.asc)
      .result)
  }

  /**
    * Insert a lesson of the given list if the lesson don't yet be inserted.
    * Or, update the lesson if it has already inserted.
    */
  def insertOrUpdate(lessonList: Seq[Lesson]): Unit = {
    lessonList.foreach(lesson => {
      db.run(lessons.insertOrUpdate(lesson))
    })

    /* TODO: use bulk insert instead of the following.

    val SQL = """
INSERT INTO lessons
  (teacher_id, time, status)
VALUES
  (?, ?, ?)
ON DUPLICATE KEY UPDATE
  status = VALUES(status);
"""
    db.run(SimpleDBIO[Array[Int]] { session =>
      val statement = session.connection.prepareStatement(SQL)

      lessonList.foreach { lesson =>
        statement.setObject(1, lesson.teacherId)
        statement.setObject(2, lesson.time)
        statement.setObject(3, lesson.status)
        statement.addBatch()
      }

      statement.executeBatch()
    })
    */
  }

  private class LessonTable(tag: Tag) extends Table[Lesson](tag, "lessons") {
    def teacherId: Rep[TeacherId] = column[TeacherId]("teacher_id", O.PrimaryKey)

    def time: Rep[LocalDateTime] = column[LocalDateTime]("time", O.PrimaryKey)

    def status: Rep[Status] = column[Status]("status")

    override def * : ProvenShape[Lesson] = (teacherId, time, status) <> ((Lesson.apply _).tupled, Lesson.unapply)
  }

}