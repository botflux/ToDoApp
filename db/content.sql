/* raw password is 'john' */
insert into t_users values
(1, 'JohnDoe', 'Jone', 'Doe','$2y$13$F9v8pl5u5WMrCorP9MLyJeyIsOLj.0/xqKd/hqa5440kyeB7FQ8te', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER');
/* raw password is 'jane' */
insert into t_users values
(2, 'JaneDoe', 'Jane', 'Doe','$2y$13$qOvvtnceX.TjmiFn4c4vFe.hYlIVXHSPHfInEG21D99QZ6/LM70xa', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER');
INSERT INTO t_users VALUES
(3, 'admin', 'admin', 'admin', '$2y$13$A8MQM2ZNOi99EW.ML7srhOJsCaybSbexAj/0yXrJs4gQ/2BqMMW2K', 'EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN');

insert into t_projects values
(1, 'Dummy project', '2017-11-01 11:11:11', 2);

insert into t_projects values
(2, 'Dummy project 2', '2017-11-18 12:45:15', 2);

insert into t_projects values
(3, 'My first project', '2017-12-27 23:10:25', 1);