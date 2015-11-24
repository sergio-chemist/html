function getMetaContentByName(name, content) {
  var content = (content == null) ? 'content' : content;
  return document.querySelector("meta[name='" + name + "']").getAttribute(content);
}

function getChildWithInnerHTML(parent, depth, text) {
  if (parent && depth>=0) {
    var n = parent.children.length;
    for (var i = 0; i < n; i++) {
      var child = parent.children[i];
      if (depth = 0) {
        if (child.innerHTML == text) return child;
      } else 
      return getChildWithInnerHTML(child, depth-1, text);
    }
  }
  return null;
}

function getLinkWithText(list, text) {
    var n = list.children.length;
    for (var i = 0; i < n; i++) {
      var item = list.children[i];
      if (item.children.length==1) { 
		link = item.children[0];
        if (link.innerHTML == text) return link;
    }
  }
  return null;
}

function setEvents() {
  ShowTime();
  var pagetype = getMetaContentByName("pagetype");
  if (pagetype) {
    hmenu = document.getElementsByClassName("hmenu");
    if (hmenu) {
      var item = getLinkWithText(hmenu[0], pagetype);
      if (item) {
        item.style.fontWeight = "bold";
      	item.style.backgroundColor = "skyblue";
      	item.style.color = "#444";
      }
    }
  }
  var main = document.getElementById("main");
  main.docheight = document.documentElement.clientHeight;
  topbar = document.getElementById("topbar");
  topheight = parseInt(getComputedStyle(topbar).height);
  main.iniheight = main.docheight - topheight - 10;
  main.style.height = main.iniheight + "px";
  parent.onresize = function() {
    var docheight = document.documentElement.clientHeight;
    main.style.height = main.iniheight + docheight -
      main.docheight + "px";
  }
}
window.addEventListener("load", setEvents);
