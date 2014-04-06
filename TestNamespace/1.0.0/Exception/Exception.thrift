
# File:     Exception.thrift
# Author:   jianghao(jianghao@adyimi.com) 
# Date:     20131014
# Func:     Exception 
# Annotat:  Set get Function

exception AMCException{
	1:string message; #异常消息
	2:i64 code; #异常代码
}