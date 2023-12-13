<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registeration Form</title>
</head>

<body>

    <?php
    // Declare all variables
    $first_name = $last_name = $age = $address = $phone_number = $email = '';
    $errors = [];

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Get inputs
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];

        // Perform validation
        if (empty($first_name)) {
            $errors[] = 'First Name is required';
        }

        if (empty($last_name)) {
            $errors[] = 'Last Name is required';
        }

        if (empty($age) || !is_numeric($age) || $age <= 0) {
            $errors[] = 'Age must be a positive number';
        }

        if (empty($address)) {
            $errors[] = 'Address is required';
        }

        if (empty($phone_number) || !preg_match('/^\d{10}$/', $phone_number)) {
            $errors[] = 'Phone Number is required and must be 10 digits';
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Valid email address is required';
        }
    }


    ?>

    <h2>Registeration Form</h2>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errors)) : ?>
        <div style="color: green;">
            <h3>Success!</h3>
        </div>
        <h3>Entered Information:</h3>
        <table border="1">
            <tr>
                <td><strong>First Name:</strong></td>
                <td><?= $first_name ?></td>
            </tr>
            <tr>
                <td><strong>Last Name:</strong></td>
                <td><?= $last_name ?></td>
            </tr>
            <tr>
                <td><strong>Age:</strong></td>
                <td><?= $age ?></td>
            </tr>
            <tr>
                <td><strong>Address:</strong></td>
                <td><?= $address ?></td>
            </tr>
            <tr>
                <td><strong>Phone Number:</strong></td>
                <td><?= $phone_number ?></td>
            </tr>
            <tr>
                <td><strong>Email:</strong></td>
                <td><?= $email ?></td>
            </tr>
        </table>



    <?php else : ?>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <table border="1">
                <tr>
                    <td>
                        <label for="first_name">First Name:</label>
                    </td>
                    <td>
                        <input type="text" name="first_name" value="<?= $first_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="last_name">Last Name:</label>
                    </td>
                    <td>
                        <input type="text" name="last_name" value="<?= $last_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="age">Age:</label>
                    </td>
                    <td>
                        <input type="number" name="age" value="<?= $age ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="address">Address:</label>
                    </td>
                    <td>
                        <textarea name="address"><?= $address ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="phone_number">Phone Number:</label>
                    </td>
                    <td>
                        <input type="tel" name="phone_number" value="<?= $phone_number ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email:</label>
                    </td>
                    <td>
                        <input type="text" name="email" value="<?= $email ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Submit">
                    </td>
                    <td>
                        <input type="reset" value="Reset">
                    </td>
                </tr>

            </table>


        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($errors)) : ?>
            <div style="color: red;">
                <h3>Errors:</h3>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

    <?php endif; ?>

</body>

</html>