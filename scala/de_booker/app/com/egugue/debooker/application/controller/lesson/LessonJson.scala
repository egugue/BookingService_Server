package com.egugue.debooker.application.controller.lesson

import java.time.format.DateTimeFormatter

import com.egugue.debooker.domain.lesson.Status._
import com.egugue.debooker.domain.lesson.{Lesson, Status}
import play.api.libs.json._

/**
  * A class representing a lesson as JSON.
  */
case class LessonJson
(
  teacherId: Long,
  time: String,
  status: Int
)

object LessonJson {

  implicit def jsonWrite: Writes[LessonJson] = Json.writes[LessonJson]

  implicit def jsonRead: Reads[LessonJson] = Json.reads[LessonJson]

  /**
    * Convert a [[Lesson]] into a [[LessonJson]].
    */
  def from(l: Lesson): LessonJson = {
    l.time.format(DateTimeFormatter.BASIC_ISO_DATE)
    LessonJson(
      l.teacherId.value,
      l.time.format(DateTimeFormatter.ISO_DATE_TIME),
      statusToInt(l.status)
    )
  }

  /**
    * Convert [[Lesson]]s of seq into [[LessonJson]]s of seq.
    */
  def asListFrom(list: Seq[Lesson]): Seq[LessonJson] = {
    list.map(LessonJson.from)
  }

  private[lesson] def statusToInt(status: Status): Int = {
    status match {
      case Reserved => 0
      case Finished => 1
      case Unassigned => 2
      case Cancelled => 3
      case Available => 4
    }
  }

}
