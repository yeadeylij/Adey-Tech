<?php
require_once 'includes/config.php';

echo "<h1 style='color: #64ffda;'>Adey Tech - Database Test</h1>";

try {
    $conn = getConnection();
    echo "<p style='color: #10b981;'>✓ Database connected successfully!</p>";
    
    // Check tables
    $result = $conn->query("SHOW TABLES");
    echo "<h3>Tables in database:</h3>";
    echo "<ul>";
    while ($row = $result->fetch_array()) {
        echo "<li>" . $row[0] . "</li>";
    }
    echo "</ul>";
    
    // Check users table
    $result = $conn->query("SELECT COUNT(*) as count FROM users");
    $row = $result->fetch_assoc();
    echo "<p>✓ Users table has " . $row['count'] . " records</p>";
    
    // Check contacts table
    $result = $conn->query("SELECT COUNT(*) as count FROM contacts");
    $row = $result->fetch_assoc();
    echo "<p>✓ Contacts table has " . $row['count'] . " records</p>";
    
} catch (Exception $e) {
    echo "<p style='color: #ef4444;'>✗ Error: " . $e->getMessage() . "</p>";
}
?>