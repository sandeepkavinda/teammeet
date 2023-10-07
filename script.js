function changeViewD1() {
  document.getElementById("d1").className = "d1-toggle";
  document.getElementById("d2").className = "d2";

  document.getElementById("signUpBox").classList.add("d-none");
  document.getElementById("signInBox").classList.remove("d-none");
}

function changeViewD2() {
  document.getElementById("d2").className = "d2-toggle";
  document.getElementById("d1").className = "d1";

  document.getElementById("signUpBox").classList.remove("d-none");
  document.getElementById("signInBox").classList.add("d-none");
}

function signInProcess() {
  var email = document.getElementById("loginEmail").value;
  var password = document.getElementById("loginPassword").value;
  var rememberMe = document.getElementById("rememberMe").checked;

  if (email == "") {
    alert("Please enter email");
  } else if (password == "") {
    alert("Please enter password");
  } else {
    var form = new FormData();
    form.append("email", email);
    form.append("password", password);
    form.append("rememberMe", rememberMe);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        var response = request.responseText;
        userVerification(email);
      }
    };

    request.open("POST", "signInProcess.php", true);
    request.send(form);
  }
}

var loaderModal;
var userVerificationModal;

function userVerification(email) {
  var m = document.getElementById("loaderModal");
  loaderModal = new bootstrap.Modal(m);
  loaderModal.show();

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        loaderModal.hide();

        var m = document.getElementById("userVerificationModal");
        userVerificationModal = new bootstrap.Modal(m);
        userVerificationModal.show();
      } else {
        loaderModal.hide();
        alert(response);
      }
    }
  };

  request.open("GET", "sendUserVerificationCodeProcess.php?e=" + email, true);
  request.send();
}

function signUpProcess() {
  var email = document.getElementById("signUpEmail").value;
  var firstName = document.getElementById("signUpFirstName").value;
  var lastName = document.getElementById("signUpLastName").value;
  var password = document.getElementById("signUpPassword").value;
  var rePassword = document.getElementById("signUpRePassword").value;

  if (!email) {
    alert("Please enter your Email");
  } else if (!firstName) {
    alert("Please enter your First Name");
  } else if (!lastName) {
    alert("Please enter your Last Name");
  } else if (!password) {
    alert("Please enter your Password");
  } else if (!rePassword) {
    alert("Please retype your Password");
  } else if (password != rePassword) {
    alert("Passwords Doesn't Matching");
  } else {
    var form = new FormData();
    form.append("email", email);
    form.append("firstName", firstName);
    form.append("lastName", lastName);
    form.append("password", password);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        var response = request.responseText;
        if (response == "success") {
          window.location.reload();
        } else {
          alert(response);
        }
      }
    };

    request.open("POST", "signUpProcess.php", true);
    request.send(form);
  }
}

function confirmVerificationCode(email) {
  var code = document.getElementById("code").value;

  var form = new FormData();
  form.append("email", email);
  form.append("code", code);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        window.location = "dashboard.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "confirmVerificationCodeProcess.php", true);
  request.send(form);
}

function forgotPasswordSendVerificationProcess() {
  var email = document.getElementById("loginEmail").value;

  if (email == "") {
    alert("Please Type Email");
  } else {
    var m = document.getElementById("loaderModal");
    loaderModal = new bootstrap.Modal(m);
    loaderModal.show();

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        var response = request.responseText;
        if (response == "success") {
          loaderModal.hide();
          var m = document.getElementById("forgotPasswordModal");
          userVerificationModal = new bootstrap.Modal(m);
          userVerificationModal.show();
        } else {
          loaderModal.hide();
          alert(response);
        }
      }
    };

    request.open(
      "GET",
      "forgotPasswordVerificationSendProcess.php?e=" + email,
      true
    );
    request.send();
  }
}

function forgotPasswordProcess() {
  var email = document.getElementById("loginEmail").value;
  var vcode = document.getElementById("forgotPwCode").value;
  var pw = document.getElementById("forgotPw").value;
  var rpw = document.getElementById("forgotRePw").value;

  if (email == "") {
    alert("Please Type Email");
  } else if (vcode == "") {
    alert("Please Verification Code");
  } else if (pw == "") {
    alert("Please Type a New Password");
  } else if (rpw == "") {
    alert("Please Retype New Password");
  } else {
    var form = new FormData();
    form.append("e", email);
    form.append("n", pw);
    form.append("r", rpw);
    form.append("v", vcode);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        var response = request.responseText;
        alert(response);
        if (response == "sucess") {
          window.location.reload();
        } else {
          alert(response);
        }
      }
    };

    request.open("POST", "forgotPasswordProcess.php", true);
    request.send(form);
  }
}

function listChange(row) {
  if (row == "1") {
    document.getElementById("list-1").classList.add("activeTab");
    document.getElementById("list-2").classList.remove("activeTab");
    document.getElementById("list-3").classList.remove("activeTab");
    document.getElementById("list-4").classList.remove("activeTab");

    document.getElementById("dashboard").classList = "col-12 d-block";
    document.getElementById("projects").classList = "col-12 d-none";
    document.getElementById("message").classList = "col-12 d-none";
  } else if (row == "2") {
    document.getElementById("list-1").classList.remove("activeTab");
    document.getElementById("list-2").classList.add("activeTab");
    document.getElementById("list-3").classList.remove("activeTab");
    document.getElementById("list-4").classList.remove("activeTab");

    document.getElementById("dashboard").classList = "col-12 d-none";
    document.getElementById("projects").classList = "col-12 d-block";
    document.getElementById("tasks").classList = "col-12 d-none";
    document.getElementById("message").classList = "col-12 d-none";
  } else if (row == "3") {
    document.getElementById("list-1").classList.remove("activeTab");
    document.getElementById("list-2").classList.remove("activeTab");
    document.getElementById("list-3").classList.add("activeTab");
    document.getElementById("list-4").classList.remove("activeTab");

    document.getElementById("dashboard").classList = "col-12 d-none";
    document.getElementById("projects").classList = "col-12 d-none";
    document.getElementById("tasks").classList = "col-12 d-block";
    document.getElementById("message").classList = "col-12 d-none";
  } else if (row == "4") {
    document.getElementById("list-1").classList.remove("activeTab");
    document.getElementById("list-2").classList.remove("activeTab");
    document.getElementById("list-3").classList.remove("activeTab");
    document.getElementById("list-4").classList.add("activeTab");

    document.getElementById("dashboard").classList = "col-12 d-none";
    document.getElementById("projects").classList = "col-12 d-none";
    document.getElementById("tasks").classList = "col-12 d-none";
    document.getElementById("message").classList = "col-12 d-block";
  }
}

function changeUserImage() {
  var view = document.getElementById("userProfileImageView");
  var file = document.getElementById("profileImg");

  file.onchange = function () {
    var file1 = this.files[0];
    var url = window.URL.createObjectURL(file1);
    view.style.backgroundImage = "url(" + url + ")";
  };
}

var successModal;

function userProfileUpdateProcess() {
  var fname = document.getElementById("editFirstname");
  var lname = document.getElementById("editLastname");
  var pw = document.getElementById("editPassword");
  var image = document.getElementById("profileImg");

  var form = new FormData();
  form.append("fname", fname.value);
  form.append("lname", lname.value);
  form.append("pw", pw.value);

  if (image.files.length != 0) {
    form.append("image", image.files[0]);
  }

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if ("success") {
        userVerificationModal.hide();
        var m = document.getElementById("successModal");
        successModal = new bootstrap.Modal(m);
        successModal.show();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "updateUserProfileProcess.php", true);
  r.send(form);
}

var createProjectModal;
function createProject() {
  var m = document.getElementById("createProjectModal");
  createProjectModal = new bootstrap.Modal(m);
  createProjectModal.show();
}

function highlight() {
  var searchText = document.getElementById("search-project");
  var row = document.getElementById("project-title");

  if (searchText !== "") {
    var regEx = new RegExp(searchText, "gi");
    row.innerHTML = row.textContent.replace(regEx, "<mark>$&</mark>");
  }
}

var viewProjectDetailsModal;
function viewProjectDetails() {
  var m = document.getElementById("viewProjectDetailsModal");
  viewProjectDetailsModal = new bootstrap.Modal(m);
  viewProjectDetailsModal.show();
}

function updateDateTime() {
  const now = new Date();
  const formattedDateTime = now.toLocaleString();
  document.getElementById("liveDateTime").textContent = formattedDateTime;
}

updateDateTime();
setInterval(updateDateTime, 1000);

//set box height accurately
var div1 = document.getElementById("dashboard").offsetHeight;
var div2 = document.getElementById("area-header").offsetHeight;
var boxHeight = div1 - div2;
document.getElementById("area-body").style.height = boxHeight + "px";
document.getElementById("project-body").style.height = boxHeight + "px";

var userVerificationModal;
function userProfileBox() {
  var m = document.getElementById("userProfileModal");
  userVerificationModal = new bootstrap.Modal(m);
  userVerificationModal.show();
}