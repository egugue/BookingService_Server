package com.egugue.debooker.application.controller.teacher

import play.api.libs.json._

case class TeacherJson
(
  id: Long,
  name: String
)

object TeacherJson {
  implicit def jsonWrite: Writes[TeacherJson] = Json.writes[TeacherJson]

  implicit def jsonRead: Reads[TeacherJson] = Json.reads[TeacherJson]
}
