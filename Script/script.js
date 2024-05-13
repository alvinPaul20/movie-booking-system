window.addEventListener('scroll', function() {
  const navbar = document.querySelector('nav.navbar');
  const btn = document.querySelector('.login-button');
  const scrolledPosition = window.scrollY;

  // Check if navbar element exists
  if (navbar) {
      if (scrolledPosition === 0) {
          navbar.style.backgroundColor = 'transparent';
          btn.style.backgroundColor = 'transparent';
          
      } else {
          navbar.style.backgroundColor = '#171d21';
          btn.style.backgroundColor = '#11141d';
         
      }
  }
});

document.addEventListener('DOMContentLoaded', function() {
  // Select the logout button
  var logoutButton = document.getElementById('logoutButton');

  // Add click event listener to the logout button
  logoutButton.addEventListener('click', function() {
      // Display confirmation dialog
      var confirmLogout = confirm('Are you sure you want to log out?');
      
      // Check user's response
      if (confirmLogout) {
          // If user confirms, proceed with logout action
          window.location.href = 'Controllers/logout.php';
      } else {
          // If user cancels, do nothing
          return;
      }
  });
});


console.log("js is working");
  const currentDateElement = document.querySelector('.date-container .date');

  if (currentDateElement) {
    const today = new Date();
    const formattedDate = today.toLocaleDateString('en-US', {
      day: 'numeric',
      month: 'long',
      year: 'numeric'
    });
    currentDateElement.textContent = formattedDate;
  } else {
    console.error("Element with classes 'date-container .date' not found!");
  }
  
  //modal 

  

//.date-container .date
