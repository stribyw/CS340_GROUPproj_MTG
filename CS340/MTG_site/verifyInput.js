
// The event handler function to compute the total cost
//function to determine if a field is blank
// var pswd;

// function checkPswds(){

// 	pswd1 = document.getElementById('pass1');
// 	pswd2 = document.getElementById('pass2');
// 	var  re = /[0-9]/;
//     if( ! re.test(pswd1.value)) {
// 		alert("Password must contain at least one digit");
// 		return false;
//     }
// 	re = /[A-Z]/;
//     if( ! re.test(pswd1.value)) {
// 		alert("Password must contain at least one uppercase letter");
// 		return false;
//     }
// 	re = /[a-z]/;
//     if( ! re.test(pswd1.value)) {
// 		alert("Password must contain at least one lowercase letter");
// 		return false;
//     }
// 	if( pswd1.value.length < 6) {
// 		alert("Password must have at least 6 characters");
// 		return false;
//     }
// 	if (pswd1.value == pswd2.value) {
// 		alert("Good Passwords");
// 		return true;
// 	} else {
// 		alert("Passwords don't match");
// 		return false;
// 	}

// }

function isBlank(inputField){
	if(inputField.type=="checkbox"){
		if(inputField.checked)
			return false;
		return true;
	}
	if (inputField.value==""){
		return true;
	}
	return false;
}

//function to highlight an error through colour by adding css attributes tot he div passed in
function makeRed(inputDiv){
	inputDiv.style.backgroundColor="#AA0000";
	inputDiv.parentNode.style.backgroundColor="#AA0000";
	inputDiv.parentNode.style.color="#FFFFFF";
}

//remove all error styles from the div passed in
function makeClean(inputDiv){
	inputDiv.parentNode.style.backgroundColor="#FFFFFF";
	inputDiv.parentNode.style.color="#000000";
// inputDiv.style.color="#000000";
}

//the main function must occur after the page is loaded, hence being inside the wondow.onload event handler.
window.onload = function(){
	var myForm = document.getElementById("createAccountForm");

	//all inputs with the class required are looped through
	var requiredInputs = document.querySelectorAll(".required");
	for (var i=0; i < requiredInputs.length; i++){
		requiredInputs[i].onfocus = function(){
			this.style.backgroundColor = "#EEEE00";
		}
	}

	//on submitting the form, "empty" checks are performed on required inputs.
	myForm.onsubmit = function(e){
		var requiredInputs = document.querySelectorAll(".required");
		for (var i=0; i < requiredInputs.length; i++){
			if( isBlank(requiredInputs[i]) ){
				e.preventDefault();
				makeRed(requiredInputs[i]);
				document.getElementById("msg").innerHTML="Complete All Entries"
			}
			else{
				makeClean(requiredInputs[i]);
			}
		}
	// if ( !checkPswds() ) {
	// 	e.preventDefault();
	// }
}

myForm.onreset = function(e){
	var requiredInputs = document.querySelectorAll(".required");
	for (var i=0; i < requiredInputs.length; i++){
		makeClean(requiredInputs[i]);
	}
	document.getElementById("msg").innerHTML="Try Again"
}

}

//Filter through cards in a collection
function filterCardFunction() {
	var input, filter, table, tr, td, i;
	input = document.getElementById("myInput");
	filter = input.value.toUpperCase();
	table = document.getElementById("t01");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[1];
		if (td) {
			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}
	}
}

function cardClicked(x) {
	cid = x.parentNode.cells[0].innerHTML;
	if (cid) { window.location = 'view_cards.php?cid=' + cid; }
}

function deckClicked(x) {
	did = x.cells[0].innerHTML;
	if (did) { window.location = 'view_decks.php?did=' + did; }
}


function addCardClicked(x) {
	cid = x.parentNode.cells[0].innerHTML;
	if (cid) { window.location = 'view_cards.php?addcid=' + cid; }
}

function removeCardClicked(x) {
	cid = x.parentNode.cells[0].innerHTML;
	if (cid) { window.location = 'view_cards.php?rmcid=' + cid; }
}

function addCardClickedEdit(x) {
	cid = x.parentNode.cells[0].innerHTML;
	if (cid) { window.location = 'edit_cards.php?addcid=' + cid; }
}

function removeCardClickedEdit(x) {
	cid = x.parentNode.cells[0].innerHTML;
	if (cid) { window.location = 'edit_cards.php?rmcid=' + cid; }
}


//trying to figure out how to show information based off selected card
function whereClick(event) {
	console.log(event.target);
}
document.addEventListener('click', whereClick);
