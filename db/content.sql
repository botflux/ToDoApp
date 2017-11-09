/* raw password is 'john' */
insert into t_users values
(1, 'JohnDoe', 'Jone', 'Doe','$2y$13$F9v8pl5u5WMrCorP9MLyJeyIsOLj.0/xqKd/hqa5440kyeB7FQ8te', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER');
/* raw password is 'jane' */
insert into t_users values
(2, 'JaneDoe', 'Jane', 'Doe','$2y$13$qOvvtnceX.TjmiFn4c4vFe.hYlIVXHSPHfInEG21D99QZ6/LM70xa', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER');
INSERT INTO t_users VALUES
(3, 'admin', 'admin', 'admin', '$2y$13$A8MQM2ZNOi99EW.ML7srhOJsCaybSbexAj/0yXrJs4gQ/2BqMMW2K', 'EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN');

insert into t_tasks VALUES
(1, 'Finir la fonctionnalité 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies metus et massa lacinia aliquet. Donec ultricies malesuada est et auctor. Aliquam sed felis sollicitudin, mollis mi vitae, tincidunt sapien. Donec nibh mi, aliquet posuere quam in, suscipit tempus justo. Pellentesque sed risus orci. Pellentesque bibendum sem in est tincidunt, vitae accumsan nunc commodo. Aliquam pellentesque, mi vel tincidunt gravida, enim ipsum varius purus, in posuere lectus leo at cras amet.', '2017-09-10 05:45:09', '2017-11-17 12:00:00',2);

insert into t_tasks VALUES
(2, 'Finir la fonctionnalité 7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies metus et massa lacinia aliquet. Donec ultricies malesuada est et auctor. Aliquam sed felis sollicitudin, mollis mi vitae, tincidunt sapien. Donec nibh mi, aliquet posuere quam in, suscipit tempus justo. Pellentesque sed risus orci. Pellentesque bibendum sem in est tincidunt, vitae accumsan nunc commodo. Aliquam pellentesque, mi vel tincidunt gravida, enim ipsum varius purus, in posuere lectus leo at cras amet.', '2017-11-15 12:17:59', '2017-12-15 12:00:00',1);

insert into t_tasks VALUES
(3, 'Finir la fonctionnalité 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultricies metus et massa lacinia aliquet. Donec ultricies malesuada est et auctor. Aliquam sed felis sollicitudin, mollis mi vitae, tincidunt sapien. Donec nibh mi, aliquet posuere quam in, suscipit tempus justo. Pellentesque sed risus orci. Pellentesque bibendum sem in est tincidunt, vitae accumsan nunc commodo. Aliquam pellentesque, mi vel tincidunt gravida, enim ipsum varius purus, in posuere lectus leo at cras amet.', '2017-05-30 18:32:10', '2017-12-01 08:00:00',3);