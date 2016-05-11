import pymongo
import sys
reload(sys)
sys.setdefaultencoding("utf-8")
setence=sys.argv[1]
connection=pymongo.MongoClient("mongodb://localhost")
db=connection.njusearch
key=db.xssc_result4
content=db.xssc_content4


def score_limit(list):#if the word's score is too low ,use score_limit to ignore it.
	score_list=[]
	for word in list:
		result=key.find({"_id.key":word}).sort("score",-1).limit(1)
		if result==None:
			list.remove(word)
		else:
			for doc in result:
				score_list.append(doc["score"])
	try:
		return max(score_list)
	except Exception as e:
		print "NOt Found"
		exit()


def find(score_limit,list,title):
	result_list=[]
	num_list=[]
	for word in list:
		cursor=key.find({"_id.key":word,"score":{"$gte":score_limit}})
		if cursor==None:
			list.remove(word)
		else:
			for doc in cursor:
				i=doc["_id"]
				j=doc["title"]
				if i["num"] in num_list:
					pass
				else:	
					num_list.append(i["num"])
					
				if j in title_list:
					pass
				else:
					title_list.append(j)
	for num in num_list:
		cursor=key.aggregate([{"$match":{"_id.num":num,"_id.key":{"$in":list}}},{"$group":{"_id":num,"score":{"$sum":"$score"}}}],cursor={},allowDiskUse=True)
		for doc in cursor:
			result_list.append({"num":doc["_id"],"score":doc["score"]})
	return result_list


def exchange(list,a,b):
	temp_0=list[a]["num"]
	temp_1=list[a]["score"]
	list[a]["num"]=list[b]["num"]
	list[a]["score"]=list[b]["score"]
	list[b]["num"]=temp_0
	list[b]["score"]=temp_1


def partition(list,lo,high):
	j=high
	v=list[lo]["score"]
	i=lo+1
	while True:
		while (v>=list[i]["score"]):
			if i==j:
				break
			i+=1
		while (list[j]["score"]>=v):
			if j==i:
				break
			j-=1
		if i>=j:
			break
		exchange(list,i,j)
	if i==j+1:
		exchange(list,lo,j)
		return j
	elif list[j]["score"]>v:
		exchange(list,lo,j-1)
		return j-1
	else:
		exchange(list,lo,j)
		return j

def insert_sort(list,lo,hi):
	i=lo
	while i<hi:
	 	j=i+1
		while j>lo:
			if list[j]["score"]<list[j-1]["score"]:
				exchange(list,j,j-1)
			j-=1
		i+=1
		
def quick_sort(list,lo,hi):
	if hi<lo+10:
		insert_sort(list,lo,hi)
	else:
		j=partition(list,lo,hi)
		quick_sort(list,lo,j-1)
		quick_sort(list,j+1,hi)

list=setence.split("*")
result_list=[]
title_list=[]
score_limit=1.0*score_limit(list)/5
result_list=find(score_limit,list,title_list)

lo=0
hi=len(result_list)
quick_sort(result_list,lo,hi-1)
#output the result Up to 20
if len(result_list)<20:
	for i in result_list:
		query={"num":i["num"]}
		text=content.find_one(query)
		text_content=text["content"]
		text_title=text["title"]
		print i["num"]+2
		print text_content
		print text_title
else:
	for i in result_list[0:20:1]:
		query={"num":i["num"]}
		text=content.find_one(query)
		text_title=text["title"]
		text_content=text["content"]
		print i["num"]+2
		print text_content
		print text_title
