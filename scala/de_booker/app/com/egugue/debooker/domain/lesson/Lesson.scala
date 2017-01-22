package com.egugue.debooker.domain.lesson

import com.egugue.debooker.domain.teacher.TeacherId

/**
  * Representing a lesson.
  */
case class Lesson
(
  teacherId: TeacherId,
  time: Int,
  status: Status
) {
  require(time > 0, "time must be positive integer")
}
