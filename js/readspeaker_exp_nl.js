var selectedString=null;var rsExp={settings:{usePost:false,useCloudService:true,protocol:document.location.protocol||"http:",region:null,rsent:"rsent",appserverhost:"app.readspeaker.com",flash:{allowScriptAccess:"always",height:"20",params:"&autoplay=1&rskin=bump&time_format=ms",width:"250"}},imageSrc:{cloud:{closeSrc:"/graphic/default/images/rs_player_close_13px.png",flashSrc:"/flash/readspeaker.swf",iconSrc:"/graphic/default/images/rs_player_icon_16px.gif",playSrc:"/graphic/default/images/rs_player_play_13px.png",playInactiveSrc:"/graphic/default/images/rs_player_play_inactive_13px.png",pauseSrc:"/graphic/default/images/rs_player_pause_13px.png",pauseInactiveSrc:"/graphic/default/images/rs_player_pause_inactive_13px.png",stopSrc:"/graphic/default/images/rs_player_stop_13px.png",stopInactiveSrc:"/graphic/default/images/rs_player_stop_inactive_13px.png"},media:{closeSrc:"/images/enterprise/default/close.png",flashSrc:"/flash/readspeaker20.swf",playSrc:"/images/enterprise/default/play.png",playInactiveSrc:"/images/enterprise/default/play2.png",pauseSrc:"/images/enterprise/default/pause.png",pauseInactiveSrc:"/images/enterprise/default/pause2.png",stopSrc:"/images/enterprise/default/stop.png",stopInactiveSrc:"/images/enterprise/default/stop2.png",iconSrc:"/images/buttons/listen_icons/icon_16px.gif"}},data:{params:null,images:null,phrases:{closeplayer:"Speler afsluiten",gotowebsite:"Go to the ReadSpeaker website",nosound:"Geen geluid?",pause:"Pauze",play:"Afspelen",speechenabled:"Speech-enabled by <a href='http://www.readspeaker.com/nl/?ref="+encodeURIComponent(document.location.href)+"' target='_blank'>ReadSpeaker</a>",stop:"Stop",volume:"Volume"},setParams:function(b){var h={};var g="";var d="";var f="";var a=b.split("?");var e=a[1].split(/[;&]/);for(var c=0;c<e.length;c++){g=e[c].split("=");if(!g||g.length!=2){continue}d=unescape(g[0]);f=unescape(g[1]);f=f.replace(/\+/g," ");h[d]=f}return h},setImages:function(){var a={};var e="";var f=rsExp.settings.region||"eu";var d=(rsExp.settings.useCloudService&&rsExp.settings.protocol!="https")?"cloud":"media";var b=rsExp.imageSrc[d];for(var c in b){if(b.hasOwnProperty(c)){if(b[c].indexOf("://")!=-1){e=""}else{if(d=="cloud"){e="http://f1."+f+".readspeaker.com"}else{e=rsExp.settings.protocol+"//media.readspeaker.com"}}a[c]=e+b[c]}}return a},getImage:function(a){return(this.images&&this.images[a]&&this.images[a]!==undefined)?this.images[a]:""},getParam:function(a){return(this.params&&this.params[a]&&this.params[a]!==undefined)?this.params[a]:null},getPhrase:function(a){return(this.phrases&&this.phrases[a]&&this.phrases[a]!==undefined)?this.phrases[a]:""},getUserAgent:function(){if(document.selection){return"IE"}if((navigator.userAgent.toLowerCase().indexOf("iphone")>-1||navigator.userAgent.toLowerCase().indexOf("ipad")>-1||navigator.userAgent.toLowerCase().indexOf("ipod")>-1)&&navigator.vendor.toLowerCase().indexOf("apple")>-1){return"IOS"}else{return"OTHER"}}},vars:{selectedString:"",STATE_NOT_READY:0,STATE_READY:1,STATE_PLAYING:2,currentState:0},initialize:function(a){if(rsExp.vars.currentState!=rsExp.vars.STATE_NOT_READY){return}rsExp.data.params=rsExp.data.setParams(a);rsExp.data.images=rsExp.data.setImages();rsExp.createStylesheet();rsExp.vars.currentState=rsExp.vars.STATE_READY},readspeaker:function(a,b){rsExp.initialize(a);rsExp.player(a,b)},player:function(b,c){var e=b.replace(/&selectedhtml=null/i,"");if(rsExp.vars.selectedString.length>0){e=rsExp.issuePOST(e,rsExp.vars.selectedString)}else{if(rsExp.settings.usePost&&rsExp.data.getParam("readid")){var d=document.getElementById(rsExp.data.getParam("readid")).innerHTML;if(d){e=rsExp.issuePOST(e,"<div id='"+rsExp.data.getParam("readid")+"'>"+d+"</div>")}}}var f="<div id='rsPlayerArea'>";f+="<div id='rsTopRow'>";f+="<span style='position: absolute; top: 0px; left: 0px;'>";f+=rsExp.createPlayer(e);f+="</span>";f+="<span style='position: absolute; top: 4px; right: 4px;'>";f+="<a style='border-style: none;' href='JavaScript:void(0);' onclick='rsExp.closepage(\""+c+"\");return false'><img style='border-style: none !important; margin: 0px !important;' id='closebr' src='"+rsExp.data.getImage("closeSrc")+"' alt='"+rsExp.data.getPhrase("closeplayer")+"' title='"+rsExp.data.getPhrase("closeplayer")+"'></a>";f+="</span>";f+="</div>";f+="<div id='rsBottomRow'>";f+=rsExp.data.getPhrase("speechenabled")+"<br/>";f+="<a href='"+e+"'>"+rsExp.data.getPhrase("nosound")+"</a>";f+="</div>";f+="</div>";var a=document.getElementById(c);if(a){a.innerHTML=f;a.style.display="block"}rsExp.html5.start(e+"&audioformat=mp3");rsExp.vars.currentState=rsExp.vars.STATE_PLAYING},createPlayer:function(a){var b="";if(rsExp.data.getUserAgent()=="IOS"){b+='<div style="position: absolute; top: 4px; left: 4px;"><a id="rs_playbtn" href="JavaScript:void(0);"><img id="rs_playimg" style="border-style: none !important; margin: 0px !important; padding:0px !important;" src="'+rsExp.data.getImage("playInactiveSrc")+'" title="'+rsExp.data.getPhrase("play")+'" alt="'+rsExp.data.getPhrase("play")+'"></a></div>';b+='<div style="position: absolute; top: 4px; left: 21px;"><a id="rs_pausebtn" href="JavaScript:void(0);"><img id="rs_pauseimg" style="border-style: none !important; margin: 0px !important; padding:0px !important;" src="'+rsExp.data.getImage("pauseSrc")+'" title="'+rsExp.data.getPhrase("pause")+'" alt="'+rsExp.data.getPhrase("pause")+'"></a></div>';b+='<div style="position: absolute; top: 4px; left: 38px;"><a id="rs_stopbtn" href="JavaScript:void(0);"><img id="rs_stopimg" style="border-style: none !important; margin: 0px !important; padding:0px !important;" src="'+rsExp.data.getImage("stopSrc")+'" title="'+rsExp.data.getPhrase("stop")+'" alt="'+rsExp.data.getPhrase("stop")+'"></a></div>';b+='<div id="timeline"><div id="duration"></div><span id="durationtxt"></span></div>';b+='<div style="position: absolute; top: 2px; left: 231px;"><a href="http://www.readspeaker.com/?ref='+encodeURIComponent(document.location.href)+'"><img style="border-style: none !important; margin: 0px !important; padding:0px !important;" src="'+rsExp.data.getImage("iconSrc")+'" title="'+rsExp.data.getPhrase("gotowebsite")+'" alt="'+rsExp.data.getPhrase("gotowebsite")+'" /></a></div>'}else{if(document.selection){b+='<object id="rsPlayer" style="height:'+rsExp.settings.flash.height+"px; width:"+rsExp.settings.flash.width+'px;" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">'}else{b+='<object id="rsPlayer" style="height:'+rsExp.settings.flash.height+"px; width:"+rsExp.settings.flash.width+'px;" data="'+rsExp.data.getImage("flashSrc")+"?mp3="+encodeURIComponent(a)+rsExp.settings.flash.params+"&text_play="+rsExp.data.getPhrase("play")+"&text_pause="+rsExp.data.getPhrase("pause")+"&text_stop="+rsExp.data.getPhrase("stop")+"&text_vol="+rsExp.data.getPhrase("volume")+'" type="application/x-shockwave-flash">'}b+='<param name="movie" value="'+rsExp.data.getImage("flashSrc")+"?mp3="+encodeURIComponent(a)+rsExp.settings.flash.params+"&text_play="+rsExp.data.getPhrase("play")+"&text_pause="+rsExp.data.getPhrase("pause")+"&text_stop="+rsExp.data.getPhrase("stop")+"&text_vol="+rsExp.data.getPhrase("volume")+'" />';b+='<param name="autostart" value="true"><param name="quality" value="high"><param name="allowScriptAccess" value="'+rsExp.settings.flash.allowScriptAccess+'"></object>'}return b},closepage:function(b){rsExp.html5.stop();var a=document.getElementById(b);if(a){a.innerHTML="";a.style.display="none"}rsExp.vars.currentState=rsExp.vars.STATE_READY},copySelected:function(){setTimeout("rsExp.getSelectedHTML()",50);return true},issuePOST:function(a,g){if(!document.getElementById("postiframe1")){var f=null;if(document.selection){try{f=document.createElement('<iframe name="postiframe1">')}catch(l){f=document.createElement("iframe")}f.name="postiframe1"}else{f=document.createElement("iframe");f.name="postiframe1"}f.setAttribute("id","postiframe1");f.setAttribute("style","display: none; position: absolute;");f.style.display="none";var c=document.getElementsByTagName("body");var n=null;if(c.length>0){n=c.item(0)}if(n){n.appendChild(f)}else{return}}a=a+"&output=audiolink";var e=document.createElement("form");e.target="postiframe1";e.method="post";var m=a.split("?");var k=Math.random();e.action=rsExp.settings.protocol+"//"+rsExp.settings.appserverhost+"/enterprise/iframeproxy.php?rsent="+rsExp.settings.rsent+"&randid="+k;var j=m[1].split("&");var h;for(h=0;h<j.length;h++){var d=j[h].split("=");var o=document.createElement("input");o.setAttribute("name",unescape(d[0]));if(unescape(d[0]).indexOf("url")!=-1&&unescape(d[1]).length<3){o.setAttribute("value",document.location.href)}else{o.setAttribute("value",unescape(d[1]))}e.appendChild(o)}var o=document.createElement("input");if(rsExp.vars.selectedString.length<1&&rsExp.settings.usePost){o.setAttribute("name","html_base64")}else{o.setAttribute("name","selectedhtml_base64")}o.setAttribute("value",rsExp.base64.encode(g));e.appendChild(o);document.body.appendChild(e);e.submit();document.body.removeChild(e);return rsExp.settings.protocol+"//"+rsExp.settings.appserverhost+"/enterprise/iframeproxy.php?rsent="+rsExp.settings.rsent+"&listen=1&randid="+k},getSelectedHTML:function(){rsExp.vars.selectedString="";var a=undefined;if(window.getSelection){selobj=window.getSelection();if(!selobj.isCollapsed){if(selobj.getRangeAt){a=selobj.getRangeAt(0)}else{a=document.createRange();a.setStart(selobj.anchorNode,selobj.anchorOffset);a.setEnd(selobj.focusNode,selobj.focusOffset)}if(a){DOM=a.cloneContents();object=document.createElement("div");object.appendChild(DOM.cloneNode(true));rsExp.vars.selectedString=object.innerHTML}else{rsExp.vars.selectedString=selobj}}}else{if(document.selection){selobj=document.selection;a=selobj.createRange();if(a&&a.htmlText&&a.text&&a.text.length>0){rsExp.vars.selectedString=a.htmlText}else{if(a&&a.text){rsExp.vars.selectedString=a.text}else{rsExp.vars.selectedString=""}}}else{if(document.getSelection){rsExp.vars.selectedString=document.getSelection()}}}},createStylesheet:function(){if(document.styleSheets.rsstylesheet||document.getElementById("rsstylesheet")){return}var c=document.createElement("style");c.name="rsstylesheet";c.type="text/css";c.setAttribute("id","rsstylesheet");c.style.display="none";var f=document.getElementsByTagName("head");var a=null;if(f.length>0){a=f.item(0)}if(a){a.appendChild(c)}else{return}var e=parseInt(rsExp.settings.flash.height)+31;var d=parseInt(rsExp.settings.flash.width)+24;rsExp.changeCSSRule("#rsPlayerArea","position: relative !important; border:1px solid #aeaeae !important; background:#ffffff !important; width: "+d+"px !important; height: "+e+"px !important; line-height: normal !important;");rsExp.changeCSSRule("#rsPlayerArea object","max-width: none !important;");rsExp.changeCSSRule("#rsTopRow","margin-bottom: 2px !important; width: 100% !important; height: 20px !important;");rsExp.changeCSSRule("#closebr","border-style: none !important; margin: 0px !important; padding: 0px !important; ");rsExp.changeCSSRule("#rsBottomRow","font-style: normal !important; font-family: Arial !important; color: #333 !important; font-size: 11px !important; padding-left: 2px !important;");rsExp.changeCSSRule("#rsBottomRow a","color: #000 !important; border-style: none !important; text-decoration: underline !important; font-weight: normal !important; font-size: 11px !important; font-family: Arial !important;");rsExp.changeCSSRule("#rsBottomRow a:hover","text-decoration: underline !important; font-weight: bold !important;");rsExp.changeCSSRule("#timeline","position: absolute !important; top: 4px !important; left: 55px !important; height: 11px !important; background-color: #F4F4F4 !important; width: 170px !important; border: 1px solid #3380CC !important;");rsExp.changeCSSRule("#duration","position: relative !important; height: 11px !important; background-color: #92C0EF !important; width: 0px;");rsExp.changeCSSRule("#durationtxt","position: absolute !important; top: 1px !important; left: 0px !important; text-align: center !important; font-size: 10px !important; font-weight: bold !important; font-family: Helvetica !important; color: #003399 !important; line-height: 80% !important; width: 100% !important;")},changeCSSRule:function(a,b){if(document.styleSheets.rsstylesheet){css=document.styleSheets.rsstylesheet}else{if(document.getElementById("rsstylesheet")){css=document.getElementById("rsstylesheet")}}if(css.addRule){css.addRule(a,b)}else{if(css.sheet.insertRule){css.sheet.insertRule(a+" {"+b+"}",css.sheet.cssRules.length)}}},html5:{STATE_BEGIN:0,STATE_USER_START_NOT_READY:1,STATE_USER_START_PLAYING:2,state:0,audioelement:null,url:null,start:function(b){if(rsExp.data.getUserAgent()!="IOS"){return}rsExp.html5.url=b;rsExp.html5.stop();rsExp.html5.audioelement=new Audio(rsExp.html5.url);rsExp.html5.audioelement.setAttribute("controls","controls");rsExp.html5.audioelement.loop=false;rsExp.html5.audioelement.play();rsExp.html5.audioelement.addEventListener("ended",rsExp.html5.controls.stop,false);rsExp.html5.audioelement.addEventListener("timeupdate",rsExp.html5.controls.timer,false);var d=document.getElementById("rs_playbtn");d.addEventListener("click",rsExp.html5.controls.play,false);var c=document.getElementById("rs_pausebtn");c.addEventListener("click",rsExp.html5.controls.pause,false);var a=document.getElementById("rs_stopbtn");a.addEventListener("click",rsExp.html5.controls.stop,false);rsExp.html5.state=rsExp.html5.STATE_USER_START_PLAYING},controls:{play:function(){if(rsExp.html5.audioelement){rsExp.html5.audioelement.play()}else{rsExp.html5.start(rsExp.html5.url)}if(document.getElementById("rs_playimg")){document.getElementById("rs_playimg").setAttribute("src",rsExp.data.getImage("playInactiveSrc"))}if(document.getElementById("rs_pauseimg")){document.getElementById("rs_pauseimg").setAttribute("src",rsExp.data.getImage("pauseSrc"))}if(document.getElementById("rs_stopimg")){document.getElementById("rs_stopimg").setAttribute("src",rsExp.data.getImage("stopSrc"))}},pause:function(){setTimeout("rsExp.html5.audioelement.pause()",200);if(document.getElementById("rs_pauseimg")){document.getElementById("rs_pauseimg").setAttribute("src",rsExp.data.getImage("pauseInactiveSrc"))}if(document.getElementById("rs_playimg")){document.getElementById("rs_playimg").setAttribute("src",rsExp.data.getImage("playSrc"))}},stop:function(){if(rsExp.html5.audioelement){rsExp.html5.audioelement.removeEventListener("timeupdate",rsExp.html5.controls.timer,false)}rsExp.html5.stop();if(document.getElementById("rs_stopimg")){document.getElementById("rs_stopimg").setAttribute("src",rsExp.data.getImage("stopInactiveSrc"))}if(document.getElementById("rs_playimg")){document.getElementById("rs_playimg").setAttribute("src",rsExp.data.getImage("playSrc"))}if(document.getElementById("rs_pauseimg")){document.getElementById("rs_pauseimg").setAttribute("src",rsExp.data.getImage("pauseInactiveSrc"))}var b=document.getElementById("duration");b.style.width="0%";var a=document.getElementById("durationtxt");a.innerHTML="00:00 | 00:00"},timer:function(){if(rsExp.html5.audioelement){var d=document.getElementById("duration");var k=document.getElementById("durationtxt");var b=rsExp.html5.audioelement.duration;var f=rsExp.html5.audioelement.currentTime;d.style.width=f/b*100+"%";if(!b){var g="00";var j="00";var a=""}else{var g=parseInt(b%60)+"";var j=parseInt((b/60)%60)+"";var a=parseInt(((b/60)/60)%60)+""}var l=parseInt(rsExp.html5.audioelement.currentTime%60)+"";var c=parseInt((rsExp.html5.audioelement.currentTime/60)%60)+"";var e=parseInt(((rsExp.html5.audioelement.currentTime/60)/60)%60)+"";if(a!=0){if(a.length<2){a=0+a+":"}if(e.length<2){e=0+e+":"}}else{a="";e=""}if(j.length<2){j=0+j}if(g.length<2){g=0+g}if(c.length<2){c=0+c}if(l.length<2){l=0+l}if(b){k.innerHTML=e+c+":"+l+" | "+a+j+":"+g}else{k.innerHTML="00:00 | 00:00"}}}},stop:function(){if(rsExp.html5.state!=rsExp.html5.STATE_BEGIN){if(rsExp.html5.audioelement){rsExp.html5.audioelement.pause()}rsExp.html5.audioelement=null}rsExp.html5.state=rsExp.html5.STATE_BEGIN}},base64:{encode:function(f){newdata=encodeURIComponent(f);var g=0;var e=0;var b=[];for(;g<newdata.length;g++){if(newdata.charCodeAt(g)!="%".charCodeAt(0)){b[e]=newdata.charCodeAt(g)}else{b[e]=parseInt("0x"+newdata.charAt(g+1)+""+newdata.charAt(g+2));g=g+2}e++}var l=b.length;var c=4*parseInt((l+2)/3);var h=new String();var k=parseInt(l/3);var a;var d=l-3*k;g=0;for(;g<3*k;g+=3){a=rsExp.base64.chars(b[g]>>2);h+=a;a=rsExp.base64.chars(((b[g]&3)<<4)|(b[g+1]>>4));h+=a;a=rsExp.base64.chars(((b[g+1]&15)<<2)|(b[g+2]>>6));h+=a;a=rsExp.base64.chars(b[g+2]&63);h+=a}if(d==1){h+=rsExp.base64.chars(b[g]>>2);h+=rsExp.base64.chars((b[g]&3)<<4);h+="=";h+="="}if(d==2){h+=rsExp.base64.chars(b[g]>>2);h+=rsExp.base64.chars(((b[g]&3)<<4)|(b[g+1]>>4));h+=rsExp.base64.chars((b[g+1]&15)<<2);h+="="}return h},decode:function(f){var h="";var d="";var g=0;var c=0;var e="";var b=f.length;while(g<b){if(rsExp.base64.value(f[g])!=-1){e=f.substring(g,g+4);c=0;for(i=0;i<4;i++){if(e[i]=="="){c++}}for(i=0;i<3-c;i++){if(i==0){d=(rsExp.base64.value(e[0])<<2)|((rsExp.base64.value(e[1])&48)>>4)}else{if(i==1){d=((rsExp.base64.value(e[1])&15)<<4)|((rsExp.base64.value(e[2])&60)>>2)}else{if(i==2){d=((rsExp.base64.value(e[2])&3)<<6)|rsExp.base64.value(e[3])}}}var a=d.toString(16);if(a.length==1){a="0"+a}h+="%"+a}g+=4}else{g++}}return decodeURIComponent(h)},value:function(a){var b=a.charCodeAt(0);if(b>="A".charCodeAt(0)&&b<="Z".charCodeAt(0)){return b-"A".charCodeAt(0)}else{if(b>="a".charCodeAt(0)&&b<="z".charCodeAt(0)){return b-"a".charCodeAt(0)+26}else{if(b>="0".charCodeAt(0)&&b<="9".charCodeAt(0)){return b-"0".charCodeAt(0)+52}else{if(b=="+".charCodeAt(0)){return 62}else{if(b=="/".charCodeAt(0)){return 63}else{return -1}}}}}},chars:function(a){if(a<26){return String.fromCharCode(a+"A".charCodeAt(0))}else{if(a<52){return String.fromCharCode(a+"a".charCodeAt(0)-26)}else{if(a<62){return String.fromCharCode(a+"0".charCodeAt(0)-52)}else{if(a==62){return"+"}else{if(a==63){return"/"}else{return String.fromCharCode(0)}}}}}}}};function readspeaker(a,b){rsExp.readspeaker(a,b)}if(document.addEventListener){document.addEventListener("mouseup",rsExp.copySelected,false);document.addEventListener("keyup",rsExp.copySelected,false)}else{if(document.attachEvent){document.attachEvent("onmouseup",rsExp.copySelected);document.attachEvent("onkeyup",rsExp.copySelected)}else{document.onmouseup=rsExp.copySelected;document.onkeyup=rsExp.copySelected}};