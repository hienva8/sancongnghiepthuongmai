function MM_openBrWindow(theURL,winName,features)
{ //v2.0
	window.open(theURL,winName,features);
}
function SearchX()
{
	var form = document.f;
	var keyword = document.getElementById('keyword').value;
	//alert(keyword);
	if(keyword.length < 1)
	{
		alert('Please input a keyword.');
		form.keyword.focus(); return false;
	}
	else
	{
		keyword = trim_keyword(keyword);
		if ( keyword.length <1 )
		{
			alert('Pleas input a keyword.');
			form.keyword.focus(); return false;
		}
	}
	//if(!keywordCodeCheck(keyword)) return false;
	//keyword = KeyEncoding(keyword);
	if(form.st.value =='0')
	{
		location.href = '/ec-market/' + keyword + '.html';return false;
	}
	else if(form.st.value =='2')
	{
		location.href = 'http://importer.ec21.com/buy_leads/' + keyword + '.html';return false;
	}
	else if(form.st.value =='1')
	{
	location.href = '/offers/' + keyword + '.html';return false;
	}
	else if(form.st.value =='3')
	{
		location.href = '/companies/' + keyword + '.html';return false;
	}
}
function keywordCodeCheck(keyword){
	/*
	if(check(keyword)){
		alert('Sorry, the information you filled in is not in English. Please input the information in English instead.');
		return false;
	}
	else
	{
		return true;
	}*/
			return true;

}

function bookmarks(){window.external.AddFavorite('http://www.ec21.com', 'EC21-Global B2B Marketplace')}

function changeSearchType(sType)
{
	//select box
	var form = document.searchForm;                
	var typeSel = document.getElementById('IndexAreaOptionIdx');
	switch(sType){
		case("product"):{
			typeSel.value="0"; break;}
		case("sell"):{
			typeSel.value="1"; break;}
		case("buy"):{
			typeSel.value="2"; break;}
		case("company"):{
			typeSel.value="3"; break;}
	}

	//boxing - reset
	var searchTabProduct = document.getElementById("searchTabProduct");
	var searchTabSell = document.getElementById("searchTabSell");
	var searchTabBuy = document.getElementById("searchTabBuy");
	var searchTabCompany = document.getElementById("searchTabCompany");

	searchTabProduct.className = "";
	searchTabSell.className = "";
	searchTabBuy.className = "";
	searchTabCompany.className = "";

	switch(sType){
		case("product"):{ searchTabProduct.className = "current"; break; }
		case("sell"):{ searchTabSell.className = "current"; break; }
		case("buy"):{ searchTabBuy.className = "current"; break; }
		case("company"):{ searchTabCompany.className = "current"; break; }
	}

	var searchBtn = document.getElementById("searchBtn");
	var keyword = document.getElementById("keyword");

	switch(sType)
	{
		case("product"):{
			 searchBtn.style.backgroundColor  = "#f77b23"; 
			 searchBtn.style.width = "130px"; 
			 searchBtn.style.fontSize = "1em"; 
			 searchBtn.value = "Search Products";     break; }
		case("sell"):{
			 searchBtn.style.backgroundColor  = "#f77b23";
			 searchBtn.style.width = "160px";
			 searchBtn.style.fontSize = "1em";
			 searchBtn.value = "Search Selling Leads"; break;}
		case("buy"):{
			 searchBtn.style.backgroundColor  = "#f77b23"; 
			 searchBtn.style.width = "160px"; 
			 searchBtn.style.fontSize = "1em";
			 searchBtn.value = "Search Buying Leads";  break;}
		case("company"):{
			 searchBtn.style.backgroundColor  = "#f77b23"; 
			 searchBtn.style.width = "145px"; 
			 searchBtn.style.fontSize = "1em";
			 searchBtn.value = "Search Companies";     break;}
	}
}

function SearchChkX(obj){ return; }
function show_Banner(num, seed, bannerName) // Random Banner
{
	for(i=0;i<seed;i++)
	{
	  if(num==i){
		   //Rand_Banner[i].style.dispaly="";
			   form = document.getElementById(bannerName + (i+1) );
			   form.style.dispaly="";
		  } else {
				//Rand_Banner[i].style.display="none";
			   form = document.getElementById(bannerName + (i+1) );
			   form.style.display="none";
		  }
	 }
}
function replaceText ( OrgStr, Target, Change )
{
	var index, len=0; var fullStr = '';
	while ( (index=OrgStr.indexOf(Target)) >= 0)
	{
		fullStr = fullStr + ''+ OrgStr.substring(0,index) + ''+Change ;
		OrgStr = OrgStr.substring(index+Target.length);
	}
	return fullStr+''+OrgStr;
}
function offerTitleRepace(buf)
{
	buf = replaceText(buf, "%", "%25");
	buf = replaceText(buf, "&", "%26");
	buf = replaceText(buf, "'", "%27");
	buf = replaceText(buf, "\"", "%22");
	buf = replaceText(buf, "/", "%252F");
	buf = replaceText(buf, '`', '_');
	buf = replaceText(buf, '~', '_');
	buf = replaceText(buf, '!', '_');
	buf = replaceText(buf, '@', '_');
	buf = replaceText(buf, '^', '_');
	buf = replaceText(buf, '*', '_');
	buf = replaceText(buf, '(', '_');
	buf = replaceText(buf, ')', '_');
	buf = replaceText(buf, '=', '_');
	buf = replaceText(buf, '+', '_');
	buf = replaceText(buf, ' ', '_');
	buf = replaceText(buf, '|', '_');
	buf = replaceText(buf, '[', '_');
	buf = replaceText(buf, ']', '_');
	buf = replaceText(buf, '{', '_');
	buf = replaceText(buf, '}', '_');
	buf = replaceText(buf, ';', '_');
	buf = replaceText(buf, ':', '_');
	buf = replaceText(buf, ',', '_');
	buf = replaceText(buf, '.', '_');
	buf = replaceText(buf, '<', '_');
	buf = replaceText(buf, '>', '_');
	buf = replaceText(buf, '?', '_');
	buf = replaceText(buf, '\t','_');
	buf = replaceText(buf, '__','_');
	buf = replaceText(buf, '__','_');
	return buf;
}

//YUI Widget 
function displayOfferList()
{
	YAHOO.namespace("EC");
	YAHOO.namespace("EC.widget");
	EC=YAHOO.EC;$D=YAHOO.util.Dom;
	$E=YAHOO.util.Event;
	$U=YAHOO.util;EC.widget.SimpleScroll=new function(){var $Y=YAHOO.util;var defConfig={delay:2,speed:20,startDelay:2,scrollItemCount:1};this.decorate=function(aa,ba){aa=YAHOO.util.Dom.get(aa);ba=EC.applyIf(ba||{},defConfig);var ca={};var da=null,pause=false;var ea=new $U.CustomEvent("onScroll",ca,false,$U.CustomEvent.FLAT);if(ba.onScroll){ea.subscribe(ba.onScroll);}
	else{ea.subscribe(function(){for(var i=0;i<ba.scrollItemCount;i++){aa.appendChild(aa.getElementsByTagName("li")[0]);}});}
	var fa=function(){if(pause){return;}
	aa.scrollTop+=2;var lh=ba.lineHeight||aa.getElementsByTagName("li")[0].offsetHeight;if(aa.scrollTop%lh<=1){clearInterval(da);ea.fire();aa.scrollTop=0;setTimeout(ga,ba.delay*1000);}};var ga=function(){var lh=ba.lineHeight||aa.getElementsByTagName("li")[0].offsetHeight;if(aa.scrollHeight-aa.offsetHeight>=lh){da=setInterval(fa,ba.speed);}};$E.on(aa,"mouseover",function(){pause=true;});$E.on(aa,"mouseout",function(){pause=false;});setTimeout(ga,ba.startDelay*1000);ca.onScroll=ca.subscribeOnScroll;return ca;};}
	EC.applyIf=function(ha,ia){if(ha&&ia&&typeof ia=='object'){for(var p in ia){if(!YAHOO.lang.hasOwnProperty(ha,p))ha[p]=ia[p];}}
	return ha;}
}

var imgPointer = 0; //실제로 가르킴
function prevProductList()
{
	imgPointer--;
	if (imgPointer<0)
	{
		imgPointer = 20;
	}
	showProductList(imgPointer);
	//alert(imgPointer);
}

function nextProductList()
{
	imgPointer++;
	if (imgPointer>20)
	{
		imgPointer = 0;
	}
	showProductList(imgPointer);
	//alert(imgPointer);
}

function showProductList(imgPointer)
{
	var imgCount=1; //출력한갯수

	while(1)
	{
		document.getElementById('newProductList'+imgCount).src = productList[imgPointer].imgSrc;
		document.getElementById('newProductList'+imgCount+"Anchor1").href = productList[imgPointer].anchor;
		document.getElementById('newProductList'+imgCount+"Anchor2").href = productList[imgPointer].anchor;

		// remove all children from element
		var element = document.getElementById('newProductList'+imgCount+"Text");
		while (element.firstChild) {
			element.removeChild(element.firstChild);
		}
		
		var catalogNm = productList[imgPointer].catalogNm;
		if (catalogNm.length > 30)
		{
			catalogNm= catalogNm.substr(0,30) + "...";
		}
		/*
		if (catalogNm.indexOf(" ")==-1)
		{
			catalogNm = catalogNm.substr(0, 15) + " " + catalogNm.substr(15);
		}*/
		document.getElementById('newProductList'+imgCount+"Text").appendChild(document.createTextNode(catalogNm));

		//document.getElementById('newProductList'+imgCount+"Text").appendChild(productList[imgPointer].cata;

		imgCount++;
		imgPointer++;

		//5개 채우면 정지
		if (imgCount>5)
		{
			break;
		}

		//21번 포인터 일경우 0번으로 돌림
		if (imgPointer==21)
		{
			imgPointer=0;
		}
	}
	setTimeout("nextProductList()",5000);

}

function changeFeatured(target)
{
	//alert(target);
	var switch1Img = document.getElementById('featuredSwitch1');
	var switch2Img = document.getElementById('featuredSwitch2');
	var switch3Img = document.getElementById('featuredSwitch3');
	var div1 = document.getElementById('featured_1');
	var div2 = document.getElementById('featured_2');
	var div3 = document.getElementById('featured_3');

	if (target==1)
	{
		switch1Img.src = "http://image.ec21.com/img/ec/main/num01_on.gif";
		switch2Img.src = "http://image.ec21.com/img/ec/main/num02_off.gif";
		switch3Img.src = "http://image.ec21.com/img/ec/main/num03_off.gif";
		div1.style.display = "block";
		div2.style.display = "none";
		div3.style.display = "none";
	}
	else if (target==2)
	{
		switch1Img.src = "http://image.ec21.com/img/ec/main/num01_off.gif";
		switch2Img.src = "http://image.ec21.com/img/ec/main/num02_on.gif";
		switch3Img.src = "http://image.ec21.com/img/ec/main/num03_off.gif";
		div1.style.display = "none";
		div2.style.display = "block";
		div3.style.display = "none";
	}
	
	else if (target==3)
	{
		switch1Img.src = "http://image.ec21.com/img/ec/main/num01_off.gif";
		switch2Img.src = "http://image.ec21.com/img/ec/main/num02_off.gif";
		switch3Img.src = "http://image.ec21.com/img/ec/main/num03_on.gif";
		div1.style.display = "none";
		div2.style.display = "none";
		div3.style.display = "block";
	}
	
}

function changeStatusFeaturedAutoSwitcher(status)
{
	var isAuto = document.getElementById('featuredAuto');

	isAuto.value = status;

}

function changeFeaturedAutoSwitcher()
{
	var isAuto = document.getElementById('featuredAuto');
	//alert("stop"+isAuto.value);

	if (isAuto.value=="start")
	{
		var div1 = document.getElementById('featured_1');
		var div2 = document.getElementById('featured_2');
		var div3 = document.getElementById('featured_3');

		if (div1.style.display == "block")
		{
			target = 2;
		}
		
		else if (div2.style.display == "block")
		{
			target = 3;
		}
		
		else
		{
			target = 1;
		}
		changeFeatured(target);
	}

	setTimeout("changeFeaturedAutoSwitcher()",3500);
}

function FlashControl(FlashSrc, FlashWidth, FlashHeight, FlashVars)
{
    var strFlash;
    strFlash = "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width='" + FlashWidth + "' height='" + FlashHeight + "'>";
    strFlash += " <param name='movie' value='" + FlashSrc + "'>";
    strFlash += " <param name='FlashVars' value='" + FlashVars + "'>";
    strFlash += " <param name='quality' value='high'>";
    strFlash += " <embed src='" + FlashSrc + "' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='" + FlashWidth + "' height='" + FlashHeight + "'></embed>";
    strFlash += "</object>";
    document.write(strFlash);
	document.write('<PARAM NAME="AllowScriptAccess" VALUE="always">'); 
}

function displayLoginBox()
{
	var logOn = document.getElementById('login');
	var logOff = document.getElementById('welcome');
	
	var serviceLogOn = document.getElementById('howToLogin');
	var serviceLogOff = document.getElementById('howToNoLogin');

	if (getCookie("user") != null && getCookie("user") != "")
	{
		logOn.style.display = "block";
		logOff.style.display = "none";

		//remove all
		var element = $('loginUserGrade');
		while (element.firstChild) {
		  element.removeChild(element.firstChild);
		}

		var ec21User = getCookie("ec21_user");
		
	  if (ec21User.length > 14) {
			ec21User =ec21User.substr(0,14)+"...";
	  }
		
		$('loginUserId').appendChild(document.createTextNode(ec21User));

		var feeGb = getCookie("fee_gb");
		$('loginUserGrade').src = "http://image.ec21.com/img/ec/main/member_type_"+feeGb+".gif";
		//$('loginUserId')	fee_gb

		var ec21HomeUrl = getCookie("user_url");
		$('loginUserHomeUrl').href = "http://"+ec21HomeUrl+".en.ec21.com/";

		if (feeGb=="90")
		{
			$('loginUserGradeHref').href = "http://www.ec21.com/html/ec/AW/PS_preview.html";
		}

		serviceLogOn.style.display = "block";
		serviceLogOff.style.display = "none";
	}
	else
	{
		logOn.style.display = "none";
		logOff.style.display = "block";

		serviceLogOn.style.display = "none";
		serviceLogOff.style.display = "block";
	}
}

function changeStatusCoolProductAutoSwitcher(status)
{
	var isAuto = document.getElementById('coolProductAuto');

	isAuto.value = status;

}

function changeCoolProductAutoSwitcher()
{
	var isAuto = document.getElementById('coolProductAuto');
	//alert("stop"+isAuto.value);

	if (isAuto.value=="start")
	{
		var div1 = document.getElementById('cool_1');
		var div2 = document.getElementById('cool_2');
		//var div3 = document.getElementById('cool_3');

		if (div1.style.display == "block")
		{
			target = 2;
		}
		/*else if (div2.style.display == "block")
		{
			target = 3;
		}
		else
		{
			target = 1;
		}*/
		changeCoolProduct(target);
	}

	setTimeout("changeCoolProductAutoSwitcher()",3500);
}

function changeCoolProduct(target)
{
	//alert(target);
	var switch1Img = document.getElementById('coolSwitch1');
	var switch2Img = document.getElementById('coolSwitch2');
	//var switch3Img = document.getElementById('coolSwitch3');

	var div1 = document.getElementById('cool_1');
	var div2 = document.getElementById('cool_2');
	//var div3 = document.getElementById('cool_3');

	if (target==1)
	{
		switch1Img.src = "http://image.ec21.com/img/ec/main/num01_on.gif";
		switch2Img.src = "http://image.ec21.com/img/ec/main/num02_off.gif";
		//switch3Img.src = "http://image.ec21.com/img/ec/main/num03_off.gif";
		div1.style.display = "block";
		div2.style.display = "none";
		//div3.style.display = "none";
	}
	else if (target==2)
	{
		switch1Img.src = "http://image.ec21.com/img/ec/main/num01_off.gif";
		switch2Img.src = "http://image.ec21.com/img/ec/main/num02_on.gif";
		//switch3Img.src = "http://image.ec21.com/img/ec/main/num03_off.gif";
		div1.style.display = "none";
		div2.style.display = "block";
		//div3.style.display = "none";
	}	
	/*
	else if (target==3)
	{
		switch1Img.src = "http://image.ec21.com/img/ec/main/num01_off.gif";
		switch2Img.src = "http://image.ec21.com/img/ec/main/num02_off.gif";
		switch3Img.src = "http://image.ec21.com/img/ec/main/num03_on.gif";
		div1.style.display = "none";
		div2.style.display = "none";
		div3.style.display = "block";
	}	
	*/
}


function checkNewsletterForm()
{
	var form = document.NewsletterForm;
	var re = /^[0-9a-zA-Z\-\.\_]+@[0-9a-zA-Z\-]+\.[0-9a-zA-Z\-\.]+$/;

	if (!form.newsletter_email.value.match(re))
	{
		alert("Please enter a valid E-mail address.");
		form.newsletter_email.focus();
		return false;
	}
	else
	{
		form.submit();
	}
}

function ClearText(form)
{
	form.value = "";
}


/* CategoryList */
function displayNoneCategorySubTimeOut(categorymId)
{
	//setTimeout("displayNoneCategorySub("+categorymId+");", 500);
	displayNoneCategorySub(categorymId);
}

function displayNoneCategorySub(categorymId)
{
	$('catetitle'+categorymId).style.backgroundPosition = "0 0";
	$('catetitle'+categorymId).getElementsByTagName("div")[0].style.display = 'none';
}

function displayBlankCategorySubTimeOut(categorymId)
{
	//setTimeout("displayBlankCategorySub("+categorymId+");", 500);
	displayBlankCategorySub(categorymId);
}

function displayBlankCategorySub(categorymId)
{
	var categoryTitle = $('catetitle'+categorymId);
	var categorySub = categoryTitle.getElementsByTagName("div")[0];

	if ((categoryTitle.className).indexOf("double")>-1)
	{
		categoryTitle.style.backgroundPosition = "0 -37px";
	}
	else
	{
		categoryTitle.style.backgroundPosition = "0 -28px";
	}

	categorySub.style.display = "";
}

function initCategoryList()
{
	for (i=1; i<=43; i++)
	{
		$('catetitle'+i).setAttribute("index", i);
		$('catetitle'+i).onmouseover = function() {displayBlankCategorySubTimeOut(this.getAttribute("index"));};
		$('catetitle'+i).onmouseout = function() {displayNoneCategorySubTimeOut(this.getAttribute("index"));};

		var categorySub = $('catetitle'+i).getElementsByTagName("div")[0];
		categorySub.setAttribute("index", i);
		categorySub.onmouseover = function() {displayBlankCategorySubTimeOut(this.getAttribute("index"));};
		categorySub.onmouseout = function() {displayNoneCategorySubTimeOut(this.getAttribute("index"));};
	}
}
/* /CategoryList */