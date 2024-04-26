<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Programming</title>
    <style type="text/css">
        <?php
        $formData = isset($_COOKIE['form_data']) ? json_decode($_COOKIE['form_data'], true) : null;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && $formData) {
            if (isset($_POST['theme'])) {
                $selectedIndex = $_POST['theme'];
                if (isset($formData[$selectedIndex])) {
                    $theme = $formData[$selectedIndex];
                    echo 'body {';
                    echo 'background-color: ' . $theme['background_color'] . ';';
                    echo 'color: ' . $theme['paragraph_color'] . ';';
                    echo '}';
                    echo 'p {';
                    echo 'font-size: ' . $theme['font_size'] . 'px;';
                    echo 'text-align: ' . $theme['alignment'] . ';';
                    echo '}';
                    echo 'h1 {';
                    echo 'text-align: ' . $theme['alignment'] . ';';
                    echo 'color: ' . $theme['heading_color'] . ';';
                    echo '}';
                }
            }
        }
        ?>
    </style>
</head>
<body>
    <form id="themeForm" action="" method="post">
        <label for="themeSelect">Theme: </label>
        <select id="theme" name="theme">
            <option value="" disabled selected> -- Choose Theme -- </option>
            <?php
            if ($formData) {
                foreach ($formData as $index => $theme) {
                    echo '<option value="' . $index . '">' . $theme['name'] . '</option>';
                }
            }
            ?>
        </select>
        <a href="./themes.php">Add New Theme</a><br><br>
        <input type="submit" name="selectTheme" value="Choose the Theme">
        <?php
        if (isset($selectedIndex)) {
            echo '<a href="./themes.php?index=' . $selectedIndex . '"><input type="button" name="editTheme" value="Edit the Theme"></a>';
        }
        ?>
    </form>
    <hr>
    <h1>Heading 1</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quis risus sed magna laoreet pellentesque at et leo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent elementum magna ac velit volutpat molestie. Quisque ac sagittis nibh. Phasellus ornare lorem vitae justo volutpat ullamcorper. Integer quis urna id metus maximus auctor. Sed luctus quam hendrerit ullamcorper finibus. Sed quis ex euismod, feugiat tortor euismod, fermentum sapien. Morbi dignissim nulla nec vestibulum ornare. Praesent luctus quam dapibus sapien pellentesque interdum. Sed a finibus velit.

    Nulla sollicitudin eget massa et semper. Integer vehicula, augue sed eleifend dictum, libero mauris bibendum magna, auctor consequat urna libero ac ante. Mauris blandit commodo rutrum. Duis porttitor magna a erat auctor, in volutpat mauris feugiat. In ac nisl sapien. In vel massa id purus malesuada suscipit et non elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam a aliquam ex, vel consectetur enim. Phasellus varius justo a sapien venenatis, et tempor ipsum molestie. Aliquam molestie dui quis risus euismod fermentum. Donec cursus condimentum odio, non dignissim odio sodales ac. Nulla vel est id libero porta egestas. Cras maximus sapien vitae pretium feugiat. In tincidunt ligula ac venenatis convallis.</p>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $formData) {
        if (isset($_POST['theme'])) {
            $selectedIndex = $_POST['theme'];
            
            if (isset($formData[$selectedIndex])) {
            }
        }
    }
    ?>
</body>
</html>