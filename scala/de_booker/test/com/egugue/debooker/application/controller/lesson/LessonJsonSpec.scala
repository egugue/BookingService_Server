package com.egugue.debooker.application.controller.lesson

import java.time.{LocalDateTime, Month}

import com.egugue.debooker.domain.lesson.{Lesson, Status}
import com.egugue.debooker.domain.lesson.Status._
import com.egugue.debooker.domain.teacher.TeacherId
import org.scalatest.{MustMatchers, WordSpec}

class LessonJsonSpec extends WordSpec with MustMatchers {

  "LessonJson" should {

    "convert a Lesson into a LessonJson" in {
      val lesson = Lesson(
        TeacherId(1),
        LocalDateTime.of(2017, Month.APRIL, 11, 10, 1, 1),
        Status.Available
      )

      val actual = LessonJson.from(lesson)

      actual.teacherId mustBe 1
      actual.time mustBe "2017-04-11T10:01:01"
      actual.status mustBe 4
    }

    "convert a status into a integer" in {
      Status.values.foreach(status => {
        val integer = LessonJson.statusToInt(status)

        status match {
          case Reserved => integer mustBe 0
          case Finished => integer mustBe 1
          case Unassigned => integer mustBe 2
          case Cancelled => integer mustBe 3
          case Available => integer mustBe 4
        }
      })
    }

    "convert some Lessons as seq into the same number of LessonJson" in {
      val lessons = Seq(
        Lesson(TeacherId(1), LocalDateTime.of(2017, Month.APRIL, 11, 10, 1, 1), Status.Available),
        Lesson(TeacherId(2), LocalDateTime.of(2017, Month.APRIL, 11, 10, 1, 1), Status.Available),
        Lesson(TeacherId(3), LocalDateTime.of(2017, Month.APRIL, 11, 10, 1, 1), Status.Available)
      )

      val actual = LessonJson.asListFrom(lessons)

      actual.size mustBe 3
    }
  }
}
