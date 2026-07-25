<?php
// ملف تهيئة قاعدة البيانات تلقائياً
require_once 'DatabaseConnection.php';

$db = new DatabaseConnection();
$db->connect(); // سيعمل على إنشاء قاعدة البيانات والجداول والحسابات فوراً
?>