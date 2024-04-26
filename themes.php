<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formData = [
        'name' => $_POST['name'],
        'background_color' => $_POST['background_color'],
        'heading_color' => $_POST['heading_color'],
        'paragraph_color' => $_POST['paragraph_color'],
        'alignment' => $_POST['alignment'],
        'font_size' => $_POST['font_size']
    ];

    $cookieName = "form_data";
    $existingData = isset($_COOKIE['form_data']) ? json_decode($_COOKIE['form_data'], true) : [];
    
    if (isset($_GET["index"])) {
        $existingData[$_GET["index"]] = $formData;
    } else {
        $existingData[] = $formData;
    }
    
    setcookie($cookieName, json_encode($existingData), time() + 3600, "/");
    
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

$selectedIndex = -1;
$selectedTheme = [];
$background_color = $name = $heading_color = $paragraph_color = $alignment = $font_size = "";

if (isset($_GET["index"])) {
    $themes = isset($_COOKIE['form_data']) ? json_decode($_COOKIE['form_data'], true) : null;
    
    $selectedIndex = $_GET['index'];
    $selectedTheme = $themes[$selectedIndex];
    
    $name = $selectedTheme['name'];
    $background_color = $selectedTheme['background_color'];
    $alignment = $selectedTheme['alignment'];
    $font_size = $selectedTheme['font_size'];
    $paragraph_color = $selectedTheme['paragraph_color'];
    $heading_color = $selectedTheme['heading_color'];
}

$p_alignment = [
    '' => " -- Choose Alignment -- ",
    'center' => "Center",
    'right' => "Right",
    'left' => "Left",
    'justify' => "Justify"
];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Theme Settings</title>
</head>
<body>
    <form id="themeSettingsForm" method="post">
        <label for="name">Name of your theme: </label>
        <input type="text" id="name" name="name" value="<?= $name ?>">
        <br>
        <br>
        <label for="background_color">Color of Page Background: </label>
        <input type="color" id="background_color" name="background_color" value="<?= $background_color ?>">
        <br>
        <br>
        <label for="heading_color">Color of Heading 1: </label>
        <input type="color" id="heading_color" name="heading_color" value="<?= $heading_color ?>">
        <br>
        <br>
        <label for="alignment">Alignment of Heading 1: </label>
        <select id="alignment" name="alignment">
            <?php 
            foreach ($p_alignment as $key => $value) {
                echo '<option value="'.$key.'" '.($key == $alignment ? 'selected' : '').'>'.$value.'</option>';
            }
            ?>
        </select>
        <br>
        <br>
        <label for="paragraph_color">Color of Paragraph: </label>
        <input type="color" id="paragraph_color" name="paragraph_color" value="<?= $paragraph_color ?>">
        <br>
        <br>
        <label for="font_size">Font size of Paragraph: </label>
        <input type="number" id="font_size" name="font_size" value="<?= $font_size ?>" min="10" max="24">
        <br>
        <br>
        <button type="submit">Save</button>
    </form>
</body>
</html>
