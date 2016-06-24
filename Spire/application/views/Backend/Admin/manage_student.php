<body>
    <div class="w3-row">
  <a href="#" onclick="openCity(event, 'London');">
    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Register Student</div>
  </a>
  <a href="#" onclick="openCity(event, 'Paris');">
    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Manage Student</div>
  </a>
  <a href="#" onclick="openCity(event, 'Tokyo');">
    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">View Attendance</div>
  </a>
</div>

<div id="London" class="w3-container city">
    <form method="POST" action="">
        <table class="table table-striped table-hover" style="width: 600px; font-size: 11px; margin-left: 50px; margin-top: 60px;">
          <tr>
            <th>Firstname</th><td><input type="text" name="fname"></td><th>Surname</th><td><input type="text" name="sname"></td
          </tr>
          <tr>
            <th>Gender</th><th><select name="gender"><option value="">--Select--</option><option value="Male">Male</option><option value="Female">Female</option></select></th>
            <th>Section</th>
            <td>
              <select name="section">
                <option>---Select---</option>
                <option value="Play-Group">Play Group</option>
                <option value="Nursery">Nursery</option>
                <option value="Primary">Primary</option>
                <option value="Junior">Junior Secondary</option>
                <option value="Senior">Senior Secondary</option>
              </select>
            </td>
          </tr>
          <tr>
            <th>Date Of Birth</th><td><input type="date" name="dob"></td><th>Nationality</th><td><input type="text" name="nation"></td>
          </tr>
          <tr>
            <th>Place Of Birth</th><td><input type="text" name="pob"></td><th>Religion</th><td><input type="text" name="religion"></td>
          </tr>
          <tr>
            <th>Proposed Month of Entry</th><td><input type="text" name="month"></td><th>Entry Level</th>
            <td>
              
            </td>
          </tr>
          <tr>
            <th>Last School Attended</th><td><input type="text" name="previous_school"></td>
          </tr>
          <tr>
            <th>Name Of Father</th><td><input type="text" name="father"></td><th>Occupation</th><td><input type="text" name="father_work"></td>
          </tr>
          <tr>
            <th>Office</th><td><input type="text" name="father_office"></td><th>Email</th><td><input type="text" name="father_email"></td>
          </tr>
          <tr>
            <th>Home Address</th><td><input type="text" name="father_home"></td>
          </tr>
          <tr>
            <th>Name Of Mother</th><td><input type="text" name="mother"></td><th>Occupation</th><td><input type="text" name="mother_work"></td>
          </tr>
          <tr>
            <th>Office</th><td><input type="text" name="mother_office"></td><th>Email</th><td><input type="text" name="mother_email"></td>
          </tr>
          <tr>
            <th>Home Address</th><td><input type="text" name="mother_home"></td>
          </tr>
          <tr>
            <th>Who Will Pay School Fees & Other Expenses </th><td><select name="payer"><option value="">--Select--</option><option value="Father">Father</option><option value="Mother">Mother</option></select></td>
          </tr>

          <tr>
            <th>One Close Contact (Near The School) Name</th><td><input type="text" name="name_contact"></td><th>Address</th><td><input type="text" name="contact_address"></td>
          </tr>
          <tr>
            <th></th><td><input type="submit" name="submit" value="Register"></td>
          </tr>
        </table>
    </form>
</div>

<div id="Paris" class="w3-container city">
  <h2>Paris</h2>
  <p>Paris is the capital of France.</p> 
</div>

<div id="Tokyo" class="w3-container city">
  <h2>Tokyo</h2>
  <p>Tokyo is the capital of Japan.</p>
</div>

<script>
openCity(event, "London");
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-red";
}
</script>
</body>