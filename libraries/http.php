<?php 

class Http {
    /**
     * Redirects user to $url
     * @param string $url
     */
    public static function redirect(string $url): void {
        header("Location: $url");
        exit();
}
}

?>