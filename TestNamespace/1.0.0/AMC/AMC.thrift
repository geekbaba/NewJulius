
# File:     AMC.thrift
# Author:   jianghao(jianghao@adyimi.com) 
# Date:     20131014
# Func:     AMC Server
# Annotat:  Set get Function

exception AMCException{
	1:string message; #异常消息
	2:i64 code; #异常代码
}

#自定义
enum CType {
	 TABLE = 1,
	 CACHE = 2,
	 LOGIC = 3,
	 OTHER = 4,
}

enum paramType {
	  STRING = 1,
	  TLIST   = 2,
	  MAP    = 3,
	  MAPLIST= 4,
	  MAPMAP = 5,
}

struct ParamItem{
	1: required string name,
	2: required paramType paramtype,
	3: optional string valString,
	4: optional list<string> valList,
	5: optional map<string,string> valMap,
	6: optional list<map<string,string>> valMaplist,
	7: optional map<string,map<string,string>> valMapMap,
}

struct DataList {
	1:map<string,string> info,
	2:list<ParamItem> value,
}

struct Item {
	1: required string name,
	2: optional string description,
}

struct MultiData{
	1: required string nameSpace,
	2: required CType custom,
	3: optional list<string> field,
	4: optional map<string,map<string,string>> condition,
	5: optional map<string,string> value,
	6: optional list<map<string,string>> values,
}

service AMCService{
	
	list <Item> getNameSpaceList() throws (1:AMCException e),
	
	list <Item> getParamList(1:string nameSpace,2:CType custom) throws (1:AMCException e),
	
	DataList getData(1:string nameSpace,2:CType custom, 3:list<string> field, 4:map<string,map<string,string>> condition) throws (1:AMCException e),
	
	DataList call(1:string nameSpace,2:string functionName, 4:list<ParamItem> params) throws (1:AMCException e),

	DataList setData(1:string nameSpace,2:CType custom,3:map<string,string> value) throws (1:AMCException e),
	
	DataList setList(1:string nameSpace,2:CType custom,3:list<map<string,string>> value) throws (1:AMCException e),
	
	list <DataList> multiJob(1:list<MultiData> multidata) throws (1:AMCException e),
	
}
