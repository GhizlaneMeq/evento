<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .ticket-container {
            width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #333;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .ticket-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .ticket-info {
            margin-bottom: 20px;
        }
        .ticket-info p {
            margin: 5px 0;
        }
        .ticket-info label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <h1 class="ticket-title">Ticket Information</h1>
        <div class="ticket-info">
            <p><label>Event:</label> {{ $reservation->event->title }}</p>
            <p><label>Date:</label> {{ $reservation->event->date }}</p>
            <p><label>Description:</label> {{ $reservation->event->description }}</p>
            <p><label>Organizer:</label> {{ $reservation->event->organizer->name }}</p>
            <p><label>User:</label> {{ $reservation->user->name }}</p>
            <p><label>Ticket Generated:</label> {{ now()->format('Y-m-d H:i:s') }}</p>
            
        </div>
    </div>
</body>
</html>
