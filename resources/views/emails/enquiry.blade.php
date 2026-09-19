<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Enquiry Details</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #fff; color: #012F56; margin: 0; padding: 20px; }
        .container { background-color: #012F56; color: #fff; padding: 24px; border-radius: 10px; max-width: 520px; margin: 0 auto; }
        .details p { margin: 10px 0; line-height: 1.5; }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{ $data['subject'] }}</h2>
        <div class="details">
            <p><strong>Student Name:</strong> {{ $data['name'] ?? '' }}</p>
            <p><strong>Email:</strong> {{ $data['email'] ?? '' }}</p>
            <p><strong>Phone Number:</strong> {{ $data['contact'] ?? '' }}</p>
            <p><strong>Course:</strong> {{ $data['course'] ?? '' }}</p>
            <p><strong>State:</strong> {{ $data['state'] ?? '' }}</p>
            <p><strong>How did you hear about us?</strong> {{ $data['here_me'] ?? '' }}</p>
            <p><strong>Reference Person:</strong> {{ $data['ref_persion'] ?? '' }}</p>
            <p><strong>Address / Requirement:</strong> {{ $data['address'] ?? '' }}</p>
        </div>
    </div>
</body>
</html>
