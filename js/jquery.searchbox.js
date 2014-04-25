$(document).ready(function(){ 

	// Add the value of "Search..." to the input field and a class of .empty
	$("#searchbox").val("Enter : Title/Author").addClass("empty");

	// When you click on #search
	$("#searchbox").focus(function(){

		// If the value is equal to "Search..."
		if($(this).val() == "Enter : Title/Author") {
			// remove all the text and the class of .empty
			$(this).val("").removeClass("empty");;
		}

	});

	// When the focus on #search is lost
	$("#searchbox").blur(function(){

		// If the input field is empty
		if($(this).val() == "") {
			// Add the text "Search..." and a class of .empty
			$(this).val("Enter : Title/Author").addClass("empty");
		}

	});
	
$("#url").val("Username").addClass("empty");

	// When you click on #search
	$("#url").focus(function(){

		// If the value is equal to "Search..."
		if($(this).val() == "Username") {
			// remove all the text and the class of .empty
			$(this).val("").removeClass("empty");;
		}

	});

	// When the focus on #search is lost
	$("#url").blur(function(){

		// If the input field is empty
		if($(this).val() == "") {
			// Add the text "Search..." and a class of .empty
			$(this).val("Username").addClass("empty");
		}

	});
$("#emailid").val("Email Address").addClass("empty");

	// When you click on #search
	$("#emailid").focus(function(){

		// If the value is equal to "Search..."
		if($(this).val() == "Email Address") {
			// remove all the text and the class of .empty
			$(this).val("").removeClass("empty");;
		}

	});

	// When the focus on #search is lost
	$("#emailid").blur(function(){

		// If the input field is empty
		if($(this).val() == "") {
			// Add the text "Search..." and a class of .empty
			$(this).val("Email Address").addClass("empty");
		}

	});
	

});