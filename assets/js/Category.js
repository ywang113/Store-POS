var categorylist = []

function newCategory_action() {
  var newCategory = document.getElementById("categoryName").value;
  categorylist.push(newCategory);

  //save data in json
  JsonFilename = "categorylist.json";
  saveData(categorylist, JsonFilename);
  
  console.log(categorylist);
}

//save data in json format function
var saveData = (function () {
    var a = document.createElement("a");
    document.body.appendChild(a);
    a.style = "display: none";
    return function (data, fileName) {
        var json = JSON.stringify(data),
            blob = new Blob([json], {type: "octet/stream"}),
            url = window.URL.createObjectURL(blob);
        a.href = url;
        a.download = fileName;
        a.click();
        window.URL.revokeObjectURL(url);
    };
}());