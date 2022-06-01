import pymysql

def get_block_list(block_name):
    block_list = []
    if len(block_name) == 7:  
        try: #월7화7목34
            day1, day2, day3 = block_name[0], block_name[2], block_name[4]
            block_list.append(str(int(block_name[1]) - 1) + day_dict[day1])
            block_list.append(str(int(block_name[3]) - 1) + day_dict[day2])
            block_list.append(str(int(block_name[5]) - 1) + day_dict[day3])
            block_list.append(str(int(block_name[6]) - 1) + day_dict[day3])
        except: #화12목5금7
            block_list = []
            day1, day2, day3 = block_name[0], block_name[3], block_name[5]
            block_list.append(str(int(block_name[1]) - 1) + day_dict[day1])
            block_list.append(str(int(block_name[2]) - 1) + day_dict[day1])
            block_list.append(str(int(block_name[4]) - 1) + day_dict[day2])
            block_list.append(str(int(block_name[6]) - 1) + day_dict[day3])
    elif len(block_name) == 6: #화56금12
        day1, day2 = block_name[0], block_name[3]
        block_list.append(str(int(block_name[1]) - 1) + day_dict[day1])
        block_list.append(str(int(block_name[2]) - 1) + day_dict[day1])
        block_list.append(str(int(block_name[4]) - 1) + day_dict[day2])
        block_list.append(str(int(block_name[5]) - 1) + day_dict[day2])
    elif len(block_name) == 3: #금12
        day = block_name[0]
        block_list.append(str(int(block_name[1])- 1) + day_dict[day])
        block_list.append(str(int(block_name[2])- 1) + day_dict[day])
        block_list.append(None)
        block_list.append(None)
    
    return block_list
    
    
conn = pymysql.connect(host='localhost', user='root', password='', db='test_schema2', charset='utf8')
cur = conn.cursor()

day_dict = {'월' : '0', '화': '1', '수': '2', '목': '3', '금': '4'}
update_query = "UPDATE brick SET brick1 = %s, brick2 = %s, brick3 = %s, brick4 = %s WHERE brick_name = %s;"
select_query = 'SELECT brick_name FROM brick;'

cur.execute(select_query)
conn.commit()
block_name_list = [i[0] for i in cur.fetchall()]

for block_name in block_name_list:
    block_list = get_block_list(block_name)
    block_list.append(block_name)
    #print(update_query %(block_list[0], block_list[1],block_list[2],block_list[3],block_list[4]))
    cur.execute(update_query, block_list)
    conn.commit()
    


conn.close()

    