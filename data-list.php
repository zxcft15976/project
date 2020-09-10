<?php
$page_title = '資料列表';
$page_name = 'data-list';
require __DIR__. '/parts/__connect_db.php';


$rows = [];


    $sql = "SELECT * FROM `shop-name`";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();

# 正規表示式
// https://developer.mozilla.org/zh-TW/docs/Web/JavaScript/Guide/Regular_Expressions
?>
<?php require __DIR__. '/parts/__html_head.php'; ?>
<?php include __DIR__. '/parts/__navbar.php'; ?>
<div class="container">



    <table class="table table-striped">
        <!-- `sid`, `name`, `email`, `mobile`, `birthday`, `address`, `created_at` -->
        <thead>
        <tr>
            <?php if(isset($_SESSION['admin'])): ?>
            <th scope="col"><i class="fas fa-trash-alt"></i></th>
            <th scope="col"><i class="fas fa-user-times"></i></th>
            <?php endif; ?>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col">sid</th>
            <th scope="col">name</th>
            <th scope="col">address</th>
    <th scope="col"><i class="fas fa-edit"></i></th>
            <?php if(isset($_SESSION['admin'])): ?>
            
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach($rows as $r): ?>
        <tr>
            
            <td><a href="data-delete.php?sid=<?= $r['sid'] ?>" onclick="ifDel(event)" data-sid="<?= $r['sid'] ?>">
                    <i class="fas fa-trash-alt"></i>
                </a></td>
            <td><a href="javascript:delete_it(<?= $r['sid'] ?>)">
                    <i class="fas fa-user-times"></i>
                </a></td>

                <?php if(isset($_SESSION['admin'])): ?>
            <?php endif; ?>
            <td><?= $r['sid'] ?></td>
            <td><?= $r['name'] ?></td>
            <td><?= $r['address'] ?></td>

            <td>
                <a href="<?= WEB_ROOT ?>/edit-member.php?sid=<?= $r['sid'] ?>">
                <i class="fas fa-edit"></i>
            </a>
            </td>
            <?php if(isset($_SESSION['admin'])): ?>
            
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
<?php include __DIR__. '/parts/_scripts.php'; ?>
<script>
    function ifDel(event){
        const a = event.currentTarget;
        console.log(event.target, event.currentTarget);
        const sid = a.getAttribute('data-sid');
        if(! confirm(`是否要刪除編號為 ${sid} 的資料?`)){
            event.preventDefault();  // 取消連往 href 的設定
        }
    }

    function delete_it(sid){
        if(confirm(`是否要刪除編號為 ${sid} 的資料???`)){
            location.href = 'data-delete.php?sid=' + sid;
        }
    }

</script>
<?php include __DIR__. '/parts/__html_foot.php'; ?>
