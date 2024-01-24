<?php

session_start();

include_once "../Models/ContactModel.php";

class ContactController 
{

    function SignUp()
    {

        $nameErr = $phonenoErr = $emailErr = "";

        $isValid = true;

        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            $isValid = false;
        } else {
            $name = $_POST['name'];
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Only alphabets and white space are allowed";
                $isValid = false;
            }
        }

        if (empty($_POST["phoneNumber"])) {
            $phonenoErr = "Phone Number is required";
            $isValid = false;
        } else {
            // Regular expression for a valid 10-digit phone number
            $phoneRegex = '/^0\d{10}$/';

            if (!preg_match($phoneRegex, $_POST["phoneNumber"])) {
                $phonenoErr = "Invalid phone number format";
                $isValid = false;
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $isValid = false;
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $isValid = false;
        }

        
        $contact = new Contacts();

        $name = htmlspecialchars($_POST["name"]);
        $Phone = htmlspecialchars($_POST["phoneNumber"]);
        $Email = htmlspecialchars($_POST["email"]);

        $emailExists = $contact->checkExistingEmail($Email);
        if ($emailExists) {
            $emailErr = "This email is already registered.";
            $isValid = false;
        }

        if ($isValid) {

            $newContact = new Contacts();
            $newContact->setName($name);
            $newContact->setPhoneNumber($Phone);
            $newContact->setEmail($Email);

            $result = $contact->addContact($newContact);

            if ($result) {
                // Data inserted successfully
                header("Location: ../views/Signin.php?RegisteredSuccessfully");
                exit();
            }
            else {
                // Debug information
                error_log("Failed to add contact. Check error logs for details.");
                header("Location: ../views/Homepage.php?failtoAddtoFile");
                exit();
            }
        }

        $_SESSION["nameErr"] = $nameErr;
        $_SESSION["phonenoErr"] = $phonenoErr;
        $_SESSION["emailErr"] = $emailErr;
        header("Location: ../views/Homepage.php?fail");
        exit();

    }

    function SignIn()
    {
       $phonenoErr = $emailErr = "";

        $isValid = true;

        if (empty($_POST["phoneNumber"])) {
            $phonenoErr = "Phone Number is required";
            $isValid = false;
        } else {
            // Regular expression for a valid 10-digit phone number
            $phoneRegex = '/^0\d{10}$/';

            if (!preg_match($phoneRegex, $_POST["phoneNumber"])) {
                $phonenoErr = "Invalid phone number format";
                $isValid = false;
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $isValid = false;
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $isValid = false;
        }

        
        $contact = new Contacts();

        $Phone = htmlspecialchars($_POST["phoneNumber"]);
        $Email = htmlspecialchars($_POST["email"]);

        if ($isValid) {

            $contacts = $contact->checkEmailAndPhone($Email, $Phone);

            if ($contacts) {
                $Name = $contacts->getName();
    
                $_SESSION['Phone'] = $Phone;
                $_SESSION['Email'] = $Email;
                $_SESSION['Name'] = $Name; 
    
                header("Location: ../views/Contact.php?LoginSuccessfully");
                exit();
            }
        }

        $_SESSION["phonenoErr"] = $phonenoErr;
        $_SESSION["emailErr"] = $emailErr;
        header("Location: ../views/Signin.php?fail");
        exit();
        
    }

    function Edit()
    {
        $nameErr = $phonenoErr = $emailErr = "";

        $isValid = true;

        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            $isValid = false;
        } else {
            $name = $_POST['name'];
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Only alphabets and white space are allowed";
                $isValid = false;
            }
        }

        if (empty($_POST["phoneNumber"])) {
            $phonenoErr = "Phone Number is required";
            $isValid = false;
        } else {
            // Regular expression for a valid 10-digit phone number
            $phoneRegex = '/^0\d{10}$/';

            if (!preg_match($phoneRegex, $_POST["phoneNumber"])) {
                $phonenoErr = "Invalid phone number format";
                $isValid = false;
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $isValid = false;
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $isValid = false;
        }

        
        $contact = new Contacts();

        $Name = htmlspecialchars($_POST["name"]);
        $Phone = htmlspecialchars($_POST["phoneNumber"]);
        $Email = htmlspecialchars($_POST["email"]);

        if ($isValid) {

            $newContact = new Contacts();
            $newContact->setName($Name);
            $newContact->setPhoneNumber($Phone);
            $newContact->setEmail($Email);

            $result = $contact->editContact($Name,$newContact);

            if ($result) {
                // Data inserted successfully
                $_SESSION['Phone']=$Phone;
                $_SESSION['Email']=$Email;
                header("Location: ../views/Contact.php?UpdatedSuccessfully");
                exit();
            }
        }

        $_SESSION["nameErr"] = $nameErr;
        $_SESSION["phonenoErr"] = $phonenoErr;
        $_SESSION["emailErr"] = $emailErr;
        header("Location: ../views/Edit.php?fail");
        exit();
        
    }

    function Delete()
    {
        $contact = new Contacts();

        $Name = $_SESSION["Name"];
        $Phone = $_SESSION["Phone"];
        $Email = $_SESSION["Email"];

        $deletedContact = new Contacts();
        $deletedContact->setName($Name);
        $deletedContact->setPhoneNumber($Phone);
        $deletedContact->setEmail($Email);

        $result = $contact->deleteContact($deletedContact);

        if($result)
        {
            session_destroy();
            header("Location: ../views/Homepage.php?DeletedSuccessfully");
            exit();
        }

            
        header("Location: ../views/Contact.php?DeletionFailed");
        exit();

    }
}
$controller = new ContactController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = isset($_POST["action"]) ? $_POST["action"] : "";

    switch ($action) {
        case "signin":
            $controller->SignIn();
            break;
        case "signup":
            $controller->SignUp();
            break;
        case "edit":
            $controller->Edit();
            break;
        case "delete":
            $controller->Delete();
            break;
        default:
            break;
    }

}
?>