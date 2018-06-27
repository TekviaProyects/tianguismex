<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Notifications</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <button onclick="notifyMe()">Notify me!</button>

    <script src="https://cdn.pubnub.com/pubnub-3.7.13.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script>
        function notifyMe(message) {
            if (message == undefined) {
                message = "Hi there! You clicked a button.";
            }

            if (!("Notification" in window)) {
                alert("This browser does not support desktop notification");
            }
            else if (Notification.permission === "granted") {
                var notification = new Notification(message);
            }
            else if (Notification.permission !== 'denied') {
                Notification.requestPermission(function (permission) {
                if (permission === "granted") {
                    var notification = new Notification("Hi there!");
                }
                });
            }
        };

        $(document).ready(function() {
            var pubnub = PUBNUB({
                    subscribe_key : 'demo'
                });
            pubnub.subscribe({
                channel : "pubnub-html5-notification-demo", // Subscribing to PubNub's channel
                message : function(message){
                console.log(message);
                notifyMe(message.text);
                }
            })
        });
    </script>
</body>
</html>