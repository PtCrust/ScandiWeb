class SELswitcher {

  getval(val)
  {
      this.val = val;
      
      var switcher = {
        'DVD': function () {
          document.getElementById("size").style = "display:block;";
          document.getElementById("dimensions").style = "display:none;";
          document.getElementById("weight").style = "display:none;";

        },
        'Furniture': function () {
          document.getElementById("size").style = "display:none;";
          document.getElementById("dimensions").style = "display:block;";
          document.getElementById("weight").style = "display:none;";
        },
        'Book': function () {
          document.getElementById("size").style = "display:none;";
          document.getElementById("dimensions").style = "display:none;";
          document.getElementById("weight").style = "display:block;";

        }
      }
     return switcher[val]();
  }
}
var selector = new SELswitcher();
