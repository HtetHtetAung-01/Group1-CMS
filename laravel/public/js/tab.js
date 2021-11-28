
/**
 * Navigation tab and show content
 * @param {enent} evt 
 * @param {string} type type of list to show in content
 */
function showList(evt, type) {
    
    // Declare all variables
    var i, listContent, tabBtn;
  
    // Get all elements with class="listContent" and hide them
    listContent = document.getElementsByClassName("list-content");
    for (i = 0; i < listContent.length; i++) {
      listContent[i].style.display = "none";
    }
  
    // Get all elements with class="tabBtn" and remove the class "active"
    tabBtn = document.getElementsByClassName("tab-btn");
    for (i = 0; i < tabBtn.length; i++) {
      tabBtn[i].className = tabBtn[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(type).style.display = "block";
    evt.currentTarget.className += " active";
  } 