<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<h1>Public IPs</h1>
<h2>IPv4: <span id="ipv4addr"></span></h2>
<h2>IPv6: <span id="ipv6addr"></span></h2>

<script>

$(document).ready(function() {
        const ipv4addr = 'https://ipv4.example.com/ip.php';
        const ipv6addr = 'https://ipv6.example.com/ip.php';
  
        $("#ipv4addr").text("Loading...");
        $("#ipv6addr").text("Loading...");

        // Request IPv4 address
        $.get(ipv4addr, function(data) {
                $("#ipv4addr").text(data);
        }).fail(function() {
                $("#ipv4addr").text("Unavailable");
        });

        // Request IPv6 address
        $.get(ipv6addr, function(data) {
                $("#ipv6addr").text(data);
        }).fail(function() {
                $("#ipv6addr").text("Unavailable");
        });
});

</script>
