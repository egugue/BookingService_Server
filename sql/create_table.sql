create table lessons (
`teacher_id` integer not null,
`time` datetime not null,
`status` enum('reserved', 'available', 'finished', 'cancelled', 'unassigned') not null,
primary key (`teacher_id`, `time`)
) ENGINE=INNODB;
