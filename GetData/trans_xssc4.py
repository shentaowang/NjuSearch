#Use it to tarnform the data in jw_text4.0.josn to data and Organize them into key words , word frequency and to his provenance
import sys
import json
import time
import xlrd
import time
import jieba
import jieba.analyse
reload(sys)
sys.setdefaultencoding("utf-8")
jieba.enable_parallel(4)
jieba.analyse.set_idf_path("idf.txt")
#jieba.analyse.set_stop_words("stop_words.txt")
jieba.load_userdict("dict3.0.txt")

file_source="jw_text4.0.xlsx"
error_output="error.txt"#if error is frequency,use it to record it 
result_output="jw_xssc4.0.json"

def get_xlsx(file,result_output,error_output):
	data=xlrd.open_workbook(file)
	table=data.sheets()[0]
	norows=table.nrows
	print norows
	num=0
	for i in range(norows):
		nocloum=table.row_values(i)
		if nocloum[len(nocloum)-1]=="None":
			level_1=nocloum[0]
			level_2="None"
			content=level_1+nocloum[len(nocloum)-2]
			text_cut(level_1,level_2,content,result_output,error_output,num)
		else:
			level_1=nocloum[0]
			level_2=nocloum[1]
			content=level_1+level_2+nocloum[len(nocloum)-1]
			text_cut(level_1,level_2,content,result_output,error_output,num)
		num+=1

def text_cut(level_1,level_2,content,result_output,error_output,num):
	#error_output=open(error,"a")
	if level_2=="None":
		title=level_1
	else:
		title=level_1+level_2
	withWeight=True
	tags=jieba.analyse.extract_tags(content,topK=300,withWeight=True)
	if withWeight is True:
		for tag in tags:
			s=trs(title,tag[0],tag[1],num)
			result_output.write(json.dumps(s,default=lambda obj:obj.__dict__,ensure_ascii=False))
			result_output.write("\n")
	else:
		print (",".join(tags))
	#result_output.close()
class trs(object):
	def __init__(self,title,key,frequency,num):
		self.title=title
		self.key=key
		self.frequency=frequency
		self.num=num

result_output=open(result_output,"w")
get_xlsx(file_source,result_output,error_output)
result_output.close()
