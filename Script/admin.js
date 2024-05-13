document.addEventListener('DOMContentLoaded', function() {
    var logoutButton = document.getElementById('logoutButton');
    logoutButton.addEventListener('click', function() {
        
        var confirmLogout = confirm('Are you sure you want to log out?');
        
        if (confirmLogout) {
          
            window.location.href = '../Controllers/logout.php';
        } else {
            
            return;
        }
    });
  });

