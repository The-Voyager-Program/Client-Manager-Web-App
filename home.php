<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	include "sidebar.php"
	?>

	<div class="main">

		<h1> THIS PAGE IS FOR TESTING, WILL REMOVE LATER </h1>

	  <table>
	  </table>
	</div>
	

</body>

<script>
	let clients = [
  { Name: "John Grey", Age: 58, Address: "404 Not Found Ave." },
  { Name: "Mike Freeman", Age: 54, Address: "302 Test Street" },
  { Name: "Taylor Scali", Age: 20, Address: "32 Brexton Bvd." },
  { Name: "Paul Dillard", Age: 92, Address: "3322 Stat St." },
  { Name: "Nicholas Bogard", Age: 38, Address: "32 Plum Cv." }
];

function generateTableHead(table, data) {
  let thead = table.createTHead();
  let row = thead.insertRow();
  for (let key of data) {
    let th = document.createElement("th");
    let text = document.createTextNode(key);
    th.appendChild(text);
    row.appendChild(th);
  }
}

function generateTable(table, data) {
  for (let element of data) {
    let row = table.insertRow();
    for (key in element) {
      let cell = row.insertCell();
      let text = document.createTextNode(element[key]);
      cell.appendChild(text);
    }
  }
}

let table = document.querySelector("table");
let data = Object.keys(clients[0]);
generateTableHead(table, data);
generateTable(table, clients);
</script>

</html>