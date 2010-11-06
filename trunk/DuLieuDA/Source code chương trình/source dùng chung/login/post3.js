function createObject() {
var request_type;
var browser = navigator.appName;
if(browser == "Microsoft Internet Explorer"){
request_type = new ActiveXObject("Microsoft.XMLHTTP");
}else{
request_type = new XMLHttpRequest();
}
return request_type;
}
var http = createObject();

	var nocache=0;

function post()
{
	document.getElementById('post_response').innerHTML='Dang Load du lieu....';
	var ten = encodeURI(document.getElementById('name').value);
	var nd= encodeURI(document.getElementById('noidung').value);
	nocache=Math.random();
	http.open('POST','post.php?nocache'+nocache);
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;charset=UTF-8;');

	http.onreadystatechange= process
	http.send('name='+ten+'&mess='+nd);

}

function process()
{
	if(http.readyState == 4 && http.status == 200)
	{
		result= http.responseText;
		if(result == '0')
		{
				document.getElementById('post_response').innerHTML= 'Vui long nhap ten va noi dung';
		}
		else
		{
			document.getElementById('post_response').innerHTML= result;
			document.getElementById('divForm').style.display = 'none';

		}
	}
}