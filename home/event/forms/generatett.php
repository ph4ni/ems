<!DOCTYPE html>
<html>
<head>
	<title>Create a Form</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style>
		body {
			padding: 50px;
		}
		.titles {
			font-weight: bold;
			text-align: center;
		}
		h1 {
			text-align: center;
		}
		.form-table th {
			width: 50%;
			text-align: left;
		}
		.form-table td {
			padding: 10px;
		}
	</style>
</head>
<body>
<?php
    	$event_id = $_GET['eventid'];
		//echo $event_id;
		$servername = "localhost";
		$username = "geon";
		$password = "geon";
		$dbname = "formsdb";
		
		$conn = new mysqli($servername, $username, $password, $dbname);

		$sql = "SELECT event_name FROM events_table WHERE event_id = $event_id";
        $result = $conn->query($sql);
		$row = $result->fetch_assoc();
        $eventname = $row["event_name"];
	?>
	<div class="container">
		<h1>Create Form for <?php echo $eventname; ?></h1>
		<hr class="hr" />
		<form method="post" action="generatenew.php?event_id=<?php echo $event_id; ?>">
			<label class="titles">Form Information:</label>
			<div class="form-group">
				<label for="form_name">Form Name:</label>
				<input type="text" class="form-control" id="form_name" name="form_name" required>
			</div>
			<div class="form-group">
				<label for="form_description">Form Description:</label>
				<textarea class="form-control" id="form_description" name="form_description"></textarea>
			</div>
			<div class="form-group">
				<hr class="hr" />
				<label class="titles" for="form_fields">Form Fields:</label>
				<hr class="hr" />
				<table class="form-table">
					<thead>
						<tr>
							<th>Field Name</th>
							<th>Field Type</th>
						</tr>
					</thead>
					<tbody id="form_fields">
						<tr class="form-field">
							<td>
								<input type="text" class="form-control" name="field_name[]" required>
							</td>
							<td>
								<select class="form-control" name="field_type[]" required>
									<option value="">-- Select --</option>
									<option value="text">Text</option>
									<option value="number">Number</option>
									<option value="date">Date</option>
								</select>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2">
								<button type="button" class="btn btn-primary" onclick="addField()">Add Field</button>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<input type="submit" class="btn btn-success" value="Generate Form">
		</form>
	</div>

	<script>
  var fieldCounter = 1;
  function addField() {
    fieldCounter++;
    var newFieldRow = document.createElement("tr");
    var newFieldNameCol = document.createElement("td");
    var newFieldNameLabel = document.createElement("label");
    newFieldNameLabel.setAttribute("for", "field" + fieldCounter + "_name");
    newFieldNameLabel.innerText = "Field Name:";
    newFieldNameCol.appendChild(newFieldNameLabel);
    var newFieldNameInput = document.createElement("input");
    newFieldNameInput.setAttribute("type", "text");
    newFieldNameInput.setAttribute("class", "form-control");
    newFieldNameInput.setAttribute("id", "field" + fieldCounter + "_name");
    newFieldNameInput.setAttribute("name", "field_name[]");
    newFieldNameInput.setAttribute("required", "");
    newFieldNameCol.appendChild(newFieldNameInput);
    newFieldRow.appendChild(newFieldNameCol);
    var newFieldTypeCol = document.createElement("td");
    var newFieldTypeLabel = document.createElement("label");
    newFieldTypeLabel.setAttribute("for", "field" + fieldCounter + "_type");
    newFieldTypeLabel.innerText = "Field Type:";
    newFieldTypeCol.appendChild(newFieldTypeLabel);
    var newFieldTypeSelect = document.createElement("select");
    newFieldTypeSelect.setAttribute("class", "form-control");
    newFieldTypeSelect.setAttribute("id", "field" + fieldCounter + "_type");
    newFieldTypeSelect.setAttribute("name", "field_type[]");
    newFieldTypeSelect.setAttribute("required", "");
    var newFieldTypeOption1 = document.createElement("option");
    newFieldTypeOption1.setAttribute("value", "");
    newFieldTypeOption1.innerText = "-- Select --";
    newFieldTypeSelect.appendChild(newFieldTypeOption1);
    var newFieldTypeOption2 = document.createElement("option");
    newFieldTypeOption2.setAttribute("value", "text");
    newFieldTypeOption2.innerText = "Text";
    newFieldTypeSelect.appendChild(newFieldTypeOption2);
    var newFieldTypeOption3 = document.createElement("option");
    newFieldTypeOption3.setAttribute("value", "number");
    newFieldTypeOption3.innerText = "Number";
    newFieldTypeSelect.appendChild(newFieldTypeOption3);
    var newFieldTypeOption4 = document.createElement("option");
    newFieldTypeOption4.setAttribute("value", "date");
    newFieldTypeOption4.innerText = "Date";
    newFieldTypeSelect.appendChild(newFieldTypeOption4);
    newFieldTypeCol.appendChild(newFieldTypeSelect);
    newFieldRow.appendChild(newFieldTypeCol);
    var formFieldsTable = document.getElementById("form_fields_table");
    formFieldsTable.insertBefore(newFieldRow, formFieldsTable.lastChild);
}/**
  function addField() {
    fieldCounter++;
    var table = document.getElementById("form_fields");
    var row = table.insertRow(-1);
    var fieldNameCell = row.insertCell(0);
    var fieldTypeCell = row.insertCell(1);
    fieldNameCell.innerHTML = '<label for="field' + fieldCounter + '_name">Field Name:</label>' +
                              '<input type="text" class="form-control" id="field' + fieldCounter + '_name" name="field_name[]" required>';
    fieldTypeCell.innerHTML = '<label for="field' + fieldCounter + '_type">Field Type:</label>' +
                              '<select class="form-control" id="field' + fieldCounter + '_type" name="field_type[]" required>' +
                              '<option value="">-- Select --</option>' +
                              '<option value="text">Text</option>' +
                              '<option value="number">Number</option>' +
                              '<option value="date">Date</option>' +
                              '</select>';

    // update the "Add Field" button to be in the last row
    var lastRow = table.rows[table.rows.length - 1];
    var addButtonCell = lastRow.insertCell(-1);
    addButtonCell.colSpan = 2; // span the button cell across both columns
    addButtonCell.innerHTML = '<button type="button" class="btn btn-primary" onclick="addField()">Add Field</button>';
  }*/
</script>
</body>
</html>
