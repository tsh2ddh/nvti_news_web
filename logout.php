<?php
// Session eka start karanawa
session_start();

// Thiyena okkoma session variables (user details) clear karanawa
session_unset();

// Session eka sampurnayenma destroy karanawa
session_destroy();

// Main index page ekata (home) redirect karanawa
header("Location: index.php");
exit();
?>