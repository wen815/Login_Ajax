function $(id){
	return document.getElementById(id);
}
    $('lgname').focus();
    
    $('lgbtn').onclick=function(){
          var lgname=$('lgname').value;
     var lgpwd=$('lgpwd').value;    

  url='./logchk.php';
  url+="?name="+lgname+"&password="+lgpwd;
xmlHttp.open("get",url,true);
xmlHttp.send();
xmlHttp.onreadystatechange=function(){
    if(xmlHttp.readyState===4&&xmlHttp.status===200){
        var xmlDoc=xmlHttp.responseText;
              if(xmlDoc==='1'){
        //  alert("登录成功");
          location.reload();
        }
        else if(xmlDoc==='0'){
              alert("登录失败");
        }
    }
}  
}
$('outbtn').onclick=function(){
url='./logout.php';
url+="?action=logout";
xmlHttp.open("get",url,true);
xmlHttp.send();
location.reload();
}