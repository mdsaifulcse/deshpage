function openNav(){document.getElementById("mySidenav").style.display="block";}
function closeNav(){document.getElementById("mySidenav").style.display="none";}
function openSubMenu(id){document.getElementById(id).style.display="block";}
function closeSubMenu(id){document.getElementById(id).style.display="none";}
function openSearch(){document.getElementById("searchBox").style.display="block";document.getElementById("inputSearch").focus();}
function closeSearch(){document.getElementById("searchBox").style.display="none";}
function openTab(evt,el){var i,tabcontent,tablinks;tabcontent=evt.parentElement.parentElement.querySelectorAll(".tabcontent");for(i=0;i<tabcontent.length;i++){tabcontent[i].style.display="none";}
tablinks=evt.parentElement.querySelectorAll(".tablinks");for(i=0;i<tablinks.length;i++){tablinks[i].className=tablinks[i].className.replace(" activeTab","");}
document.getElementById(el).style.display="block";evt.className+=" activeTab";}
function openApp(){let userAgent=navigator.userAgent||navigator.vendor||window.opera;if(/android/i.test(userAgent)){window.open('https://play.google.com/store/apps/details?id=com.jagonews24.bangla');}
if(/iPad|iPhone|iPod/.test(userAgent)&&!window.MSStream){window.open('https://apps.apple.com/us/app/jagonews24-com/id1047514259');}
return "unknown";}