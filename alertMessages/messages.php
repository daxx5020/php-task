<?php
// class CustomSessionHandler {
//     public static function set($key, $value) {
//         $_SESSION[$key] = $value;
//         if (!empty($value)) {
//             // Determine the CSS class based on the provided key
//             $class = ($key === 'success_message') ? 'bg-green-500' : 'bg-red-500';
//             echo '<div class="' . $class . ' py-2 mb-4" id="messageDiv">
//                 <p class="text-white-200 font-semibold text-lg text-center">' . $value . '</p>
//             </div>';
            
//             // Reset the session variable
//             $_SESSION[$key] = '';
            
//             // Automatically dismiss the message after 5 seconds (adjust as needed)
//             echo '<script>
//                 setTimeout(function() {
//                     var messageDiv = document.getElementById("messageDiv");
//                     if (messageDiv) {
//                         messageDiv.style.display = "none";
//                     }
//                 }, 5000);
//             </script>';
//         }
//     }
// }


?>



<?php
class MessageHandle {
    public static function displayMessage($sessionVariable, $message, $isSuccess = false) {
        $class = $isSuccess ? 'bg-green-500' : 'bg-red-500';
        
        if (isset($_SESSION[$sessionVariable]) && $_SESSION[$sessionVariable]) {
            echo '<div class="' . $class . ' py-2 mb-4" id="messageDiv">
                <p class="text-white-200 font-semibold text-lg text-center">' . $message . '</p>
            </div>';

            // Reset the session variable
            $_SESSION[$sessionVariable] = false;

            echo '<script>
                setTimeout(function() {
                    var messageDiv = document.getElementById("messageDiv");
                    if (messageDiv) {
                        messageDiv.style.display = "none";
                    }
                }, 5000);
            </script>';
        }
    }
}
?>