<?php
require __DIR__ . '/admin/includes/blog_helpers.php';
echo sanitizeBlogHtml('<script>alert(1)</script><p>OK</p>');
?>