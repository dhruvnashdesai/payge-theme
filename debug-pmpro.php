<?php
/**
 * Debug PMPro functionality
 */

// Check if PMPro is active
echo "PMPro Plugin Active: " . (function_exists('pmpro_url') ? 'YES' : 'NO') . "\n";

if (function_exists('pmpro_url')) {
    echo "Login URL: " . pmpro_url('login') . "\n";
    echo "Levels URL: " . pmpro_url('levels') . "\n";
    echo "Account URL: " . pmpro_url('account') . "\n";
} else {
    echo "PMPro functions not available\n";
}

// Check if user is logged in
echo "User logged in: " . (is_user_logged_in() ? 'YES' : 'NO') . "\n";
?>