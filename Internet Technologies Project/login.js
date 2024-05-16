// JavaScript code to handle login

document.addEventListener('DOMContentLoaded', function() {
    var form = document.querySelector('form');
    form.onsubmit = function(e) {
      e.preventDefault(); // Prevent the default form submission
  
      var email = document.querySelector('input[name="email"]').value;
      var password = document.querySelector('input[name="password"]').value;
  
      // Create a new XMLHttpRequest
      var x = new XMLHttpRequest();
      x.open('POST', 'connection.php', true);
      x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
      // Define what happens on successful data submission
      x.onload = function() {
        if (x.status >= 200 && x.status < 400) {
          // Handle the response from the server
          var response = x.responseText;
          if(response.includes('Login Successfully')) {
            alert('Login successful!');
            // Redirect to another page or perform other actions upon successful login
            // window.location.href = 'homepage.html';
          } else {
            alert('Login failed. Incorrect username or password.');
          }
        } else {
          // Handle errors for unsuccessful attempts
          alert('An error occurred during the login process.');
        }
      };
  
      // Define what happens in case of an error
      x.onerror = function() {
        alert('An error occurred during the login process.');
      };
  
      // Set up the request data
      var requestData = 'email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password);
  
      // Send the request
      x.send(requestData);
    };
  });