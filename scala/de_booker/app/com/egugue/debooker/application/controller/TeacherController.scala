package com.egugue.debooker.application.controller

import javax.inject.{Inject, Singleton}

import play.api.mvc._
import play.libs.Json

/**
  * Created by htoyama on 2017/01/18.
  */
@Singleton
class TeacherController @Inject() extends Controller {

  def get(id: Long) = Action { implicit request =>
    val list = Map("id" -> id)
    val added = Json.newArray().add(id)
    Ok(added.toString)
  }
}
