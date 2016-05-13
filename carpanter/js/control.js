var count;
var CookieName = "count";
//新增檔案
function addFile(){
	count = readCookie(CookieName);
	//console.log("count="+count);
	if (count==null) {
		count = 1;
	}
	//定位點
	var id="#File_"+count;
	//新增物品
	var add = parseInt(count) + 1;
	//console.log("add="+add);
	var ItemAppendString='<div class="form-group"><label class="control-label">捐贈物品'+add+'</label><input class="form-control" type="text" name="Item" placeholder="物品名稱" required></input></div><div class="form-group"><label class="control-label">狀況說明'+add+'</label><input class="form-control" type="text" name="Status" placeholder="物品詳細狀況"></input></div><div class="form-group" id="File_'+add+'"><input type="file" name="file" required></input></div>';
	$(id).append(ItemAppendString);
	/*//刪除舊有的cookie
	eraseCookie(CookieName);
	//將新的檔案數目儲存至cookie內
	createCookie(CookieName,add,1);
	//document.cookie = "count="+count+";";*/
	count = add ;
	document.cookie="count="+count+";";
}
// 建立cookie
function createCookie(name, value, days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    var expires = "; expires=" + date.toGMTString();
  }
  else var expires = "";
  document.cookie = name + "=" + value + expires + ";";
}
//讀取
function readCookie(name) {
   var nameEQ = name + "=";
   var ca = document.cookie.split(';');
   for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
   }
   return null;
}
//刪除
function eraseCookie(name) {
   createCookie(name, "", -1);
}
