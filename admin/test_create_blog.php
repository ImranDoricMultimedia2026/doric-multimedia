<?php
session_start();
$_SESSION['admin_logged_in'] = true;
$_SESSION['admin_id'] = 1;
$_SESSION['csrf_token'] = 'verifytoken123';
$_SERVER['REQUEST_METHOD'] = 'POST';
$_POST = [
    'title' => 'Welcome to Doric Multimedia Blog',
    'slug' => 'welcome-to-doric-multimedia-blog',
    'excerpt' => 'Test blog created for validation.',
    'content' => 'This is a test blog inserted through the real admin create flow.',
    'category' => '1',
    'status' => 'published',
    'seo_title' => 'Welcome to Doric Multimedia Blog',
    'seo_description' => 'Test insertion',
    'seo_keywords' => 'doric, blog',
    'canonical_url' => 'https://example.com/blog/welcome-to-doric-multimedia-blog',
    'csrf_token' => 'verifytoken123',
];
include 'C:\Users\Admin\Desktop\WEB_PROJECTS\DORIC_MULTIMEDIA\DoricLiveSiteWork_01\admin\blogs\create.php';
