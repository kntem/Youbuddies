/*Handle requests from background.html*/
function handleRequest(
	//The object data with the request params
	request, 
	//These last two ones isn't important for this example, if you want know more about it visit: http://code.google.com/chrome/extensions/messaging.html
	sender, sendResponse
	) {
	if (request.callFunction == "toggleSidebar")
		toggleSidebar(request.videoid);
}
chrome.extension.onRequest.addListener(handleRequest);

/*Small function wich create a sidebar(just to illustrate my point)*/
var sidebarOpen = false;
function toggleSidebar(videoid) {
	if(sidebarOpen) {
		var el = document.getElementById('mySidebar');
		el.parentNode.removeChild(el);
		sidebarOpen = false;
	}
	else {
		var sidebar = document.createElement('div');
		sidebar.id = "mySidebar";
		sidebar.innerHTML = "<iframe frameborder='1' height='100%' width='100%' src='http://cyberang3l.ath.cx:33335/youtube/Loading.html?videoid="+videoid+"' ></iframe>";
		sidebar.style.cssText = "\
			position:fixed;\
			top:0px;\
			right:0px;\
			width:30%;\
			height:100%;\
			background:white;\
			box-shadow:inset 0 0 1em black;\
			z-index:999999;\
		";
		document.body.appendChild(sidebar);
		sidebarOpen = true;
	}
}