package com.egugue.debooker.application.controller.lesson

import javax.inject.{Inject, Singleton}

import com.egugue.debooker.domain.teacher.TeacherId
import play.api.libs.json.Json
import play.api.mvc._
import com.egugue.debooker.infrastructure.mysql.LessonMysqlDao

import scala.concurrent.ExecutionContext.Implicits.global

@Singleton
class LessonController @Inject()(dao: LessonMysqlDao) extends Controller {

  def list(teacherId: Long) = Action.async { implicit request =>
    dao.selectBy(TeacherId(teacherId.toInt)).map( seq => {
      Ok(Json.toJson(LessonJson.asListFrom(seq)))
    })
  }

  /*
  def get(id: Long) = Action { implicit request =>
    val lessonList = Seq(
      Lesson(TeacherId(id.toInt), LocalDateTime.of(2017, Month.APRIL, 11, 10, 10, 10), lesson.Status.Cancelled)
    )
    lessonMysqlDao.insertOrUpdate(lessonList)

    Ok(Json.toJson(TeacherJson(id, "teacher")))
  }
  */
}
