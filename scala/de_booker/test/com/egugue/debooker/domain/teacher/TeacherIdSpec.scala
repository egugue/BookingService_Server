package com.egugue.debooker.domain.teacher

import org.scalatest.{MustMatchers, WordSpec}

class TeacherIdSpec extends WordSpec with MustMatchers {

  "TeacherId constructor" should {

    "return an instance" in {
      TeacherId(1).value mustBe 1
    }

    "throw exception if value is zero" in {
      a[IllegalArgumentException] must be thrownBy TeacherId(0)
    }

    "throw exception if value is a negative integer" in {
      a[IllegalArgumentException] must be thrownBy TeacherId(-1)
    }
  }
}
