var am;
var rm;
var pm;
var spm;

function adminSignIn() {
  var email = document.getElementById("aemail");
  var password = document.getElementById("apassword");
  var rememberme = document.getElementById("rememberme");

  var form = new FormData();
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("r", rememberme.checked);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var t = request.responseText;
      if (t == "Success") {
        window.location = "dashboard.php";
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  request.open("POST", "process/signInProcess.php", true);
  request.send(form);
}

function forgotPassword() {
  var email = document.getElementById("aemail");

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        var m = document.getElementById("forgotPasswordModal");
        pm = new bootstrap.Modal(m);
        pm.show();
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("GET", "process/forgotPasswordProcess.php?e=" + email.value, true);
  r.send();
}

function resetpw() {
  var email = document.getElementById("aemail");
  var np = document.getElementById("alp1");
  var rnp = document.getElementById("alp2");
  var vcode = document.getElementById("vcode");

  var form = new FormData();
  form.append("e", email.value);
  form.append("n", np.value);
  form.append("r", rnp.value);
  form.append("v", vcode.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
       pm.hide();
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML =
          "Your password has been reset successfully";
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("POST", "process/resetPassword.php", true);
  r.send(form);
}

function uploadResources() {
  var view = document.getElementById("assFileName");
  var file = document.getElementById("assFile");

  file.onchange = function () {
    var url = this.files[0].name;
    view.innerHTML = url;
  };
}

function addProject() {
  var staff = document.getElementById("pstaff");
  var pname = document.getElementById("pname");
  var ptype = document.getElementById("ptype");
  var pstart = document.getElementById("pstart");
  var pend = document.getElementById("pend");
  var preq = document.getElementById("preq");
  var assFile = document.getElementById("assFile");

  var f = new FormData();
  f.append("s", staff.value);
  f.append("pn", pname.value);
  f.append("pt", ptype.value);
  f.append("ps", pstart.value);
  f.append("pe", pend.value);
  f.append("pr", preq.value);
  f.append("file", assFile.files[0]);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML =
          "Project added successfully";
        document
          .getElementById("alertBtn")
          .setAttribute("onclick", "window.location.reload();");
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("POST", "process/addProjectProcess.php", true);
  r.send(f);
}

function saveReview(id) {
  var star = document.querySelectorAll(".star2 .activeStar");
  var review = document.getElementById("rcomment");

  var f = new FormData();
  f.append("s", star.length);
  f.append("r", review.value);
  f.append("id", id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        $("#reviewModal").modal("hide");
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML =
          "Review added successfully";
        document
          .getElementById("alertBtn")
          .setAttribute("onclick", "window.location.reload();");
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("POST", "process/saveReviewProcess.php", true);
  r.send(f);
}

function addStaffImage() {
  var view = document.getElementById("viewStaffImg");
  var file = document.getElementById("staffimg");

  file.onchange = function () {
    var file1 = this.files[0];
    var url = window.URL.createObjectURL(file1);
    view.src = url;
  };
}

function showPassword1() {
  var i = document.getElementById("spi");
  var eye = document.getElementById("e1");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "fa fa-eye text-white";
  } else {
    i.type = "password";
    eye.className = "fa fa-eye-slash text-white";
  }
}

function addStaff() {
  var fname = document.getElementById("sfname");
  var lname = document.getElementById("slname");
  var mobile = document.getElementById("smobile");
  var email = document.getElementById("semail");
  var password = document.getElementById("spi");
  var line1 = document.getElementById("saline1");
  var dob = document.getElementById("sdob");
  var line2 = document.getElementById("saline2");
  var gender = document.getElementById("sgender");
  var district = document.getElementById("sdistrict");
  var position = document.getElementById("sposition");
  var image = document.getElementById("staffimg");

  var f = new FormData();
  f.append("fn", fname.value);
  f.append("ln", lname.value);
  f.append("m", mobile.value);
  f.append("e", email.value);
  f.append("p", password.value);
  f.append("l1", line1.value);
  f.append("dob", dob.value);
  f.append("l2", line2.value);
  f.append("g", gender.value);
  f.append("dis", district.value);
  f.append("pos", position.value);
  f.append("image", image.files[0]);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML =
          "Staff added successfully";
        document
          .getElementById("alertBtn")
          .setAttribute("onclick", "window.location.reload();");
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("POST", "process/addStaffProcess.php", true);
  r.send(f);
}

function deleteStaff(email) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        window.location.reload();
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("GET", "process/deleteStaffProcess.php?email=" + email, true);
  r.send();
}

function showPassword2() {
  var i = document.getElementById("supi");
  var eye = document.getElementById("e2");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "fa fa-eye text-white";
  } else {
    i.type = "password";
    eye.className = "fa fa-eye-slash text-white";
  }
}

function updateStaffImage() {
  var view = document.getElementById("viewStaffuImg");
  var file = document.getElementById("staffuimg");

  file.onchange = function () {
    var file1 = this.files[0];
    var url = window.URL.createObjectURL(file1);
    view.src = url;
  };
}

function updateStaff() {
  var fname = document.getElementById("sufname");
  var lname = document.getElementById("sulname");
  var mobile = document.getElementById("sumobile");
  var email = document.getElementById("suemail");
  var password = document.getElementById("supi");
  var line1 = document.getElementById("sualine1");
  var dob = document.getElementById("sudob");
  var line2 = document.getElementById("sualine2");
  var gender = document.getElementById("sugender");
  var district = document.getElementById("sudistrict");
  var position = document.getElementById("suposition");
  var image = document.getElementById("staffuimg");

  var f = new FormData();
  f.append("fn", fname.value);
  f.append("ln", lname.value);
  f.append("m", mobile.value);
  f.append("e", email.value);
  f.append("p", password.value);
  f.append("l1", line1.value);
  f.append("dob", dob.value);
  f.append("l2", line2.value);
  f.append("g", gender.value);
  f.append("dis", district.value);
  f.append("pos", position.value);
  f.append("image", image.files[0]);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML =
          "Staff updated successfully";
        document
          .getElementById("alertBtn")
          .setAttribute("onclick", "window.location.reload();");
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("POST", "process/updateStaffProcess.php", true);
  r.send(f);
}

function deleteProject(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        window.location.reload();
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("GET", "process/deleteProjectProcess.php?id=" + id, true);
  r.send();
}

function reUploadResources() {
  var view = document.getElementById("resFileName");
  var file = document.getElementById("resFile");

  file.onchange = function () {
    var url = this.files[0].name;
    view.innerHTML = url;
  };
}

function updateProject(id) {
  var staff = document.getElementById("upstaff");
  var pname = document.getElementById("upname");
  var ptype = document.getElementById("uptype");
  var upstart = document.getElementById("upstart");
  var upend = document.getElementById("upend");
  var upreq = document.getElementById("upreq");
  var resFile = document.getElementById("resFile");

  var f = new FormData();
  f.append("pid", id);
  f.append("s", staff.value);
  f.append("pn", pname.value);
  f.append("pt", ptype.value);
  f.append("ps", upstart.value);
  f.append("pe", upend.value);
  f.append("pr", upreq.value);
  f.append("file", resFile.files[0]);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML =
          "Project updated successfully";
        document
          .getElementById("alertBtn")
          .setAttribute("onclick", "window.location.reload();");
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("POST", "process/updateProjectProcess.php", true);
  r.send(f);
}

function blockStaff(email) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var txt = request.responseText;
      if (txt == "blocked") {
        document.getElementById("sbw" + email).innerHTML = "Unblock";
        document.getElementById("sbi" + email).classList = "fa fa-unlock";
      } else if (txt == "unblocked") {
        document.getElementById("sbw" + email).innerHTML = "Block";
        document.getElementById("sbi" + email).classList = "fa fa-lock";
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = txt;
      }
    }
  };

  request.open("GET", "process/staffBlockProcess.php?email=" + email, true);
  request.send();
}

function addProjectType() {
  var name = document.getElementById("ptname");
  var dec = document.getElementById("ptdec");

  var f = new FormData();
  f.append("n", name.value);
  f.append("d", dec.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML =
          "Project Type added successfully";
        document
          .getElementById("alertBtn")
          .setAttribute("onclick", "window.location.reload();");
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("POST", "process/addProjectTypeProcess.php", true);
  r.send(f);
}

function deleteProjectType(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        window.location.reload();
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("GET", "process/deleteProjectTypeProcess.php?id=" + id, true);
  r.send();
}

function updateProjectType(id) {
  var name = document.getElementById("ptuname");
  var dec = document.getElementById("ptudec");

  var f = new FormData();
  f.append("n", name.value);
  f.append("d", dec.value);
  f.append("id", id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML =
          "Project Type updated successfully";
        document
          .getElementById("alertBtn")
          .setAttribute("onclick", "window.location.reload();");
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("POST", "process/updateProjectTypeProcess.php", true);
  r.send(f);
}

function showPassword3() {
  var i = document.getElementById("apassword");
  var eye = document.getElementById("e3");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "fa fa-eye text-white";
  } else {
    i.type = "password";
    eye.className = "fa fa-eye-slash text-white";
  }
}

function showPassword4() {
  var i = document.getElementById("alp1");
  var eye = document.getElementById("e4");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "fa fa-eye text-white";
  } else {
    i.type = "password";
    eye.className = "fa fa-eye-slash text-white";
  }
}

function showPassword5() {
  var i = document.getElementById("alp2");
  var eye = document.getElementById("e5");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "fa fa-eye text-white";
  } else {
    i.type = "password";
    eye.className = "fa fa-eye-slash text-white";
  }
}

function updateAdminImage() {
  var view = document.getElementById("viewAdminImg");
  var file = document.getElementById("adminimg");

  file.onchange = function () {
    var file1 = this.files[0];
    var url = window.URL.createObjectURL(file1);
    view.src = url;
  };
}

function showPassword6() {
  var i = document.getElementById("apassword2");
  var eye = document.getElementById("e6");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "fa fa-eye text-white";
  } else {
    i.type = "password";
    eye.className = "fa fa-eye-slash text-white";
  }
}

function signout() {

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == "success") {

              window.location = "index.php";

          } else {
            var m = document.getElementById("alertModal");
            am = new bootstrap.Modal(m);
            am.show();
            document.getElementById("alertMsg").innerHTML = t;
          }
      }
  }

  r.open("GET", "process/signoutProcess.php", true)
  r.send();

}

function updateAProfile() {
  var fname = document.getElementById("afname");
  var lname = document.getElementById("alname");
  var mobile = document.getElementById("amobile");
  var password = document.getElementById("apassword2");
  var dob = document.getElementById("adob");
  var gender = document.getElementById("agender");
  var image = document.getElementById("adminimg");

  var f = new FormData();
  f.append("fn", fname.value);
  f.append("ln", lname.value);
  f.append("m", mobile.value);
  f.append("p", password.value);
  f.append("dob", dob.value);
  f.append("g", gender.value);
  f.append("image", image.files[0]);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML =
          "Profile updated successfully";
        document
          .getElementById("alertBtn")
          .setAttribute("onclick", "window.location.reload();");
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("POST", "process/updateAProfileProcess.php", true);
  r.send(f);
}

function showPassword7() {
  var i = document.getElementById("slpassword");
  var eye = document.getElementById("e7");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "fa fa-eye text-white";
  } else {
    i.type = "password";
    eye.className = "fa fa-eye-slash text-white";
  }
}

function showPassword8() {
  var i = document.getElementById("slp1");
  var eye = document.getElementById("e8");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "fa fa-eye text-white";
  } else {
    i.type = "password";
    eye.className = "fa fa-eye-slash text-white";
  }
}

function showPassword9() {
  var i = document.getElementById("slp2");
  var eye = document.getElementById("e9");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "fa fa-eye text-white";
  } else {
    i.type = "password";
    eye.className = "fa fa-eye-slash text-white";
  }
}

function staffSignIn() {
  var email = document.getElementById("slemail");
  var password = document.getElementById("slpassword");
  var rememberme = document.getElementById("rememberme2");

  var form = new FormData();
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("r", rememberme.checked);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var t = request.responseText;
      if (t == "Success") {
        window.location = "staff/dashboard.php";
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  request.open("POST", "staff/process/sSignInProcess.php", true);
  request.send(form);
}

function forgotUPassword() {
  var email = document.getElementById("slemail");

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        var m = document.getElementById("forgotPasswordModal2");
        spm = new bootstrap.Modal(m);
        spm.show();
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("GET", "staff/process/forgotUPasswordProcess.php?e=" + email.value, true);
  r.send();
}

function resetspw() {
  var email = document.getElementById("slemail");
  var np = document.getElementById("slp1");
  var rnp = document.getElementById("slp2");
  var vcode = document.getElementById("vcode2");

  var form = new FormData();
  form.append("e", email.value);
  form.append("n", np.value);
  form.append("r", rnp.value);
  form.append("v", vcode.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        spm.hide();
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML =
          "Your password has been reset successfully";
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("POST", "staff/process/resetSPassword.php", true);
  r.send(form);
}

function updateStaffImage2() {
  var view = document.getElementById("viewStaffuImg2");
  var file = document.getElementById("staffuimg2");

  file.onchange = function () {
    var file1 = this.files[0];
    var url = window.URL.createObjectURL(file1);
    view.src = url;
  };
}

function updateStaff2() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var password = document.getElementById("pwd");
  var line1 = document.getElementById("line1");
  var dob = document.getElementById("dob");
  var line2 = document.getElementById("line2");
  var gender = document.getElementById("gender");
  var district = document.getElementById("district");
  var position = document.getElementById("position");
  var image = document.getElementById("staffuimg2");

  var f = new FormData();
  f.append("fn", fname.value);
  f.append("ln", lname.value);
  f.append("m", mobile.value);
  f.append("p", password.value);
  f.append("l1", line1.value);
  f.append("dob", dob.value);
  f.append("l2", line2.value);
  f.append("g", gender.value);
  f.append("dis", district.value);
  f.append("pos", position.value);
  f.append("image", image.files[0]);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML =
          "Staff updated successfully";
        document
          .getElementById("alertBtn")
          .setAttribute("onclick", "window.location.reload();");
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("POST", "process/updateProfileProcess.php", true);
  r.send(f);
}

function uploadProjectFiles() {
  var view = document.getElementById("proFileName");
  var file = document.getElementById("proFile");

  file.onchange = function () {
    var url = this.files[0].name;
    view.innerHTML = url;
  };
}

function showPassword10() {
  var i = document.getElementById("pwd");
  var eye = document.getElementById("e10");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "fa fa-eye text-white";
  } else {
    i.type = "password";
    eye.className = "fa fa-eye-slash text-white";
  }
}

function uploadComProject(id) {
  var comment = document.getElementById("pcomment");
  var proFile = document.getElementById("proFile");
  var pname = document.getElementById("upname2");

  var f = new FormData();
  f.append("c", comment.value);
  f.append("pid", id);
  f.append("pn", pname.value);
  f.append("file", proFile.files[0]);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        $("#uploadModal").modal("hide");
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML =
          "Project uploaded successfully";
        document
          .getElementById("alertBtn")
          .setAttribute("onclick", "window.location.reload();");
      } else {
        var m = document.getElementById("alertModal");
        am = new bootstrap.Modal(m);
        am.show();
        document.getElementById("alertMsg").innerHTML = t;
      }
    }
  };

  r.open("POST", "process/uploadComProjectProcess.php", true);
  r.send(f);
}

function usignout() {

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
      if (r.readyState == 4) {
          var t = r.responseText;
          if (t == "success") {

              window.location = "../index.php";

          } else {
            var m = document.getElementById("alertModal");
            am = new bootstrap.Modal(m);
            am.show();
            document.getElementById("alertMsg").innerHTML = t;
          }
      }
  }

  r.open("GET", "process/signoutUProcess.php", true)
  r.send();

}