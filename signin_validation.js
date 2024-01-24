function validateForm() {
    var email = document.getElementById('email').value;
    var phoneNumber = document.getElementById('phoneNumber').value;

    var emailError = document.getElementById('emailError');
    var phoneNumberError = document.getElementById('phoneNumberError');

    var isValid = true;
    emailError.textContent = '';
    phoneNumberError.textContent = '';

    // Validate Email
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email.trim() === '') {
        emailError.textContent = 'Email is required';
        isValid = false;
    }else if (!emailPattern.test(email)) {
      emailError.textContent = 'Invalid email address';
      isValid = false;
    }

    // Validate Phone Number
    $phoneRegex = '/^0\d{10}$/';
    if (phoneNumber.trim() === '') {
        phoneNumberError.textContent = 'Phone Number is required';
        isValid = false;
    }else if (!preg_match($phoneRegex, $_POST["phone"])) {
      phoneNumberError.textContent = "Invalid phone number format";
      $isValid = false;
  }

    return isValid;
  }