$(function() {

	// International Telephone Input
	var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      utilsScript: "../frontend/assets/plugins/telephoneinput/utils.js",
      // utilsScript: "assets/plugins/telephoneinput/utils.js",
    });
});

