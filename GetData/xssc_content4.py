#Get the content of the text ,Use headings and the structure of the content is stored
import sys
import json
import time
import xlrd
import time
import jieba
import jieba.analyse
reload(sys)
sys.setdefaultencoding("utf-8")

file_source="jw_text4.0.xlsx"
error_output="error.txt"#if error is frequency,use it to record it 
result_output="jw_content.4.json"

def get_xlsx(file,result_output,error_output):
	data=xlrd.open_workbook(file)
	table=data.sheets()[0]
	norows=table.nrows
	print norows
	num=0
	for i in range(norows):
		nocloum=table.row_values(i)
		if len(nocloum[len(nocloum)-1])<2:
			level_1=nocloum[0]
			level_2="None"
			content=nocloum[len(nocloum)-2]
			title=level_1
		else:
			level_1=nocloum[0]
			level_2=nocloum[1]
			content=nocloum[len(nocloum)-1]
			title=level_1+level_2
		s=trs(title,num,content)
		result_output.write(json.dumps(s,default=lambda obj:obj.__dict__,ensure_ascii=False))
		result_output.write("\n")
		num=num+1
class trs(object):
	def __init__(self,title,num,content):
		self.title=title
		self.num=num
		self.content=content

result_output=open(result_output,"w")
get_xlsx(file_source,result_output,error_output)
result_output.close()
