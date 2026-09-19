<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Enquiry Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            color: #012F56;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            padding: 10px;
        }
        .container {
            background-color: #012F56;
            color: white;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .container h2 {
            text-align: center;
        }
        .details {
            text-align: left;
        }
        .details p {
            margin: 10px 0;
        }
        .thank-you {
            margin-top: 20px;
            font-size: 35px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{$data['subject']}}</h2>
        <div class="details">
            <p><strong>Student Name:</strong> <span id="student-name">{{$data['name']}}</span></p>
            <p><strong>Address:</strong> <span id="student-address">{{$data['address']}}</span></p>
            <p><strong>Phone Number:</strong> <span id="student-phone">{{$data['contact']}}</span></p>
            <p><strong>Course:</strong> <span id="student-course">{{$data['course']}}</span></p>
            <p><strong>State:</strong> <span id="student-state">{{$data['state']}}</span></p>
            <p><strong>Additional Details:</strong> <span id="student-details">{{$data['place']}}</span></p>
        </div>
    </div>
    <div class="thank-you">Thank You</div>
</body>
</html>
