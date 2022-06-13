UPDATE teach SET t_now = (SELECT count(s_id) FROM enroll WHERE enroll.c_no = teach.c_no AND enroll.t_no = teach.t_no);
UPDATE teach SET t_dem = (SELECT count(s_id) FROM demand WHERE demand.c_no = teach.c_no AND demand.t_no = teach.t_no);
                    