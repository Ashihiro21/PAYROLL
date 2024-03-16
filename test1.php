<<<<<<< HEAD
<form id="myForm">
    <label for="selectOption" id="select_label">Please choose an option:</label>
    <select id="selectOption" aria-labelledby="select_label">
        <option value="">Select...</option>
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
    </select>
    <input type="submit" value="Submit">
</form>

<script>
    const form = document.getElementById('myForm');
const selectOption = document.getElementById('selectOption');

// On form submit
form.addEventListener('submit', function(e){
    e.preventDefault();
    let selectedValue = selectOption.value;

    // Save selectedValue to localStorage
    localStorage.setItem(selectedValue, 'disabled');
    // Disable option
    disableOption(selectedValue);
});

// Disable previously selected options
for (let i = 0; i < localStorage.length; i++){
    let selectedValue = localStorage.key(i);
    disableOption(selectedValue);
}

function disableOption(val) {
    let option = document.querySelector(`option[value="${val}"]`);
    if (option) {
        option.disabled = true;
    }
}
</script>
=======
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bootstrap Accordion</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
  .card-body {
    transition: max-height 0.3s ease-in-out;
    max-height: 0;
    overflow: hidden;
  }

  .card-body.show {
    max-height: 500px; /* Set to the maximum expected height of the content */
  }
</style>
</head>
<body>

<div class="container mt-4">
  <div id="accordion">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Section 1
          </button>
        </h5>
      </div>

<<<<<<< HEAD
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body show">
          <p>Content for section 1 goes here.</p>
          <ul class="list-group">
            <li class="list-group-item"><a href="#" onclick="showSection('section2')">Link to Section 2</a></li>
            <li class="list-group-item"><a href="#" onclick="showSection('section3')">Link to Section 3</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div id="section2" style="display: none;">
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Section 2
            </button>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body">
            Content for section 2 goes here.
          </div>
        </div>
      </div>
    </div>
    <div id="section3" style="display: none;">
      <div class="card">
        <div class="card-header" id="headingThree">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Section 3
            </button>
          </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
          <div class="card-body">
            Content for section 3 goes here.
          </div>
        </div>
      </div>
    </div>
  </div>
=======
// SQL query for inner join
$sql = "SELECT * FROM attendance INNER JOIN employee ON employee.Employee_No = attendance.Employee_No WHERE Employee_No";
>>>>>>> 2627c90f430234439532f2c9d69dbf8af5808a5f

  <!-- Link outside of the accordion -->
  <div class="mt-4">
    <a href="#" onclick="showSection('section2')">Link to Section 2</a>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  function showSection(sectionId) {
    // Hide all sections
    document.querySelectorAll('.card-body').forEach(function(section) {
      section.classList.remove('show');
    });
    
    // Show the selected section
    document.getElementById(sectionId).querySelector('.card-body').classList.add('show');
  }
</script>

</body>
</html>
>>>>>>> 3586037cb719417189090b7f73ba7d5247d6b7db
