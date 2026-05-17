<?php
include "koneksi.php";

if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);

    if (!empty($username)) {
        $query = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");

        if (mysqli_num_rows($query) > 0) {
            echo "exists";
        } else {
            echo "available";
        }
    }
}
