var ajaxReq = false, ajaxCallBack;


function ajaxRequest(url) {

	try{
		ajaxReq = new XMLHttpRequest();
	}catch(err){
		try{
			ajaxReq = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(err){
			return false;
		}
	}

	ajaxReq.open("GET",url);
	ajaxReq.onreadystatechange = ajaxResponse;
	ajaxReq.send(null);	
	

}



function ajaxPOST(url,data) {

	try{
		ajaxReq = new XMLHttpRequest();
	}catch(err){
		try{
			ajaxReq = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(err){
			return false;
		}
	}

	ajaxReq.open("POST",url,true);
	ajaxReq.setRequestHeader("Content-type","application/json");
	ajaxReq.onreadystatechange = ajaxResponse;
	ajaxReq.send(data);	
	

}

function ajaxResponse() {
	if (ajaxReq.readyState != 4)
		return;
	if (ajaxReq.status == 200) {
		if(ajaxCallBack)
			ajaxCallBack();
	}else{
		alert("Request Failed: "+ajaxreq.statusText);
	}
	return true;
}