<?php
require_once '../session.php';
require_once '../library_pdo.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phones = $_POST['phones'];

    $user = get_one_data("SELECT * FROM users WHERE user_name='$username' OR user_email='$email'");
    if(!empty($user)) {
        $sql = "UPDATE users SET
            user_name='$username',
            user_email='$email',
            user_password='$password',
            user_address='$address',
            user_phone='$phones'
            WHERE user_id='$user_id'";
        $connect = getConnection();
        $stmt = $connect->prepare($sql);
        $stmt->execute();
    }

    $roleUpdate = $_POST['role'] ?? [];
    if(!empty($roleUpdate)){
        delete('user_role',"user_id=$user_id");
        foreach($roleUpdate as $role){
            $tmpRole = [
                'user_id' => $user_id,
                'role_id' => $role
            ];
            insert('user_role', $tmpRole);
        }
    }

    header("Location: list_user.php");
}

    $user_id = $_GET['user_id'];
    $value = get_one_data("SELECT * FROM users WHERE user_id='$user_id'");
    $sqlRole = "Select * FROM roles";
    $allRoles = get_all_data($sqlRole);

    $sqlUserRole = "Select * from user_role where user_id='$user_id'";
    $userRoles = get_all_data($sqlUserRole);
    $roleOfUser = [];
    if(!empty($userRoles)){
        foreach ($userRoles as $r){
            $roleOfUser[] = $r['role_id'];
        }
    }
    

?>

<?php include '../layouts/header.php'?>

<div class="update__user">
    <div class="tab__form">
        <form action="update_user.php?user_id=<?=$value['user_id']?>" method="post">
            <input type="hidden" name="user_id" value="<?= $value['user_id'] ?>">
            <div class="tab__form--body">
                <div class="up__user">
                    <h4>Cập nhật tài khoản</h4>
                </div>
                <div class="user-case">
                    <div class="title__case">
                        <h5>Username</h5>
                    </div>
                    <div class="input__update">
                        <input type="text" class="form-control ur-edit" name="username" 
                        placeholder="Enter username" value="<?= $value['user_name'] ?>">
                    </div>
                </div>

                <div class="user-case">
                    <div class="title__case">
                        <h5>Email</h5>
                    </div>
                    <div class="input__update">
                        <input type="email" class="form-control ur-edit" name="email" 
                        placeholder="Enter email"  value="<?= $value['user_email'] ?>">
                    </div>
                </div>

                <div class="user-case">
                    <div class="title__case">
                        <h5>Password</h5>
                    </div>
                    <div class="input__update">
                        <input type="password" class="form-control ur-edit" name="password" 
                        placeholder="Enter password" value="<?= $value['user_password'] ?>">
                    </div>
                </div>

                <div class="user-case">
                    <div class="title__case">
                        <h5>Address</h5>
                    </div>
                    <div class="input__update">
                        <input type="address" class="form-control ur-edit" name="address" 
                        placeholder="Enter address"  value="<?= $value['user_address'] ?>">
                    </div>
                </div>

                <div class="user-case">
                    <div class="title__case">
                        <h5>Phones</h5>
                    </div>
                    <div class="input__update">
                        <input type="text" class="form-control ur-edit" name="phones" 
                        placeholder="Enter phones numbers" value="<?= $value['user_phone'] ?>">
                    </div>
                </div>

                <?php if(canDo('Dang_bai')){ ?>
                    <?php if(!empty($allRoles)){ ?>
                        <div class="user__role">
                            <h5>User's Role</h5>
                            <div class="tab__form--admin">
                                <?php foreach($allRoles as $role){ ?>
                                    <label class="title__role" for="role_<?php echo $role['id']; ?>">
                                        <?php echo $role['name'] ?? '' ?>
                                    </label>
                                    <input type="checkbox" class="check__box" id="role_<?php echo $role['id']; ?>" 
                                    name="role[]" value="<?php echo $role['id'] ?? 0 ?>"
                                    <?php if(in_array($role['id'],$roleOfUser)) echo ' checked '; ?> />
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>

                <div class="input__fruit ">
                    <button type="submit" class="btn">Update</button>
                </div>
        </form>
    </div>
</div>
<?php include '../layouts/footer.php'?>