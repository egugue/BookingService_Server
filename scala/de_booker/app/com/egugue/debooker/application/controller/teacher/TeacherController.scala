package com.egugue.debooker.application.controller.teacher

import javax.inject.{Inject, Singleton}

import play.api.libs.json.Json
import play.api.mvc._

@Singleton
class TeacherController @Inject() extends Controller {

  def get(id: Long) = Action { implicit request =>
    Ok(Json.toJson(TeacherJson(id, "teacher")))
  }
}
