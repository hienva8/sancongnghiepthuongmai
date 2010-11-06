loadstatustext = '<center><img src="../interface/loading.gif"><center>';
function ajaxLoad(url,id)
   {
       if (document.getElementById) {
           var x = (window.ActiveXObject) ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();
           }
           if (x)
               {
           x.onreadystatechange = function()
                   {
                       el = document.getElementById(id);
                       el.innerHTML = loadstatustext;
               if (x.readyState == 4 && x.status == 200)
                       {
                       el.innerHTML = x.responseText;
                   }
                   }
               x.open("GET", url, true);
               x.send(null);
               }
    }