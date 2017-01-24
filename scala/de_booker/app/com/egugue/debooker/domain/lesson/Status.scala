package com.egugue.debooker.domain.lesson

/**
  * A status that a lesson has
  */
sealed abstract class Status(val value: String)

object Status {

  case object Reserved extends Status("reserved")

  case object Finished extends Status("finished")

  case object Unassigned extends Status("unassigned")

  case object Cancelled extends Status("cancelled")

  case object Available extends Status("available")

  val values:Seq[Status] = Seq(Reserved, Finished, Unassigned, Cancelled, Available)

  /**
    * Retrieve a status of the given value.
    * If none of status has value, throw [[IllegalArgumentException]].
    */
  def of(value: String): Status = Status.values
    .find(status => status.value == value)
    .getOrElse(throw new IllegalArgumentException("Unexpected value: " + value))
}
