<!DOCTYPE html>
<html>
<head>
    <title>Simple Color Picker - Lab 3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            transition: background-color 0.5s;
        }
        
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: inline-block;
            margin: 20px;
        }
        
        h1 {
            color: #333;
            margin-bottom: 30px;
        }
        
        .form-box {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: inline-block;
        }
        
        .form-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #444;
        }
        
        input[type="color"] {
            width: 100px;
            height: 50px;
            border: none;
            cursor: pointer;
            margin: 10px 0;
        }
        
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 5px;
        }
        
        button.get {
            background-color: #2196F3;
        }
        
        button.post {
            background-color: #FF9800;
        }
        
        .color-display {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f5f5f5;
            display: inline-block;
        }
        
        .url-info {
            background-color: #e8f4fd;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body style="background-color: <?php 
    $bg_color = "#ffffff";
    
    if (isset($_GET['color'])) {
        $bg_color = htmlspecialchars($_GET['color']);
    }
    
    if (isset($_POST['color'])) {
        $bg_color = htmlspecialchars($_POST['color']);
    }
    
    echo $bg_color;
?>;">

<div class="container">
    <h1>GET vs POST Methods</h1>
    <h3>Simple Color Picker</h3>
    
    <div class="color-display">
        <strong>Current Background Color:</strong><br>
        <div style="width: 50px; height: 50px; background-color: <?php echo $bg_color; ?>; margin: 10px auto; border: 1px solid #ccc;"></div>
        <?php echo $bg_color; ?>
    </div>
    
    <div class="form-box">
        <div class="form-title">Method: GET</div>
        <form action="" method="GET">
            <label>Choose a color:</label><br>
            <input type="color" name="color" value="<?php echo $bg_color; ?>"><br>
            <button type="submit" class="get">Submit using GET</button>
        </form>
    </div>
    
    <div class="form-box">
        <div class="form-title">Method: POST</div>
        <form action="" method="POST">
            <label>Choose a color:</label><br>
            <input type="color" name="color" value="<?php echo $bg_color; ?>"><br>
            <button type="submit" class="post">Submit using POST</button>
        </form>
    </div>
</div>

</body>
</html>