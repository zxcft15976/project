<?php

require __DIR__ . '/parts/__connect_db.php';
if(!empty($_POST['sid'])){
    $sql = "UPDATE `shop-name` SET `name`=?, `address`=? WHERE `sid`=?";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
            $_POST['name'],
            $_POST['address'],
            $_POST['sid'],

    ]);

    if($stmt->rowCount()){
        $modified = true;
    }
}

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$row = $pdo->query("SELECT * FROM `shop-name` WHERE `sid`=$sid")->fetch();

?>
<?php require __DIR__ . '/parts/__html_head.php'; ?>
<?php include __DIR__ . '/parts/__navbar.php'; ?>
<div class="container">
    <?php if(isset($modified)): ?>
        <div class="alert alert-success" role="alert">
            修改成功
        </div>
    <?php endif ?>
    <form action="" method="post">
        <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
        <div class="form-group">
            <label for="nickname">name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $row['name'] ?>">
        </div>
        <div class="form-group">
            <label for="mobile">address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= $row['address'] ?>">
        </div>

        <!-- <button type="button" class="btn btn-warning"
                onclick="file_input.click()">更換頭貼</button>
        <input type="hidden" id="avatar" name="avatar" value="<?= $row['hash'] ?>">
        <img src="./../uploads/<?= $row['hash'] ?>" alt="" id="myimg" width="250px">-->
        <br>

        <div class="d-flex justify-content-end">
            <input type="submit" value="修改" class="btn btn-primary">
        </div> 

    </form>

    <input type="file" id="file_input" style="display: none">

</div>
<?php include __DIR__ . '/parts/_scripts.php'; ?>
    <script>
        // const file_input = document.querySelector('#file_input');
        // const avatar = document.querySelector('#avatar');

        // file_input.addEventListener('change', function (event) {
        //     console.log(file_input.files)
        // const $name = document.querySelector('#name');
        // const $email = document.querySelector('#address');

            const fd = new FormData(document.form1);
            // fd.append('name', );
            // fd.append('address', );

            fetch('data-edit-api.php', {
                method: 'POST',
                body: fd
            })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                });
       

    </script>

<?php include __DIR__ . '/parts/__html_foot.php'; ?>