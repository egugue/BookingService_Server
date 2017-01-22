package com.egugue.debooker.domain.teacher

/**
  * Representing a teacher's identifier.
  */
case class TeacherId(value: Long) {
  require(value > 0, "id must be a positive integer")
}
