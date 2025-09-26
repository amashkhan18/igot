<?php
// Check if the user is logged in by verifying the cookie
if (!isset($_COOKIE['user_id'])) {
    header("Location: ./login.html"); // Updated to point to the correct login.html file
    exit;
}

// Handle logout request
if (isset($_GET['logout'])) {
    setcookie("user_id", "", time() - 3600, "/"); // Expire the cookie
    header("Location: ./login.html?logout=1"); // Updated to point to the correct login.html file
    exit;
}

// Include database connection
require_once '../../config/database.php';

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
    <title>New Karmyogi Registrations</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
      crossorigin="anonymous"
    />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="../css/adminlte.css" as="style" />
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media='all'"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />
    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
  </head>
  <body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
      
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <a href="?logout=1" class="btn btn-danger"><i class="bi bi-box-arrow-left"></i> Logout</a>
              </a>
            </li>
            <!--end::Navbar Search-->
            
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <div class="container mt-5">

      <h1 class="text-center mb-4">New iGOT Karmyogi Registrations</h1>
      <form id="registrationForm" method="POST" action="">
      <div class="mb-3">
          <label for="employeeCode" class="form-label">Employee Code</label>
          <div class="input-group">
            <input type="text" class="form-control" id="employeeCode" name="employeeCode" placeholder="Enter employee code" required />
            <button class="btn btn-secondary" type="button" id="searchBtn">Search</button>
          </div>
          <div id="messageDiv" class="mt-2"></div>
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
            <option value="Additional Deputy Collector">Additional Deputy Collector</option>
            <option value="Administrative Officer">Administrative Officer</option>
            <option value="Amin">Amin</option>
            <option value="Amin(Contingency)">Amin(Contingency)</option>
            <option value="Ardali">Ardali</option>
            <option value="Assistant">Assistant</option>
            <option value="Assistant (Grade I)">Assistant (Grade I)</option>
            <option value="Assistant (Grade II)">Assistant (Grade II)</option>
            <option value="Assistant (Grade III)">Assistant (Grade III)</option>
            <option value="Assistant Auto Electrician(Contingency)">Assistant Auto Electrician(Contingency)</option>
            <option value="Assistant Chemist">Assistant Chemist</option>
            <option value="Assistant Draftsman">Assistant Draftsman</option>
            <option value="Assistant Draftsman (Civil)">Assistant Draftsman (Civil)</option>
            <option value="Assistant Electrician">Assistant Electrician</option>
            <option value="Assistant Electrician(Contingency)">Assistant Electrician(Contingency)</option>
            <option value="Assistant Engineer (Civil)">Assistant Engineer (Civil)</option>
            <option value="Assistant Engineer (E&M)">Assistant Engineer (E&M)</option>
            <option value="Assistant Fitter">Assistant Fitter</option>
            <option value="Assistant Fitter(Contingency)">Assistant Fitter(Contingency)</option>
            <option value="Assistant Gardener">Assistant Gardener</option>
            <option value="Assistant Geologist">Assistant Geologist</option>
            <option value="Assistant Geophysicist">Assistant Geophysicist</option>
            <option value="Assistant Irrigation Inspector">Assistant Irrigation Inspector</option>
            <option value="Assistant Mechanic(Contingency)">Assistant Mechanic(Contingency)</option>
            <option value="Assistant Programmer">Assistant Programmer</option>
            <option value="Assistant Research Officer">Assistant Research Officer</option>
            <option value="Assistant Teacher">Assistant Teacher</option>
            <option value="Assistant Turner">Assistant Turner</option>
            <option value="Black Smith(Contingency)">Black Smith(Contingency)</option>
            <option value="Black Smith-I(Contingency)">Black Smith-I(Contingency)</option>
            <option value="Black Smith-II(Contingency)">Black Smith-II(Contingency)</option>
            <option value="Camp Assistant">Camp Assistant</option>
            <option value="Camp Attendant">Camp Attendant</option>
            <option value="Caretaker">Caretaker</option>
            <option value="Carpenter">Carpenter</option>
            <option value="Carpenter(Contingency)">Carpenter(Contingency)</option>
            <option value="Chainman">Chainman</option>
            <option value="Chief Engineer (CON)">Chief Engineer (CON)</option>
            <option value="Cleaner">Cleaner</option>
            <option value="Clerk">Clerk</option>
            <option value="Compressor Attendent(Contingency)">Compressor Attendent(Contingency)</option>
            <option value="Compressor Operator(Contingency)">Compressor Operator(Contingency)</option>
            <option value="Computer Operator">Computer Operator</option>
            <option value="Conductor">Conductor</option>
            <option value="Cook">Cook</option>
            <option value="Cook(Contingency)">Cook(Contingency)</option>
            <option value="Cowler Operator(Contingency)">Cowler Operator(Contingency)</option>
            <option value="Daftary">Daftary</option>
            <option value="Dak Assistant">Dak Assistant</option>
            <option value="Dak Runner">Dak Runner</option>
            <option value="Daily Wager">Daily Wager</option>
            <option value="Data Entry Operator">Data Entry Operator</option>
            <option value="Divisional Accountant">Divisional Accountant</option>
            <option value="Divisional Accounts Officer">Divisional Accounts Officer</option>
            <option value="Draftsman">Draftsman</option>
            <option value="Draftsman A">Draftsman A</option>
            <option value="Driver">Driver</option>
            <option value="Electrician">Electrician</option>
            <option value="Electrician I">Electrician I</option>
            <option value="Electrician- II(Contingency)">Electrician- II(Contingency)</option>
            <option value="Electrician- III(Contingency)">Electrician- III(Contingency)</option>
            <option value="Embankment Inspector">Embankment Inspector</option>
            <option value="Engineer-in-Chief">Engineer-in-Chief</option>
            <option value="Executive Engineer">Executive Engineer</option>
            <option value="Executive Engineer (Civil)">Executive Engineer (Civil)</option>
            <option value="Executive Engineer (E&M)">Executive Engineer (E&M)</option>
            <option value="Farrash">Farrash</option>
            <option value="Field Assistant">Field Assistant</option>
            <option value="Fitter">Fitter</option>
            <option value="Fitter (Grade II)">Fitter (Grade II)</option>
            <option value="Fitter-I(Contingency)">Fitter-I(Contingency)</option>
            <option value="Fitter-II(Contingency)">Fitter-II(Contingency)</option>
            <option value="Fitter-III(Contingency)">Fitter-III(Contingency)</option>
            <option value="Gardener">Gardener</option>
            <option value="Gauge Checker">Gauge Checker</option>
            <option value="Gauge Reader">Gauge Reader</option>
            <option value="Guage Reader(Contingency)">Guage Reader(Contingency)</option>
            <option value="Head Draftsman (Civil)">Head Draftsman (Civil)</option>
            <option value="Helper">Helper</option>
            <option value="Helper Electrician(Contingency)">Helper Electrician(Contingency)</option>
            <option value="Helper Truck(Contingency)">Helper Truck(Contingency)</option>
            <option value="H. E. M. Operator Grade II">H. E. M. Operator Grade II</option>
            <option value="Jeep Driver">Jeep Driver</option>
            <option value="Key Punch Operator">Key Punch Operator</option>
            <option value="Khallasi">Khallasi</option>
            <option value="Khallasi(Contingency)">Khallasi(Contingency)</option>
            <option value="Laboratory Assistant">Laboratory Assistant</option>
            <option value="Lab Attendant">Lab Attendant</option>
            <option value="Lab Attendant(Contingency)">Lab Attendant(Contingency)</option>
            <option value="Lab Technician">Lab Technician</option>
            <option value="Legal Assistant">Legal Assistant</option>
            <option value="Lineman">Lineman</option>
            <option value="Line man(Contingency)">Line man(Contingency)</option>
            <option value="Mason">Mason</option>
            <option value="Mason(Contingency)">Mason(Contingency)</option>
            <option value="Mate(Contingency)">Mate(Contingency)</option>
            <option value="Mechanic (Grade II)">Mechanic (Grade II)</option>
            <option value="Mechanic II">Mechanic II</option>
            <option value="Mechanic-III(Contingency)">Mechanic-III(Contingency)</option>
            <option value="Medical Officer">Medical Officer</option>
            <option value="Mixer Operator(Contingency)">Mixer Operator(Contingency)</option>
            <option value="Muster Clerk(Contingency)">Muster Clerk(Contingency)</option>
            <option value="Non Regular">Non Regular</option>
            <option value="Office Assistant">Office Assistant</option>
            <option value="Oilman(Contingency)">Oilman(Contingency)</option>
            <option value="Operator">Operator</option>
            <option value="Painter">Painter</option>
            <option value="Peon">Peon</option>
            <option value="Personal Assistant">Personal Assistant</option>
            <option value="Physical Assistant">Physical Assistant</option>
            <option value="Pipe Line Helper(Contingency)">Pipe Line Helper(Contingency)</option>
            <option value="Plumber(Contingency)">Plumber(Contingency)</option>
            <option value="Principal">Principal</option>
            <option value="Process Server">Process Server</option>
            <option value="Programmer">Programmer</option>
            <option value="Progress man">Progress man</option>
            <option value="Pump Attendant">Pump Attendant</option>
            <option value="Pump Driver (Contingency)">Pump Driver (Contingency)</option>
            <option value="Pump Helper">Pump Helper</option>
            <option value="Pump Operator">Pump Operator</option>
            <option value="Radio Wireless Operator">Radio Wireless Operator</option>
            <option value="Reference Officer">Reference Officer</option>
            <option value="Regar Labour(Contingency)">Regar Labour(Contingency)</option>
            <option value="Research Assistant">Research Assistant</option>
            <option value="Research Officer">Research Officer</option>
            <option value="Revenue Inspector">Revenue Inspector</option>
            <option value="Security Guard">Security Guard</option>
            <option value="Security Guard(Contingency)">Security Guard(Contingency)</option>
            <option value="Senior Administrative Officer">Senior Administrative Officer</option>
            <option value="Senior Geologist">Senior Geologist</option>
            <option value="Senior Geophysicist">Senior Geophysicist</option>
            <option value="Senior Personal Assistant">Senior Personal Assistant</option>
            <option value="Site Assistant(Contingency)">Site Assistant(Contingency)</option>
            <option value="Skilled Assistant">Skilled Assistant</option>
            <option value="Skilled Helper(Contingency)">Skilled Helper(Contingency)</option>
            <option value="Skilled Worker">Skilled Worker</option>
            <option value="Staff Nurse">Staff Nurse</option>
            <option value="Steno Typist">Steno Typist</option>
            <option value="Stenographer">Stenographer</option>
            <option value="Stenographer (Grade II)">Stenographer (Grade II)</option>
            <option value="Stenographer (Grade III)">Stenographer (Grade III)</option>
            <option value="Store Assistant">Store Assistant</option>
            <option value="Store Assistant(Contingency)">Store Assistant(Contingency)</option>
            <option value="Store Attendant">Store Attendant</option>
            <option value="Store Attendent(Contingency)">Store Attendent(Contingency)</option>
            <option value="Sub-Engineer">Sub-Engineer</option>
            <option value="Superintendent (Circle Office)">Superintendent (Circle Office)</option>
            <option value="Superintending Engineer">Superintending Engineer</option>
            <option value="Superintending Engineer (Civil)">Superintending Engineer (Civil)</option>
            <option value="Supervisor">Supervisor</option>
            <option value="Supervisor(Contingency)">Supervisor(Contingency)</option>
            <option value="Sweeper">Sweeper</option>
            <option value="Sweeper(Contingency)">Sweeper(Contingency)</option>
            <option value="Telephone Attendant">Telephone Attendant</option>
            <option value="Telephone Operator">Telephone Operator</option>
            <option value="Time Keeper">Time Keeper</option>
            <option value="Tracer">Tracer</option>
            <option value="Tractor Cleaner">Tractor Cleaner</option>
            <option value="Tractor Driver">Tractor Driver</option>
            <option value="Tractor Operator">Tractor Operator</option>
            <option value="Truck Driver">Truck Driver</option>
            <option value="Tubewell Fitter(Contingency)">Tubewell Fitter(Contingency)</option>
            <option value="Tubewell Operator">Tubewell Operator</option>
            <option value="Typist">Typist</option>
            <option value="Un-skilled Helper(Contingency)">Un-skilled Helper(Contingency)</option>
            <option value="Unskilled Labour">Unskilled Labour</option>
            <option value="Upper Division Teacher">Upper Division Teacher</option>
            <option value="Vehicle Helper (Contingency)">Vehicle Helper (Contingency)</option>
            <option value="Ward Boy">Ward Boy</option>
            <option value="Washerman">Washerman</option>
            <option value="Watchman">Watchman</option>
            <option value="Watchman (Contingency)">Watchman (Contingency)</option>
            <option value="Waterman">Waterman</option>
            <option value="Welfare Inspector">Welfare Inspector</option>
            <option value="Wireman">Wireman</option>
            <option value="Wireman-I(Contingency)">Wireman-I(Contingency)</option>
            <option value="Workman">Workman</option>
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
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          
          <a href="#" class="text-decoration-none">ASDN</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->

    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- sortablejs -->
    <script
      src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
      crossorigin="anonymous"
    ></script>
    <!-- sortablejs -->
    
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const searchButton = document.getElementById('searchBtn');
        const employeeCodeInput = document.getElementById('employeeCode');
        const messageDiv = document.getElementById('messageDiv');
        const registrationForm = document.getElementById('registrationForm');

        searchButton.addEventListener('click', async () => {
          const employeeCode = employeeCodeInput.value.trim();
          
          // Clear previous messages and form data
          messageDiv.innerHTML = '';
          document.getElementById('fullName').value = '';
          document.getElementById('email').value = '';
          document.getElementById('mobile').value = '';
          document.getElementById('ddoCode').value = '';
          document.getElementById('designation').value = '';

          if (!employeeCode) {
            messageDiv.style.color = 'red';
            messageDiv.textContent = 'Please enter an Employee Code.';
            return;
          }

          try {
            const response = await fetch(`../api.php?EMP_DISPLAY_CODE=${employeeCode}`);
            if (!response.ok) {
              throw new Error('Network response was not ok.');
            }

            const data = await response.json();
            console.log('API Response:', data);

            // 1. Check for a specific error from the API
            if (data.error) {
                messageDiv.style.color = 'red';
                messageDiv.textContent = data.error; // e.g., "mobile number already exist"
                return;
            }

            // 2. Check if data is an array and contains records
            if (Array.isArray(data) && data.length > 0) {
                messageDiv.style.color = 'green';
                messageDiv.textContent = 'Employee found. Please proceed.';
                
                const employee = data[0];
                
                // Populate the form fields
                document.getElementById('fullName').value = employee.EMPLOYEE_NAME ? employee.EMPLOYEE_NAME.replace(/\s+/g, ' ').trim() : '';
                document.getElementById('email').value = employee.EMAIL || '';
                document.getElementById('mobile').value = employee.MOBILE_NO || '';
                document.getElementById('ddoCode').value = employee.DDO_DISPLAY_CODE || '';

                // Set the designation dropdown value
                const designationDropdown = document.getElementById('designation');
                const designationValue = employee.DSGN_NAME || '';
                const matchingOption = Array.from(designationDropdown.options).find(
                  option => option.value.trim().toLowerCase() === designationValue.trim().toLowerCase()
                );

                if (matchingOption) {
                    designationDropdown.value = matchingOption.value;
                } else {
                    console.warn(`DSGN_NAME "${designationValue}" does not match any option in the dropdown.`);
                    designationDropdown.value = ''; // Reset to default if no match
                }

            } 
            // 3. Handle the case where no employee was found
            else {
                messageDiv.style.color = 'red';
                messageDiv.textContent = 'Employee with this code not found.';
            }
          } catch (error) {
            console.error('Error fetching data:', error);
            messageDiv.style.color = 'red';
            messageDiv.textContent = 'An error occurred while fetching employee details.';
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
      });
    </script>
  </body>
</html>
