document.getElementById('healthReportForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
  
    var form = document.getElementById('healthReportForm');
    var formData = new FormData(form);
  
    // Send form data to PHP for processing
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_form.php', true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Handle the response from PHP
        alert(xhr.responseText);
      }
    };
    xhr.send(formData);
  });
  