<!DOCTYPE html>
<html>
<head>
    <title>Drag n Drop</title>
</head>
<body>
<div class="container">
    <div class="content">
        <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)" style="border: 1px solid black; width: 400px; height: 400px;"></div>

        <div id="drag1" draggable="true" ondragstart="drag(event)" style="width: 200px; height: 200px; background: #333333; "></div>
    </div>
</div>

    <script src="../js/all.js"></script>
</body>
</html>
