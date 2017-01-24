package com.egugue.debooker.domain.lesson

import java.time.LocalDateTime

import com.egugue.debooker.domain.teacher.TeacherId

/**
  * Representing a lesson.
  */
case class Lesson
(
  teacherId: TeacherId,
  time: LocalDateTime,
  status: Status
)
