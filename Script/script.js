window.addEventListener('scroll', function() {
  const navbar = document.querySelector('nav.navbar');
  const scrolledPosition = window.scrollY;

  // Check if navbar element exists
  if (navbar) {
      if (scrolledPosition === 0) {
          navbar.style.backgroundColor = 'transparent';
      } else {
          navbar.style.backgroundColor = '#171d21';
      }
  }
});


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
  
  
//.date-container .date