<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "mcs1");

if (!$conn) {
    die("Database Connection Failed");
}

// Check if user is already logged in
if (isset($_SESSION['cadet_id'])) {
    header("Location: cadet_dashboard.php");
    exit();
}

if (isset($_SESSION['officer_id'])) {
    header("Location: officer_dashboard.php");
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marine Command Squad - Portal</title>
    <link rel="stylesheet" href="home.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .logo-img {
            height: 40px;
            width: 40px;
            border-radius: 50%;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #667eea;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .welcome-section {
            text-align: center;
            color: white;
            margin-bottom: 3rem;
        }

        .welcome-section h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .welcome-section p {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            opacity: 0.9;
        }

        .portal-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            width: 100%;
        }

        .portal-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .portal-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }

        .portal-card h2 {
            color: #333;
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }

        .portal-card p {
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .portal-card .icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: opacity 0.3s;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-outline {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
        }

        .footer {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: auto;
        }

        .footer-info {
            margin-bottom: 1rem;
        }

        .footer-info p {
            margin: 0.5rem 0;
            font-size: 0.9rem;
        }

        .footer-contact {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .footer-contact a {
            color: #667eea;
            text-decoration: none;
        }

        .footer-contact a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .welcome-section h1 {
                font-size: 2rem;
            }

            .nav-links {
                gap: 1rem;
                font-size: 0.9rem;
            }

            .portal-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="logo">
            <span>🚢 Marine Command Squad</span>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">HOME</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="welcome-section">
            <h1>Welcome to Marine Command Squad</h1>
            <p><strong>Trust Registered Under Indian Trusts Act, 1882</strong></p>
            <p>Regd. No.: IV-1603-01063/2025</p>
        </div>

        <!-- Portal Cards -->
        <div class="portal-grid">
            <!-- Cadet Portal -->
            <div class="portal-card">
                <div class="icon">👨‍✈️</div>
                <h2>Cadet Portal</h2>
                <p>Access training materials, assignments, squad updates, and manage your cadet profile.</p>
                <a href="cadet_login.html" class="btn">Cadet Login</a>
            </div>

            <!-- Officer Portal -->
            <div class="portal-card">
                <div class="icon">👔</div>
                <h2>Officer Portal</h2>
                <p>Manage cadet registrations, view dashboards, and oversee training programs.</p>
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <a href="officer_login.html" class="btn">Officer Login</a>
                    <a href="officer_register.html" class="btn btn-outline">Register</a>
                </div>
            </div>

            <!-- Student Registration -->
            <div class="portal-card">
                <div class="icon">📝</div>
                <h2>Student Registration</h2>
                <p>New cadets can register here to join the Marine Command Squad training program.</p>
                <a href="student_register.html" class="btn">Register Now</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-info">
            <p><strong>Marine Command Squad</strong></p>
            <p>Trust Registered Under Indian Trusts Act, 1882</p>
            <p>Regd. No.: IV-1603-01063/2025</p>
        </div>
        <div class="footer-info">
            <p>📍 Address: 10A, Pandittya Road, Opp. Oasis Building, Gariahat, Kolkata, West Bengal, 700029</p>
        </div>
        <div class="footer-contact">
            <a href="tel:+919477511624">📞 9477511624</a>
            <a href="tel:+916290985896">📞 6290985896</a>
            <a href="mailto:marinecommandsquadofficial@gmail.com">📧 Email</a>
        </div>
        <p>&copy; 2025 Marine Command Squad. All rights reserved.</p>
    </footer>
</body>
</html>
