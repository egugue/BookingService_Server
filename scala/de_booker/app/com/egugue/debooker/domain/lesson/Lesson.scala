package com.egugue.debooker.domain.lesson

import com.egugue.debooker.domain.teacher.TeacherId

/**
  * Created by htoyama on 2017/01/22.
  */
case class Lesson
(
  teacherId: TeacherId,
  time: Int,
  status: Status
) {
  require(time > 0, "time must be positive integer")
}
