package com.egugue.debooker.domain.lesson

import com.egugue.debooker.domain.teacher.TeacherId
import org.scalatest.{MustMatchers, WordSpec}

class LessonSpec extends WordSpec with MustMatchers {

  "Lesson " should {

    "throw Exception if a given time is not a positive integer" in {
      val invalidTime = 0
      a[IllegalArgumentException] must be thrownBy Lesson(
        TeacherId(1), invalidTime, Status.Reserved)
    }
  }
}
