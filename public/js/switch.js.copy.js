function colorChange() {
  	console.log("1");
}

function white() {
  	document.body.style.backgroundColor = "red";
}
function black() {
	document.getElementById("color").style.color = "white";
  	document.body.style.backgroundColor = "black";
}

function switchDiv() {
	console.log("Hello");
	document.getElementById('btn').addEventListener('click', () => {
	  const c1 = document.getElementById('c1');
	  const c2 = document.getElementById('c2');
	  c2.appendChild(c1.firstElementChild);
	  c1.appendChild(c2.firstElementChild);
	});
}