<?php
    session_start();
    $sessionId = $_SESSION['id'] ?? '';
    $sessionRole = $_SESSION['role'] ?? '';
    echo "$sessionId $sessionRole";
    if ( !$sessionId && !$sessionRole ) {
        header( "location:login.php" );
        die();
    }

    ob_start();

    include_once "config.php";
    $connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
    if ( !$connection ) {
        echo mysqli_error( $connection );
        throw new Exception( "Database cannot Connect" );
    }

    $id = $_REQUEST['id'] ?? 'dashboard';
    $action = $_REQUEST['action'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1024">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/icon/themify-icons/themify-icons.css">  
    <title>Dashboard</title>
</head>

<body>
    <!--------------------------------- Secondary Navber -------------------------------->
    <section class="topber">
        <div class="topber__title">
            <span class="topber__title--text">
                <?php
                    if ( 'dashboard' == $id ) {
                        echo "DashBoard";
                    } elseif ( 'addDepartment' == $id ) {
                        echo "Add Department";
                    } elseif ( 'allDepartment' == $id ) {
                        echo "Department";
                    } elseif ( 'addStaffNoi' == $id ) {
                        echo "Add Staff Noi";
                    } elseif ( 'allStaffNoi' == $id ) {
                        echo "StaffNoi";
                    } elseif ( 'addStaffNgoai' == $id ) {
                        echo "Add Staff Ngoai";
                    } elseif ( 'allStaffNgoai' == $id ) {
                        echo "StaffNgoai";
                    } elseif ( 'userProfile' == $id ) {
                        echo "Your Profile";
                    } elseif ( 'editDepartment' == $action ) {
                        echo "Edit Department";
                    } elseif ( 'editStaffNoi' == $action ) {
                        echo "Edit Staff Noi";
                    }elseif ( 'editStaffNgoai' == $action ) {
                        echo "Edit Staff Ngoai";
                    }
                ?>

            </span>
        </div>

        <div class="topber__profile">
            <?php
                $query = "SELECT fname,lname,role,avatar FROM {$sessionRole}s WHERE id='$sessionId'";
                $result = mysqli_query( $connection, $query );

                if ( $data = mysqli_fetch_assoc( $result ) ) {
                    $fname = $data['fname'];
                    $lname = $data['lname'];
                    $role = $data['role'];
                    $avatar = $data['avatar'];
                ?>
                <img src="assets/img/<?php echo "$avatar"; ?>" height="25" width="25" class="rounded-circle" alt="profile">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                        echo "$fname $lname (" . ucwords( $role ) . " )";
                        }
                    ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="index.php">Dashboard</a>
                        <a class="dropdown-item" href="index.php?id=userProfile">Profile</a>
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                </div>
        </div>
    </section>
    <!--------------------------------- Secondary Navber -------------------------------->


    <!--------------------------------- Sideber -------------------------------->
    <section id="sideber" class="sideber">
        <ul class="sideber__ber">
            <h3 class="sideber__panel"><i id="left" class="fas fa-laugh-wink"></i> Hospital Department</h3>
            <li id="left" class="sideber__item<?php if ( 'dashboard' == $id ) {
                                                  echo " active";
                                              }?>">
                <a href="index.php?id=dashboard"><i id="left" class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <li id="left" class="sideber__item<?php if ( 'list-department' == $id ) {
                                                  echo " active";
                                              }?>">
                <a href="index.php?id=allDepartment"><i id="left" class="fas fa-tachometer-alt"></i>
                    Khoa
                </a>
                <ul class="sideber__ber">
                                        <?php if ( 'admin' == $sessionRole ) {?>
                                            <!-- Only For Admin -->
                                        <li id="left" class="sideber__item sideber__item--modify<?php if ( 'addDepartment' == $id ) {
                                                                                                    echo " active";
                                                                                                }?>">
                                            <a href="index.php?id=addDepartment"><i id="left" class="fas fa-user-plus"></i></i>Thêm Khoa</a>
                                        </li><?php }?>
                                        <li id="left" class="sideber__item<?php if ( 'allDepartment' == $id ) {
                                                                                                    echo " active";
                                                                                                }?>">
                                            <a href="index.php?id=allDepartment"><i id="left" class="fas fa-user"></i>Tất cả khoa</a>
                                        </li>
                </ul>
                <ul class="sideber__ber">
                            <li id="left" class="sideber__item sideber__item--modify<?php if ( 'admin' == $id ) {
                                    echo " active";
                                }?>">
                                <a href="index.php?id=admin"><i id="left" class="fas fa-tachometer-alt"></i>
                                    Khoa Nội 
                                </a>
                                <ul class="sideber__ber">
                                        <?php if ( 'admin' == $sessionRole ) {?>
                                            <!-- Only For Admin -->
                                        <li id="left" class="sideber__item sideber__item--modify<?php if ( 'addStaffNoi' == $id ) {
                                                                                                    echo " active";
                                                                                                }?>">
                                            <a href="index.php?id=addStaffNoi"><i id="left" class="fas fa-user-plus"></i></i>Thêm nhân viên</a>
                                        </li><?php }?>
                                        <li id="left" class="sideber__item<?php if ( 'allStaffNoi' == $id ) {
                                                                                                    echo " active";
                                                                                                }?>">
                                            <a href="index.php?id=allStaffNoi"><i id="left" class="fas fa-user"></i>Tất cả nhân viên</a>
                                        </li>
                                </ul>
                            </li>
                            <li id="left" class="sideber__item sideber__item--modify<?php if ( 'admin' == $id ) {
                                    echo " active";
                                }?>">
                                <a href="index.php?id=admin"><i id="left" class="fas fa-tachometer-alt"></i>
                                    Khoa Ngoại                                  
                                </a>
                                <ul class="sideber__ber">
                                        <?php if ( 'admin' == $sessionRole || 'department' == $sessionRole ) {?>
                                            <!-- For Admin, department -->
                                            <li id="left" class="sideber__item sideber__item--modify<?php if ( 'addStaffNgoai' == $id ) {
                                                                                                        echo " active";
                                                                                                    }?>">
                                                <a href="index.php?id=addStaffNgoai"><i id="left" class="fas fa-user-plus"></i></i>Thêm nhân viên</a>
                                            </li><?php }?>
                                            <li id="left" class="sideber__item<?php if ( 'allStaff' == $id ) {
                                                                                                        echo " active";
                                                                                                    }?>">
                                                <a href="index.php?id=allStaffNgoai"><i id="left" class="fas fa-user"></i>Tất cả nhân viên</a>
                                            </li>
                                    </ul>
                            </li>             
                    </ul>
            </li>
        </ul>
        <footer class="text-center"><span>Hospital</span><br>Tài sản đầu tiên là sức khỏe.</footer>
    </section>
    <!--------------------------------- #Sideber -------------------------------->


    <!--------------------------------- Main section -------------------------------->
    <section class="main">
        <div class="container">

            <!-- ---------------------- DashBoard ------------------------ -->
            <?php if ( 'dashboard' == $id ) {?>
                <div class="dashboard p-5">
                    <div class="total">
                        <div class="row">
                            <div class="col-4">
                                <div class="total__box text-center">
                                    <h1>
                                        <?php
                                            $query = "SELECT COUNT(*) totalDepartment FROM department;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalDepartment = mysqli_fetch_assoc( $result );
                                                echo $totalDepartment['totalDepartment'];
                                            ?>
                                    </h1>
                                    <h2>Khoa</h2>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="total__box text-center">
                                    <h1>
                                        <?php
                                            $query = "SELECT COUNT(*) totalStaffNoi FROM staffNoi;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalStaffNoi = mysqli_fetch_assoc( $result );
                                                echo $totalStaffNoi['totalStaffNoi'];
                                            ?>

                                    </h1>
                                    <h2>Nhân viên khoa nội</h2>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="total__box text-center">
                                    <h1>
                                        <?php
                                            $query = "SELECT COUNT(*) totalStaffNgoai FROM staffNgoai;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalStaffNgoai = mysqli_fetch_assoc( $result );
                                                echo $totalStaffNgoai['totalStaffNgoai'];
                                            ?>

                                    </h1>
                                    <h2>Nhân viên khoa ngoại</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
            <!-- ---------------------- DashBoard ------------------------ -->

            <!-- ---------------------- Department ------------------------ -->
            <div class="department">
                <?php if ( 'allDepartment' == $id ) {?>
                    <div class="allDepartment">
                        <div class="main__table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Avatar</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date of birth</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Salary</th>
                                        <?php if ( 'admin' == $sessionRole ) {?>
                                            <!-- Only For Admin -->
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $getDepartment = "SELECT * FROM department";
                                            $result = mysqli_query( $connection, $getDepartment );

                                        while ( $department = mysqli_fetch_assoc( $result ) ) {?>

                                        <tr>
                                            <td>
                                                <center><img class="rounded-circle" width="40" height="40" src="assets/img/<?php echo $department['avatar']; ?>" alt=""></center>
                                            </td>
                                            <td><?php printf( "%s %s", $department['fname'], $department['lname'] );?></td>
                                            <td><?php printf( "%s", $department['birthday'] );?></td>
                                            <td><?php printf( "%s", $department['address'] );?></td>
                                            <td><?php printf( "%s", $department['email'] );?></td>
                                            <td><?php printf( "%s", $department['department'] );?></td>
                                            <td><?php printf( "%s", $department['gender'] );?></td>
                                            <td><?php printf( "%s", $department['salary'] );?></td>
                                            <?php if ( 'admin' == $sessionRole ) {?>
                                                <!-- Only For Admin -->
                                                <td><?php printf( "<a href='index.php?action=editDepartment&id=%s'><i class='fas fa-edit'></i></a>", $department['id'] )?></td>
                                                <td><?php printf( "<a class='delete' href='index.php?action=deleteDepartment&id=%s'><i class='fas fa-trash'></i></a>", $department['id'] )?></td>
                                            <?php }?>
                                        </tr>

                                    <?php }?>

                                </tbody>
                            </table>


                        </div>
                    </div>
                <?php }?>

                <?php if ( 'addDepartment' == $id ) {?>
                    <div class="addDepartment">
                        <div class="main__form">
                            <div class="main__form--title text-center">Add New Deparment</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="First name" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Last Name" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="birthday" placeholder="Date of birthday" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="address" placeholder="Address" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="text" name="department" placeholder="Department" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-key"></i>
                                            <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                            <i id="pwd" class="fas fa-eye right"></i>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-gender-alt"></i>
                                            <input type="text" name="gender" placeholder="Gender" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="number" name="salary" placeholder="Salary" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="addDepartment">
                                    <div class="col col-12">
                                        <input type="submit" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                <?php }?>

                <?php if ( 'editDepartment' == $action ) {
                        $departmentId = $_REQUEST['id'];
                        $selectDepartment = "SELECT * FROM department WHERE id='{$departmentId}'";
                        $result = mysqli_query( $connection, $selectDepartment );

                    $department = mysqli_fetch_assoc( $result );?>
                    <div class="addDepartment">
                        <div class="main__form">
                            <div class="main__form--title text-center">Update Department</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="First name" value="<?php echo $department['fname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Last Name" value="<?php echo $department['lname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="birthday" placeholder="Date of birthday" value="<?php echo $department['birthday']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="address" placeholder="Address" value="<?php echo $department['address']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" value="<?php echo $department['email']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="text" name="department" placeholder="Department" value="<?php echo $department['department']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-gender-alt"></i>
                                            <input type="text" name="gender" placeholder="Gender" value="<?php echo $department['gender']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="salary" placeholder="Salary" value="<?php echo $department['salary']; ?>" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="updateDepartment">
                                    <input type="hidden" name="id" value="<?php echo $departmentId; ?>">
                                    <div class="col col-12">
                                        <input type="submit" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php }?>

                <?php if ( 'deleteDepartment' == $action ) {
                        $departmentID = $_REQUEST['id'];
                        $deleteDepartment = "DELETE FROM department WHERE id ='{$departmentID}'";
                        $result = mysqli_query( $connection, $deleteDepartment);
                        header( "location:index.php?id=allDepartment" );
                       
                }?>
            </div>
            <!-- ---------------------- department ------------------------ -->

            <!-- ---------------------- Staff Noi------------------------ -->
            <div class="staff">
                <?php if ( 'allStaffNoi' == $id ) {?>
                    <div class="allStaffNoi">
                        <div class="main__table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Avatar</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Gender</th>
                                        <?php if ( 'admin' == $sessionRole || 'department' == $sessionRole ) {?>
                                            <!-- For Admin, department -->
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $getStaffNoi = "SELECT * FROM staffNoi";
                                            $result = mysqli_query( $connection, $getStaffNoi );

                                        while ( $staffNoi = mysqli_fetch_assoc( $result ) ) {?>

                                        <tr>
                                            <td>
                                                <center><img class="rounded-circle" width="40" height="40" src="assets/img/<?php echo $staffNoi['avatar']; ?>" alt=""></center>
                                            </td>
                                            <td><?php printf( "%s %s", $staffNoi['fname'], $staffNoi['lname'] );?></td>
                                            <td><?php printf( "%s", $staffNoi['email'] );?></td>
                                            <td><?php printf( "%s", $staffNoi['phone'] );?></td>
                                            <td><?php printf( "%s", $staffNoi['gender'] );?></td>
                                            <?php if ( 'admin' == $sessionRole || 'department' == $sessionRole ) {?>
                                                <!-- For Admin, department -->
                                                <td><?php printf( "<a href='index.php?action=editStaffNoi&id=%s'><i class='fas fa-edit'></i></a>", $staffNoi['id'] )?></td>
                                                <td><?php printf( "<a class='delete' href='index.php?action=deleteStaffNoi&id=%s'><i class='fas fa-trash'></i></a>", $staffNoi['id'] )?></td>
                                            <?php }?>
                                        </tr>

                                    <?php }?>

                                </tbody>
                            </table>


                        </div>
                    </div>
                <?php }?>

                <?php if ( 'addStaffNoi' == $id ) {?>
                    <div class="addStaff">
                        <div class="main__form">
                            <div class="main__form--title text-center">Add New Staff</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="First name" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Last Name" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-key"></i>
                                            <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                            <i id="pwd" class="fas fa-eye right"></i>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-gender-alt"></i>
                                            <input type="text" name="gender" placeholder="Gender" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="addStaffNoi">
                                    <div class="col col-12">
                                        <input type="submit" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                <?php }?>

                <?php if ( 'editStaffNoi' == $action ) {
                        $staffNoiID = $_REQUEST['id'];
                        $selectStaffNoi = "SELECT * FROM staffNoi WHERE id='{$staffNoiID}'";
                        $result = mysqli_query( $connection, $selectStaffNoi );

                    $staffNoi = mysqli_fetch_assoc( $result );?>
                    <div class="addDepartment">
                        <div class="main__form">
                            <div class="main__form--title text-center">Update staffNoi</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="First name" value="<?php echo $staffNoi['fname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Last Name" value="<?php echo $staffNoi['lname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" value="<?php echo $staffNoi['email']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" value="<?php echo $staffNoi['phone']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-gender-alt"></i>
                                            <input type="text" name="gender" placeholder="Gender" value="<?php echo $staffNoi['gender']; ?>" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="updateStaffNoi">
                                    <input type="hidden" name="id" value="<?php echo $staffNoiID; ?>">
                                    <div class="col col-12">
                                        <input type="submit" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php }?>

                <?php if ( 'deleteStaffNoi' == $action ) {
                        $staffNoiID = $_REQUEST['id'];
                        $deleteStaffNoi = "DELETE FROM staffNoi WHERE id ='{$staffNoiID}'";
                        $result = mysqli_query( $connection, $deleteStaffNoi );
                        header( "location:index.php?id=allStaffNoi" );
                }?>
            </div>
            <!-- ---------------------- Staff Noi------------------------ -->

            <!-- ---------------------- Staff Ngoai ------------------------ -->
            <div class="staff">
                <?php if ( 'allStaffNgoai' == $id ) {?>
                    <div class="allStaffNgoai">
                        <div class="main__table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Avatar</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Gender</th>
                                        <?php if ( 'admin' == $sessionRole || 'department' == $sessionRole ) {?>
                                            <!-- For Admin, department -->
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $getStaffNgoai = "SELECT * FROM staffNgoai";
                                            $result = mysqli_query( $connection, $getStaffNgoai );

                                        while ( $staffNgoai = mysqli_fetch_assoc( $result ) ) {?>

                                        <tr>
                                            <td>
                                                <center><img class="rounded-circle" width="40" height="40" src="assets/img/<?php echo $staffNgoai['avatar']; ?>" alt=""></center>
                                            </td>
                                            <td><?php printf( "%s %s", $staffNgoai['fname'], $staffNgoai['lname'] );?></td>
                                            <td><?php printf( "%s", $staffNgoai['email'] );?></td>
                                            <td><?php printf( "%s", $staffNgoai['phone'] );?></td>
                                            <td><?php printf( "%s", $staffNgoai['gender'] );?></td>
                                            <?php if ( 'admin' == $sessionRole || 'department' == $sessionRole ) {?>
                                                <!-- For Admin, department -->
                                                <td><?php printf( "<a href='index.php?action=editStaffNgoai&id=%s'><i class='fas fa-edit'></i></a>", $staffNgoai['id'] )?></td>
                                                <td><?php printf( "<a class='delete' href='index.php?action=deleteStaffNgoai&id=%s'><i class='fas fa-trash'></i></a>", $staffNgoai['id'] )?></td>
                                            <?php }?>
                                        </tr>

                                    <?php }?>

                                </tbody>
                            </table>


                        </div>
                    </div>
                <?php }?>

                <?php if ( 'addStaffNgoai' == $id ) {?>
                    <div class="addStaff">
                        <div class="main__form">
                            <div class="main__form--title text-center">Add New Staff</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="First name" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Last Name" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-key"></i>
                                            <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                            <i id="pwd" class="fas fa-eye right"></i>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-gender-alt"></i>
                                            <input type="text" name="gender" placeholder="Gender" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="addStaffNgoai">
                                    <div class="col col-12">
                                        <input type="submit" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                <?php }?>

                <?php if ( 'editStaffNgoai' == $action ) {
                        $staffNgoaiID = $_REQUEST['id'];
                        $selectStaffNgoai = "SELECT * FROM staffNgoai WHERE id='{$staffNgoaiID}'";
                        $result = mysqli_query( $connection, $selectStaffNgoai );

                    $staffNgoai = mysqli_fetch_assoc( $result );?>
                    <div class="addDepartment">
                        <div class="main__form">
                            <div class="main__form--title text-center">Update staffNgoai</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="First name" value="<?php echo $staffNgoai['fname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Last Name" value="<?php echo $staffNgoai['lname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" value="<?php echo $staffNgoai['email']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" value="<?php echo $staffNgoai['phone']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-gender-alt"></i>
                                            <input type="text" name="gender" placeholder="Gender" value="<?php echo $staffNgoai['gender']; ?>" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="updateStaffNgoai">
                                    <input type="hidden" name="id" value="<?php echo $staffNgoaiID; ?>">
                                    <div class="col col-12">
                                        <input type="submit" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php }?>

                <?php if ( 'deleteStaffNgoai' == $action ) {
                        $staffNgoaiID = $_REQUEST['id'];
                        $deleteStaffNgoai = "DELETE FROM staffNgoai WHERE id ='{$staffNgoaiID}'";
                        $result = mysqli_query( $connection, $deleteStaffNgoai );
                        header("location:index.php?id=allStaffNgoai");
                }?>
            </div>
            <!-- ---------------------- Staff Ngoai ------------------------ -->

            <!-- ---------------------- User Profile ------------------------ -->
            <?php if ( 'userProfile' == $id ) {
                    $query = "SELECT * FROM {$sessionRole}s WHERE id='$sessionId'";
                    $result = mysqli_query( $connection, $query );
                    $data = mysqli_fetch_assoc( $result )
                ?>
                <div class="userProfile">
                    <div class="main__form myProfile">
                        <form action="index.php">
                            <div class="main__form--title myProfile__title text-center">My Profile</div>
                            <div class="form-row text-center">
                                <div class="col col-12 text-center pb-3">
                                    <img src="assets/img/<?php echo $data['avatar']; ?>" class="img-fluid rounded-circle" alt="">
                                </div>
                                <div class="col col-12">
                                    <h4><b>Full Name : </b><?php printf( "%s %s", $data['fname'], $data['lname'] );?></h4>
                                </div>
                                <div class="col col-12">
                                    <h4><b>Email : </b><?php printf( "%s", $data['email'] );?></h4>
                                </div>
                                <div class="col col-12">
                                    <h4><b>Phone : </b><?php printf( "%s", $data['phone'] );?></h4>
                                </div>
                                <input type="hidden" name="id" value="userProfileEdit">
                                <div class="col col-12">
                                    <input class="updateMyProfile" type="submit" value="Update Profile">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php }?>

            <?php if ( 'userProfileEdit' == $id ) {
                    $query = "SELECT * FROM {$sessionRole}s WHERE id='$sessionId'";
                    $result = mysqli_query( $connection, $query );
                    $data = mysqli_fetch_assoc( $result )
                ?>


                <div class="userProfileEdit">
                    <div class="main__form">
                        <div class="main__form--title text-center">Update My Profile</div>
                        <form enctype="multipart/form-data" action="add.php" method="POST">
                            <div class="form-row">
                                <div class="col col-12 text-center pb-3">
                                    <img id="pimg" src="assets/img/<?php echo $data['avatar']; ?>" class="img-fluid rounded-circle" alt="">
                                    <i class="fas fa-pen pimgedit"></i>
                                    <input onchange="document.getElementById('pimg').src = window.URL.createObjectURL(this.files[0])" id="pimgi" style="display: none;" type="file" name="avatar">
                                </div>
                                <div class="col col-12">
                                <?php if ( isset( $_REQUEST['avatarError'] ) ) {
                                            echo "<p style='color:red;' class='text-center'>Please make sure this file is jpg, png or jpeg</p>";
                                    }?>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-user-circle"></i>
                                        <input type="text" name="fname" placeholder="First name" value="<?php echo $data['fname']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-user-circle"></i>
                                        <input type="text" name="lname" placeholder="Last Name" value="<?php echo $data['lname']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-envelope"></i>
                                        <input type="email" name="email" placeholder="Email" value="<?php echo $data['email']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-phone-alt"></i>
                                        <input type="number" name="phone" placeholder="Phone" value="<?php echo $data['phone']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-key"></i>
                                        <input id="pwdinput" type="password" name="oldPassword" placeholder="Old Password" required>
                                        <i id="pwd" class="fas fa-eye right"></i>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-gender-alt"></i>
                                        <input type="input" name="gender" placeholder="Gender value="<?php echo $data['gender']; ?>" required>
                                    </label>
                                </div>
                                <input type="hidden" name="action" value="updateProfile">
                                <div class="col col-12">
                                    <input type="submit" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php }?>
            <!-- ---------------------- User Profile ------------------------ -->

        </div>

    </section>

    <!--------------------------------- #Main section -------------------------------->



    <!-- Optional JavaScript -->
    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Custom Js -->
    <script src="./assets/js/app.js"></script>
</body>

</html>