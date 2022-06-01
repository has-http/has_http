import csv

import pymysql
conn = pymysql.connect(host='localhost', user='root', password='', db='test_schema2', charset='utf8')
cur = conn.cursor()

f = open('DATABASE/user_teach.CSV', 'r', encoding='cp949')
rdr = csv.reader(f)
course_insert_query = 'INSERT INTO course VALUES (%s, %s, %s);'
teach_insert_query = 'INSERT INTO teach VALUES (%s, %s, %s, %s, %s, %s);'

course_rows = []
teach_rows = []

for i, line in enumerate(rdr):
    c_name, t_time_list, c_count = line
    c_no = str(3001 + i)
    course_rows.append((c_no, c_name, c_count))
    for j, s in enumerate(t_time_list.split()):
        teach_rows.append((str(c_count) + s + '3', str(j+1), '30', c_no, c_name, c_count))



cur.executemany(course_insert_query, course_rows)
conn.commit()
cur.executemany(teach_insert_query, teach_rows)
conn.commit()
conn.close()

    