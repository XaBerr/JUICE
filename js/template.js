var project = {
  size: 0,
  current: 0,
  update: true
};

$(document).ready(function() {
  project.size = $(".project").length;
  getTheme();
  autoFocus();
  initSelected();
  updateProjects(1);
  $("#search").keyup(function(event) {
    search();
  });
  $(".theme-preview").click(function() {
    setCookie("theme", $(this).attr("theme"), 700);
    window.location.reload();
  });
  $(".project-link").click(function(event) {
    window.open($(this).attr('href'), '_blank');
  });
});

//################_SEARCH_################

function autoFocus() {
  setTimeout(function() {
    $('#search').focus()
  }, 10);

  $('#search').on('blur', function() {
    autoFocus();
  });
}

function search() {
  var val = $("#search").val().toLowerCase();
  var selected = val.split("|");
  setSelected(selected.length > 0 ? selected : [""]);
  if (filter(selected.length > 0 ? selected : [""]) == 0) {
    var layout = '<p class="text-center h-100 mt-5 h3 text-muted font-weight-light">No results founded...</p>';
    $(".find-result").html(layout);
  } else {
    $(".find-result").html("");
  }
}

function filter(_array) {
  var count = 0;
  $(".site").each(function(index, el) {
    var text = $(el).html().toLowerCase();
    var father = $(el).closest(".project");
    var success = false;
    for (var i = 0; i < _array.length; i++)
      if (text.indexOf(_array[i]) > -1)
        success = true;
    if (success) {
      $(father).removeClass('d-none');
      count++;
    } else
      $(father).addClass('d-none');
  });
  return count;
}

function setSelected(_array) {
  _array = _array.unique();
  var active = _array.join("|");
  window.location.hash = active;
}

function getSelected() {
  var selected = window.location.hash;
  selected = selected.replace("#", "");
  var active = selected.split("|");
  return active;
}

function initSelected() {
  var selected = getSelected();
  var temp = selected.join("|");
  if (temp.length > 0) {
    filter(selected.length > 0 ? selected : [""]);
    $("#search").val(temp);
  }
}

//################_THEMES_################

function getTheme() {
  var themeSelected = getCookie("theme");
  var css = themeSelected.replace("theme-", "");
  $("<link/>", {
    rel: "stylesheet",
    type: "text/css",
    href: "css/themes/"+css+".min.css"
  }).appendTo("head");
  $(".theme-"+css).find(".theme-info").append('<span class="badge badge-success">Active</span>');
  $("body").addClass("theme-"+css);
  if(css == "special")
    $("#container").prepend('<div class="grid"></div>');
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

//################_POCKET_UPDATE_################

function updateProjects( _time ) {
  setTimeout(function() {
    $(".project").each(function(index, el) {
      postGetPocket("drawFull", {"project": $(this).attr("project")});
    });
  }, _time);
}

function postGetPocket(_action, _obj) {
  $.post('ajax', {
      "action": _action,
      "data"  : JSON.stringify(_obj)
    }, function(data, textStatus, xhr) {
      var temp = JSON.parse(data);
      if(project.update)
        $("[project="+temp.project+"]").replaceWith(temp.html);
      search();
      project.current++;
      $(".progress-bar").css("width", (project.current/project.size*100)+"%");
      if(project.current == project.size) {
        project.current = 0;
        $(".progress-bar").css("width", (project.current/project.size*100)+"%");
        updateProjects(10000);
      }
  });
}

//################_OTHERS_################

function ps( _class, _data, _callback ) {
  // hello;
  $(_class).click(function(event) {
    ajax("ajax", _data);
  });
}

function ajax(_action, _obj, _callback) {
  $.post('ajax', {
      "action": _action,
      "data"  : JSON.stringify(_obj)
    }, function(data, textStatus, xhr) {
      _callback(data);
  });
}

Array.prototype.unique = function() {
  var n = {},
    r = [];
  for (var i = 0; i < this.length; i++) {
    if (!n[this[i]]) {
      n[this[i]] = true;
      r.push(this[i]);
    }
  }
  return r;
}
