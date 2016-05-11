#-*-coding:utf8 -*-
#optimization the BM25 algorithm,calculate the score before Inquire
import pymongo
import math

connection=pymongo.MongoClient("mongodb://localhost")
db=connection.njusearch
content=db.xssc_source4
ni=db.xssc_ni4 # Please See Parameter Description of BM25 algorithm
dl=db.xssc_dl4# Please See Parameter Description of BM25 algorithm
output=db.xssc_result4

N=729
avdl=33

def add_score(N,ni,fi,dl,avdl):
	k1=1.2
	b=0.15
	K=k1*((1-b)+1.0*b*dl/avdl)
	score_first=math.log((N/(ni+1.0)),10)
	score_second=(k1+1)/(K+fi)*fi
	score=score_first*score_second*100
	return score

update_list=content.find({})
for i in update_list:
	key=i["key"]
	query={"_id":key}
	ni_url=db.xssc_ni4.find_one(query)
	ni=ni_url["count"]
	title=i["title"]
	num=i["num"]
	#query='''{"title"'''+":"+'''"'''+title+'''"'''+'''"num"'''+":"+str(num)+"}"
	#query={"num":num,"title":title}
	query1={"_id":num}
	dl_url=db.xssc_dl4.find_one(query1)
	dl=dl_url["count"]
	fi=i["frequency"]
	score=add_score(N,ni,fi,dl,avdl)
	doc_id={"num":num,"key":i["key"]}
	output.insert_one({"_id":doc_id,"score":score,"title":title})

