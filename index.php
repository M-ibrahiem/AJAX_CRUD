<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CRUD</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <style></style>
</head>

<body>
  <div class="container mt-5">
    <h1 class="alert-info text-center mb-5 p-3">
      AJAX--PHP--JS & Bootstrap-5
    </h1>
    <div class="row">
      <form class="col-sm-5" id="myform">
        <h3 class="alert-warning text-center p-2">Add / Update Students</h3>
        <div>
          <input style="display: none" type="text" class="form-control" id="stuid" />
          <label for="nameid" class="form-label">name</label>
          <input type="text" class="form-control" id="nameid" />
        </div>
        <div>
          <label for="emailid" class="form-label">email</label>
          <input type="text" class="form-control" id="emailid" />
        </div>
        <div>
          <label for="passwordid" class="form-label">password</label>
          <input type="text" class="form-control" id="passwordid" />
        </div>
        <div class="mt-5">
          <button type="submit" class="btn btn-primary" id="btnadd">
            save
          </button>
        </div>
        <div id="msg"></div>
      </form>
      <div class="col-sm-7 text-center">
        <h3 class="alert-warning p-2">Show Student Infooo</h3>
        <table class="table table-dark table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">NAME</th>
              <th scope="col">EMAIL</th>
              <th scope="col">PASSWORD</th>
              <th scope="col">ACTION</th>
            </tr>
          </thead>
          <tbody id="tbody"></tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    var content = document.getElementById('btnadd').addEventListener('click', addstudent);

    function addstudent(e) {
      e.preventDefault(); // stop button submit  => e all event data
      var sid = document.getElementById('stuid');
      var nm = document.getElementById('nameid').value;
      var em = document.getElementById('emailid').value;
      var pw = document.getElementById('passwordid').value;

      const formData = {
        id:sid.value,
        name: nm,
        email: em,
        password: pw
      }
      // JSON.stringify() from JS to JSON  &&  JSON.parse() from JSON to JS 
      var formDataJson = JSON.stringify(formData);


      const nxhr = new XMLHttpRequest();
      nxhr.open('POST', 'insert.php', true);
      nxhr.onload = function() {
        if (nxhr.status == 200) {
          // handle response
          document.getElementById('msg')
            .innerHTML = `<div class="alert alert-success">${nxhr.responseText}</div>`; //=> alert
            sid.value =null;
            document.getElementById('myform').reset(); // => referesh to form

          ShowData();

        } else {
          console.log(nxhr);
          alert('plz try again');
        }
      }
      nxhr.send(formDataJson);
    }

    var tbody = document.getElementById('tbody');

    function ShowData() {

      tbody.innerHTML = "";
      const nxhr = new XMLHttpRequest();
      nxhr.open('GET', 'select.php', true);
      nxhr.send();
      nxhr.onload = function() {
        if (nxhr.status == 200) {
          // handle response
          $myData = JSON.parse(nxhr.responseText);

          $myData.forEach(std => {
            tbody.innerHTML += `
            <tr>
              <td>${std.id}</td>
              <td>${std.name}</td>
              <td>${std.email}</td>
              <td>${std.password}</td>
              <td>
                <button class="btn btn-outline-info"   data-flag= '${std.id}' onclick="edt_s(this)">edit</button>
                <button class="btn btn-outline-danger" data-flag= '${std.id}' onclick="del_s(this)">delete</button>
              </td>
            </tr>
          `
          });
        } else {
          console.log(nxhr);
          alert('plz try again');
        }
      }
    }
    ShowData();

    function del_s(btn) {
      var myId = btn.getAttribute('data-flag');
      var JsId = {
        id: myId
      };
      var JsonId = JSON.stringify(JsId);
      const nxhr = new XMLHttpRequest();
      nxhr.open('DELETE', 'delete.php', true);

      nxhr.send(JsonId);
      nxhr.onload = function() {
        if (nxhr.status == 200) {
          document.getElementById(
            "msg"
          ).innerHTML = `<div class="alert alert-danger"> ${nxhr.responseText}</div>`;
          ShowData();
        } else {
          alert('fail');
        }
      }
    }


    function edt_s(btn) {
      var myId = btn.getAttribute('data-flag');
      let hInput =document.getElementById('stuid')
      var nm = document.getElementById('nameid');
      var em = document.getElementById('emailid');
      var pw = document.getElementById('passwordid');
      var stdData = { id: myId};
      var stdDataJson = JSON.stringify(stdData);

      const nxhr = new XMLHttpRequest();
      nxhr.open('POST', 'edit.php', true);
      nxhr.send(stdDataJson);
      nxhr.onload = function() {
        if (nxhr.status == 200) {
          var studentData = JSON.parse(nxhr.responseText);
          hInput.style.display = "block"
          hInput.value = studentData.id;
          hInput.style.display = "none"
          nm.value =studentData.name;
          em.value =studentData.email;
          pw.value =studentData.password;
          
        }else{
          alert ("failll") 
        }
      }   
    }
  </script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/popper.min.js"></script>
</body>

</html>