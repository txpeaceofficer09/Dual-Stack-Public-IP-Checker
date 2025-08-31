# Dual-Stack Public IP Checker

This project provides a simple way to determine a client's public IPv4 and IPv6 addresses using a dual-stack setup. It consists of two main files: `ip.php` and `public.php`. The core principle is to use separate subdomains for IPv4 and IPv6-only requests, as a single request cannot simultaneously see both IP types.

***

### ⚙️ How It Works

1.  **`ip.php`**: This is a very simple PHP script designed to be hosted on two separate subdomains. It does one thing: it returns the IP address of the requesting client.
    * On the **IPv4-only subdomain** (e.g., `ipv4.example.com`), it returns the public IPv4 address.
    * On the **IPv6-only subdomain** (e.g., `ipv6.example.com`), it returns the public IPv6 address.

2.  **`public.php`**: This is the client-facing script hosted on your main domain (e.g., `www.example.com`). It uses jQuery's `$.get()` method to make two separate asynchronous requests:
    * One request to the `ipv4.example.com` subdomain.
    * One request to the `ipv6.example.com` subdomain.

    It then takes the responses from these two requests and displays them to the user as their "Public IPv4" and "Public IPv6" addresses. If a request fails (e.g., the client has no connectivity to that IP type), it will display **"Unavailable."**

***

### 🤔 Why Two Subdomains?

The use of separate subdomains is **critical** to this project's functionality. This is due to a fundamental limitation of how internet requests are routed.

When a client's device makes a request to a server, it uses either an **IPv4 address or an IPv6 address, but not both at the same time.** A single request is a single stream of data between two endpoints.

* If a client has a working IPv6 connection and your server has an IPv6 address, the request will be made over IPv6. The server will only see the client's IPv6 address.
* Similarly, if the request is made over IPv4, the server will only see the client's IPv4 address.

By creating **two distinct DNS records** for subdomains—one that resolves exclusively to an **IPv4 address** and another that resolves exclusively to an **IPv6 address**—we force the client's device to use a specific protocol for each request. This allows us to reliably capture both addresses and present them to the user.

***

### 🚀 Getting Started

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/txpeaceofficer09/Public-IP.git](https://github.com/txpeaceofficer09/Public-IP.git)
    ```

2.  **Configure your subdomains:**
    * Host `ip.php` on an IPv4-only subdomain (e.g., `ipv4.example.com`).
    * Host `ip.php` on an IPv6-only subdomain (e.g., `ipv6.example.com`).
    * Host `public.php` on your main domain (e.g., `www.example.com`).

3. **Update `ip.php`**: Open `ip.php` and update the Access-Control-Allow-Origin header.
   ```PHP
   // The Access-Control-Allow-Origin header should contain an * to allow any remote domain
   // or the URL of your primary domain where public.ip is.
   // header("Access-Control-Allow-Origin: *");
   //                or
   // header("Access-Control-Allow-Origin: https://www.yourdomain.com");
   header("Access-Control-Allow-Origin: https://www.example.com");
   ```

4.  **Update `public.php`**: Open `public.php` and replace the placeholder URLs with your actual subdomain URLs.
    ```javascript
    // Update these URLs to your live subdomains
    const ipv4addr = '[https://ipv4.example.com/ip.php](https://ipv4.example.com/ip.php)';
    const ipv6addr = '[https://ipv6.example.com/ip.php](https://ipv6.example.com/ip.php)';
    ```

5.  **Test the setup:** Navigate to `https://www.example.com/public.php` in a web browser to see your public IP addresses.
