name := """de_booker"""
organization := "com.egugue.debooker"

version := "1.0-SNAPSHOT"

lazy val root = (project in file(".")).enablePlugins(PlayScala)

scalaVersion := "2.11.8"

libraryDependencies += filters
libraryDependencies += "org.scalatestplus.play" %% "scalatestplus-play" % "1.5.1" % Test

libraryDependencies ++= Seq(
  "com.typesafe.play" %% "play-slick" % "2.0.0",
  "com.typesafe.play" %% "play-slick-evolutions" % "2.0.0"
)
libraryDependencies += "com.typesafe.slick" %% "slick" % "3.1.1"
libraryDependencies += "mysql" % "mysql-connector-java" % "5.1.34"
libraryDependencies += "org.slf4j" % "slf4j-nop" % "1.6.4"


// Adds additional packages into Twirl
//TwirlKeys.templateImports += "com.egugue.debooker.controllers._"

// Adds additional packages into conf/routes
// play.sbt.routes.RoutesKeys.routesImport += "com.egugue.debooker.binders._"
