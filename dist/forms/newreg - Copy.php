<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeCode = $_POST['employeeCode'] ?? null;
    $fullName = $_POST['fullName'] ?? null;
    $email = $_POST['email'] ?? null;
    $mobile = $_POST['mobile'] ?? null;
    $designation = $_POST['designation'] ?? null;
    $group = $_POST['group'] ?? null;
    $ddoCode = $_POST['ddoCode'] ?? null;

    if ($fullName && $email && $mobile && $designation && $group && $ddoCode) {
        $stmt = $conn->prepare("INSERT INTO registrations (employee_code, full_name, email, mobile, designation, group_name, ddo_code) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $employeeCode, $fullName, $email, $mobile, $designation, $group, $ddoCode);

        if ($stmt->execute()) {
            echo "Registration successful.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "All fields are required.";
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Karmyogi Registration</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="container mt-5">
      <h1 class="text-center mb-4">New Karmyogi Registration</h1>
      <form id="registrationForm" method="POST" action="">
      <div class="mb-3">
          <label for="employeeCode" class="form-label">Employee Code</label>
          <div class="input-group">
            <input type="text" class="form-control" id="employeeCode" name="employeeCode" placeholder="Enter employee code" required />
            <button class="btn btn-secondary" type="button">Search</button>
          </div>
        </div>
        <div class="mb-3">
          <label for="fullName" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter full name" required />
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required />
        </div>
        <div class="mb-3">
          <label for="mobile" class="form-label">Mobile Number</label>
          <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile number" required />
        </div>
        <div class="mb-3">
          <label for="designation" class="form-label">Designation</label>
          <select class="form-select" id="designation" name="designation" required>
            <option selected disabled value="">Choose Designation</option>
            <option value="Account Officer">Account Officer</option>
            <option value="Accounting Officer">Accounting Officer</option>
            <option value="Administrative Officer">Administrative Officer</option>
            <option value="Amin">Amin</option>
            <option value="Amin(Contingency)">Amin(Contingency)</option>
            <option value="Ardali">Ardali</option>
            <option value="Assistant">Assistant</option>
            <option value="Assistant Auto Electrician(Contingency)">Assistant Auto Electrician(Contingency)</option>
            <option value="Assistant Draftsfman (Civil)">Assistant Draftsfman (Civil)</option>
            <option value="Assistant Draftsman(E/M)">Assistant Draftsman(E/M)</option>
            <option value="Assistant Electrician">Assistant Electrician</option>
            <option value="Assistant Electrician(Contingency)">Assistant Electrician(Contingency)</option>
            <option value="Assistant Engineer (E/M)">Assistant Engineer (E/M)</option>
            <option value="Assistant Engineer Civil">Assistant Engineer Civil</option>
            <option value="Assistant Fitter">Assistant Fitter</option>
            <option value="Assistant Fitter(Contingency)">Assistant Fitter(Contingency)</option>
            <option value="Assistant Gardener">Assistant Gardener</option>
            <option value="Assistant Geo-chemist">Assistant Geo-chemist</option>
            <option value="Assistant Geo-Hydrologist">Assistant Geo-Hydrologist</option>
            <option value="Assistant Geo-physics">Assistant Geo-physics</option>
            <option value="Assistant Grade I">Assistant Grade I</option>
            <option value="Assistant Grade II">Assistant Grade II</option>
            <option value="Assistant Grade III">Assistant Grade III</option>
            <option value="Assistant Mechanic(Contingency)">Assistant Mechanic(Contingency)</option>
            <option value="Assistant Programmer">Assistant Programmer</option>
            <option value="Assistant Research Officer">Assistant Research Officer</option>
            <option value="Assistant Teacher">Assistant Teacher</option>
            <option value="Assistant Tubewell Mechanic(Contingency)">Assistant Tubewell Mechanic(Contingency)</option>
            <option value="Assistant Turner(Contingency)">Assistant Turner(Contingency)</option>
            <option value="Attendent">Attendent</option>
            <option value="Black Smith-I(Contingency)">Black Smith-I(Contingency)</option>
            <option value="Black Smith-II(Contingency)">Black Smith-II(Contingency)</option>
            <option value="Black Smith(Contingency)">Black Smith(Contingency)</option>
            <option value="Camp Assistant(Contingency)">Camp Assistant(Contingency)</option>
            <option value="Camp Attendent(Contingency)">Camp Attendent(Contingency)</option>
            <option value="Canal Deputy Collector">Canal Deputy Collector</option>
            <option value="Care Taker">Care Taker</option>
            <option value="Care Taker(Contingency)">Care Taker(Contingency)</option>
            <option value="Carpenter">Carpenter</option>
            <option value="Carpenter(Contingency)">Carpenter(Contingency)</option>
            <option value="Chainman">Chainman</option>
            <option value="Chief Engineer (Civil)">Chief Engineer (Civil)</option>
            <option value="Cleaner">Cleaner</option>
            <option value="Cleaner (Contingency)">Cleaner (Contingency)</option>
            <option value="Clerk">Clerk</option>
            <option value="Compressor Attendent(Contingency)">Compressor Attendent(Contingency)</option>
            <option value="Compressor Operator(Contingency)">Compressor Operator(Contingency)</option>
            <option value="Computer Operator">Computer Operator</option>
            <option value="Conductor(Contingency)">Conductor(Contingency)</option>
            <option value="Cook">Cook</option>
            <option value="Cook(Contingency)">Cook(Contingency)</option>
            <option value="Copyist">Copyist</option>
            <option value="Cowler Operator(Contingency)">Cowler Operator(Contingency)</option>
            <option value="Crowl Tractor Operator">Crowl Tractor Operator</option>
            <option value="Daftari">Daftari</option>
            <option value="Daily Wages">Daily Wages</option>
            <option value="Dak Runner">Dak Runner</option>
            <option value="Dak Runner(Contingency)">Dak Runner(Contingency)</option>
            <option value="Data Assistant">Data Assistant</option>
            <option value="Data Entry Operator">Data Entry Operator</option>
            <option value="Divisional Account Officer">Divisional Account Officer</option>
            <option value="Divisional Accountant">Divisional Accountant</option>
            <option value="Draftsman">Draftsman</option>
            <option value="Draftsman (EandM)">Draftsman (EandM)</option>
            <option value="Draftsmen Civil">Draftsmen Civil</option>
            <option value="Driller-III(Contingency)">Driller-III(Contingency)</option>
            <option value="Driver">Driver</option>
            <option value="Driver (Contingency Paid)">Driver (Contingency Paid)</option>
            <option value="Electrician">Electrician</option>
            <option value="Electrician- I(Contingency)">Electrician- I(Contingency)</option>
            <option value="Electrician- II(Contingency)">Electrician- II(Contingency)</option>
            <option value="Electrician- III(Contingency)">Electrician- III(Contingency)</option>
            <option value="Embankment Inspector">Embankment Inspector</option>
            <option value="Enbankment Inspector">Enbankment Inspector</option>
            <option value="Engineer-in-Chief">Engineer-in-Chief</option>
            <option value="Excavator Operator(Contingency)">Excavator Operator(Contingency)</option>
            <option value="Executive Engineer">Executive Engineer</option>
            <option value="Executive Engineer ( E/M)">Executive Engineer ( E/M)</option>
            <option value="Executive Engineer(Civil)">Executive Engineer(Civil)</option>
            <option value="Farrash">Farrash</option>
            <option value="Field Assistant">Field Assistant</option>
            <option value="Fitter">Fitter</option>
            <option value="Fitter Grade-II">Fitter Grade-II</option>
            <option value="Fitter-I(Contingency)">Fitter-I(Contingency)</option>
            <option value="Fitter-II(Contingency)">Fitter-II(Contingency)</option>
            <option value="Fitter-III(Contingency)">Fitter-III(Contingency)</option>
            <option value="Fitter(Contingency)">Fitter(Contingency)</option>
            <option value="Gangmen">Gangmen</option>
            <option value="Gardener">Gardener</option>
            <option value="Gardener(Contingency)">Gardener(Contingency)</option>
            <option value="Gauge Helper">Gauge Helper</option>
            <option value="Gauge Reader">Gauge Reader</option>
            <option value="Generator Operator">Generator Operator</option>
            <option value="Generator Operator(Contingency)">Generator Operator(Contingency)</option>
            <option value="Geo-Chemist Assistant">Geo-Chemist Assistant</option>
            <option value="Geo-physical Assistant">Geo-physical Assistant</option>
            <option value="Geological Assistant">Geological Assistant</option>
            <option value="Guage Reader(Contingency)">Guage Reader(Contingency)</option>
            <option value="H. E. M. Operator Grade-II">H. E. M. Operator Grade-II</option>
            <option value="Head Draftsman (Civil)">Head Draftsman (Civil)</option>
            <option value="Helper">Helper</option>
            <option value="Helper Electrician(Contingency)">Helper Electrician(Contingency)</option>
            <option value="Helper Truck(Contingency)">Helper Truck(Contingency)</option>
            <option value="Helper(Contingency)">Helper(Contingency)</option>
            <option value="Irrigation Inspector">Irrigation Inspector</option>
            <option value="Jeep Driver">Jeep Driver</option>
            <option value="Key Punch Operator">Key Punch Operator</option>
            <option value="Khallasi">Khallasi</option>
            <option value="Khallasi(Contingency)">Khallasi(Contingency)</option>
            <option value="Khansama">Khansama</option>
            <option value="Lab Assistant">Lab Assistant</option>
            <option value="Lab Attendant">Lab Attendant</option>
            <option value="Lab Attendant(Contingency)">Lab Attendant(Contingency)</option>
            <option value="Lab technician">Lab technician</option>
            <option value="Laboratory Assistant">Laboratory Assistant</option>
            <option value="Labour">Labour</option>
            <option value="Labour Welfare Inspector">Labour Welfare Inspector</option>
            <option value="Line man(Contingency)">Line man(Contingency)</option>
            <option value="Lineman">Lineman</option>
            <option value="Mason(Contingency)">Mason(Contingency)</option>
            <option value="Mate(Contingency)">Mate(Contingency)</option>
            <option value="Mechanic Grade-II">Mechanic Grade-II</option>
            <option value="Mechanic-II(Contingency)">Mechanic-II(Contingency)</option>
            <option value="Mechanic-III(Contingency)">Mechanic-III(Contingency)</option>
            <option value="Medical Officer">Medical Officer</option>
            <option value="Messan">Messan</option>
            <option value="Mixer Operator(Contingency)">Mixer Operator(Contingency)</option>
            <option value="Muster Clerk(Contingency)">Muster Clerk(Contingency)</option>
            <option value="Non Regular Others">Non Regular Others</option>
            <option value="Office Assistant">Office Assistant</option>
            <option value="Oilman(Contingency)">Oilman(Contingency)</option>
            <option value="Operator">Operator</option>
            <option value="Painter">Painter</option>
            <option value="Peon">Peon</option>
            <option value="Personal Assistant">Personal Assistant</option>
            <option value="Photocopier">Photocopier</option>
            <option value="PhotoCopiyer">PhotoCopiyer</option>
            <option value="Pipe Line Helper(Contingency)">Pipe Line Helper(Contingency)</option>
            <option value="Plumber(Contingency)">Plumber(Contingency)</option>
            <option value="Principal">Principal</option>
            <option value="Process Server">Process Server</option>
            <option value="Programmer">Programmer</option>
            <option value="Progress man">Progress man</option>
            <option value="Progress man(Contingency)">Progress man(Contingency)</option>
            <option value="Pump Helper">Pump Helper</option>
            <option value="Pump Attendant">Pump Attendant</option>
            <option value="Pump Attendent(Contingency)">Pump Attendent(Contingency)</option>
            <option value="Pump Driver (Contingency)">Pump Driver (Contingency)</option>
            <option value="Pump Operator">Pump Operator</option>
            <option value="Pump Operator(Contingency)">Pump Operator(Contingency)</option>
            <option value="Reference clerk">Reference clerk</option>
            <option value="Regar Labour(Contingency)">Regar Labour(Contingency)</option>
            <option value="Research Assistant">Research Assistant</option>
            <option value="Research Officer Executive Officer">Research Officer Executive Officer</option>
            <option value="Revenue Inspector">Revenue Inspector</option>
            <option value="Security Guard">Security Guard</option>
            <option value="Security Guard(Contingency)">Security Guard(Contingency)</option>
            <option value="Semi Skilled Worker">Semi Skilled Worker</option>
            <option value="Senior Administrative Officer">Senior Administrative Officer</option>
            <option value="Senior Geo-Physicist">Senior Geo-Physicist</option>
            <option value="Senior Geologist">Senior Geologist</option>
            <option value="Senior Personal Assistant">Senior Personal Assistant</option>
            <option value="Site Assistant(Contingency)">Site Assistant(Contingency)</option>
            <option value="Skilled Helper(Contingency)">Skilled Helper(Contingency)</option>
            <option value="Staff Nurse">Staff Nurse</option>
            <option value="Steno Typist">Steno Typist</option>
            <option value="Stenographer">Stenographer</option>
            <option value="Stenographer Grade II">Stenographer Grade II</option>
            <option value="Stenographer Grade III">Stenographer Grade III</option>
            <option value="Store Assistant">Store Assistant</option>
            <option value="Store Assistant(Contingency)">Store Assistant(Contingency)</option>
            <option value="Store Attendant">Store Attendant</option>
            <option value="Store Attendent(Contingency)">Store Attendent(Contingency)</option>
            <option value="Sub Engineer">Sub Engineer</option>
            <option value="Sub-Engineer (Civil)">Sub-Engineer (Civil)</option>
            <option value="Sub-Engineer (E/M)">Sub-Engineer (E/M)</option>
            <option value="Subordinate Worker">Subordinate Worker</option>
            <option value="Superintendent Circle Office">Superintendent Circle Office</option>
            <option value="Superintending Engineer">Superintending Engineer</option>
            <option value="Superintending Engineer (Civil)">Superintending Engineer (Civil)</option>
            <option value="Supervisor">Supervisor</option>
            <option value="Supervisor(Contingency)">Supervisor(Contingency)</option>
            <option value="Suprintending Engineer (E/M)">Suprintending Engineer (E/M)</option>
            <option value="Sweeper">Sweeper</option>
            <option value="Sweeper(Contingency)">Sweeper(Contingency)</option>
            <option value="Telephone Attendant">Telephone Attendant</option>
            <option value="Telephone Operator">Telephone Operator</option>
            <option value="Telephone Operator(Contingency)">Telephone Operator(Contingency)</option>
            <option value="Time Keeper">Time Keeper</option>
            <option value="Time Keeper Contingency">Time Keeper Contingency</option>
            <option value="Tracer">Tracer</option>
            <option value="Tractor Cleaner">Tractor Cleaner</option>
            <option value="Tractor Driver(Contingency)">Tractor Driver(Contingency)</option>
            <option value="Truck Driver">Truck Driver</option>
            <option value="Truck Helper">Truck Helper</option>
            <option value="Tubewell Fitter(Contingency)">Tubewell Fitter(Contingency)</option>
            <option value="Tubewell Operator(Contingency)">Tubewell Operator(Contingency)</option>
            <option value="Typist">Typist</option>
            <option value="Un-Skilled Assistant">Un-Skilled Assistant</option>
            <option value="Un-skilled Helper(Contingency)">Un-skilled Helper(Contingency)</option>
            <option value="Unskilled Helper">Unskilled Helper</option>
            <option value="Upper Division Teacher">Upper Division Teacher</option>
            <option value="Vehicle Helper (Contingency)">Vehicle Helper (Contingency)</option>
            <option value="Ward Boy">Ward Boy</option>
            <option value="Washer Men">Washer Men</option>
            <option value="Washerman">Washerman</option>
            <option value="Watchman">Watchman</option>
            <option value="Watchman (Contingency)">Watchman (Contingency)</option>
            <option value="Water Man">Water Man</option>
            <option value="Waterman(Contingency)">Waterman(Contingency)</option>
            <option value="Wireless Operator">Wireless Operator</option>
            <option value="Wireman">Wireman</option>
            <option value="Wireman-I(Contingency)">Wireman-I(Contingency)</option>
            <option value="Wireman-II(Contingency)">Wireman-II(Contingency)</option>
            <option value="Work Charge">Work Charge</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="group" class="form-label">Group</label>
          <select class="form-select" id="group" name="group" required>
            <option selected disabled value="">Choose Group</option>
            <option>Group A</option>
            <option>Group B</option>
            <option>Group C</option>
            <option>Group D</option>
            <option>Contractual Staff</option>
          </select>
        </div>
        
        <div class="mb-3">
          <label for="ddoCode" class="form-label">DDO Code</label>
          <input type="text" class="form-control" id="ddoCode" name="ddoCode" placeholder="Enter DDO code" required />
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
      </form>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <script>
      document.querySelector('.btn-secondary').addEventListener('click', async () => {
        const employeeCode = document.getElementById('employeeCode').value.trim();
        if (!employeeCode) {
          alert('Please enter an employee code.');
          return;
        }

        try {
          const response = await fetch(`/karmyogi/dist/api.php?EMP_DISPLAY_CODE=${employeeCode}`);
          if (!response.ok) {
            throw new Error('Failed to fetch employee details.');
          }

          const data = await response.json();
          console.log('API Response:', data); // Log the full API response

          if (data && data.length > 0) {
            const employee = data[0]; // Access the first object in the array

            // Check if keys exist in the response and log missing keys
            if (!employee.EMPLOYEE_NAME) console.warn('EMPLOYEE_NAME is missing in the API response');
            if (!employee.EMAIL) console.warn('EMAIL is missing in the API response');
            if (!employee.MOBILE_NO) console.warn('MOBILE_NO is missing in the API response');
            if (!employee.DDO_DISPLAY_CODE) console.warn('DDO_DISPLAY_CODE is missing in the API response');
            if (!employee.DSGN_NAME) console.warn('DSGN_NAME is missing in the API response');

            // Populate fields only if the keys exist
            document.getElementById('fullName').value = employee.EMPLOYEE_NAME || '';
            document.getElementById('email').value = employee.EMAIL || '';
            document.getElementById('mobile').value = employee.MOBILE_NO || '';
            document.getElementById('ddoCode').value = employee.DDO_DISPLAY_CODE || '';

            // Set the designation dropdown value
            const designationDropdown = document.getElementById('designation');
            const designationValue = employee.DSGN_NAME || '';
            const matchingOption = Array.from(designationDropdown.options).find(
              option => option.value === designationValue
            );

            if (matchingOption) {
              designationDropdown.value = designationValue;
            } else {
              console.warn(`DSGN_NAME "${designationValue}" does not match any option in the dropdown.`);
              designationDropdown.value = ''; // Reset to default if no match
            }
          } else {
            alert('No data found for the provided employee code.');
          }
        } catch (error) {
          console.error('Error fetching employee details:', error);
          alert('An error occurred while fetching employee details.');
        }
      });

      // Toggle 'required' attribute for employeeCode based on group selection
      document.getElementById('group').addEventListener('change', (event) => {
        const group = event.target.value;
        const employeeCodeField = document.getElementById('employeeCode');
        if (group === 'Contractual Staff') {
          employeeCodeField.removeAttribute('required');
        } else {
          employeeCodeField.setAttribute('required', 'required');
        }
      });

      document.getElementById('registrationForm').addEventListener('submit', (event) => {
        const fullName = document.getElementById('fullName').value.trim();
        const mobile = document.getElementById('mobile').value.trim();
        const email = document.getElementById('email').value.trim();
        const employeeCode = document.getElementById('employeeCode').value.trim();
        const group = document.getElementById('group').value;

        const nameRegex = /^[a-zA-Z\s]+$/; // Only letters and spaces allowed
        const mobileRegex = /^[6-9]\d{9}$/; // Indian mobile number format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email format

        // Validate full name
        if (!nameRegex.test(fullName)) {
          alert('Full Name must not contain numbers, special characters, or extra spaces.');
          event.preventDefault(); // Prevent form submission
          return;
        }

        if (/\s{2,}/.test(fullName)) {
          alert('Full Name must not contain consecutive spaces.');
          event.preventDefault(); // Prevent form submission
          return;
        }

        // Validate mobile number
        if (!mobileRegex.test(mobile)) {
          alert('Mobile Number must be a valid 10-digit number starting with 6-9.');
          event.preventDefault(); // Prevent form submission
          return;
        }

        // Validate email
        if (!emailRegex.test(email)) {
          alert('Email must be in a valid format (e.g., example@domain.com).');
          event.preventDefault(); // Prevent form submission
          return;
        }

        // Skip employee code validation if group is "Contractual Staff"
        if (group !== "Contractual Staff" && !employeeCode) {
          alert('Employee Code is mandatory unless the group is "Contractual Staff".');
          event.preventDefault(); // Prevent form submission
          return;
        }

        // If all validations pass, allow form submission
      });
    </script>
  </body>
</html>
