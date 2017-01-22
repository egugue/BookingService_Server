package com.egugue.debooker.domain.student

import com.egugue.debooker.domain.teacher.TeacherId

import scala.collection.immutable

/**
  * The class representing a student.
  */
case class Student
(
  id: StudentId,
  refreshToken: String,
  favoriteTeacherIdList: immutable.List[TeacherId]
)
