<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h2>Hello Owner,</h2>

    <p>You have received a new message from a visitor on your website.</p>

    <p>Here are the details:</p>

    <p><strong>Name:</strong> {{ $formData['name'] }}</p>
    <p><strong>Email:</strong> {{ $formData['email'] }}</p>
    <p><strong>Subject:</strong> {{ $formData['subject'] }}</p>
    <p><strong>Message:</strong> {{ $formData['message'] }}</p>

    <p>Please respond to the visitor as soon as possible.</p>

    <p>Best regards,</p>
    <p>Job Pulse</p>
</body>

</html>
