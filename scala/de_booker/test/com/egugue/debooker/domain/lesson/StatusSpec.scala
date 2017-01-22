package com.egugue.debooker.domain.lesson

import org.scalatest.{MustMatchers, WordSpec}

class StatusSpec extends WordSpec with MustMatchers {

  "Status of" should {

    "return a status if a given value is appropriate" in {
      Status.of("reserved") mustBe Status.Reserved
      Status.of("finished") mustBe Status.Finished
      Status.of("unassigned") mustBe Status.Unassigned
      Status.of("cancelled") mustBe Status.Cancelled
      Status.of("available") mustBe Status.Available
    }

    "throw Exception if a given value is invalid" in {
      an[IllegalArgumentException] should be thrownBy Status.of("invalid")
    }
  }
}
