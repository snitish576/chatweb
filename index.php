<?php
session_start();
if (isset($_SESSION["sid"])) {

    header("location:chat.php");
    //yoo man
}

?>

<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="final.css" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function check() {
            if (frm.pa.value != frm.cpa.value) {
                frm.cpa.setCustomValidity("Password Not Matches");
                return false;
            } else {
                if (frm.pa.value.length < 8) {
                    frm.cpa.setCustomValidity("Password Too Small Must be Greater than 8 Characters");
                    return false;
                } else {
                    frm.cpa.setCustomValidity("");
                    return true;
                }
            }

        }

        function ch() {

            var pat = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

            if (pat.test(frm.name.value)) {
                frm.name.setCustomValidity("Special Characters in name are not allowed");
                return false;

            }

            if (frm.name.value.trim() == '') {
                frm.name.setCustomValidity("Extra space in Name");
                return false;
            } else {
                frm.name.setCustomValidity("");
                return true;
            }

        }

        function ch1() {

            if (frm.uname.value.trim() == '') {
                frm.uname.setCustomValidity("Extra space in UserName");
                return false;
            } else {
                frm.uname.setCustomValidity("");
                return true;
            }



        }
    </script>
</head>


<body>
    <div class="one">
        <div class="name">
            <table>
                <tr>
                    <td class="pl"><b>C</b></td>
                    <td class="pl"><b>H</b></td>
                    <td class="pl"><b>A</b></td>
                    <td class="pl"><b>T</b></td>
                    <td class="pl"><b>T</b></td>
                    <td class="pl"><b>I</b></td>
                    <td class="pl"><b>N</b></td>
                    <td class="pl"><b>G</b></td>
                </tr>
            </table>
            <table id="pqr">
                <tr>
                    <td class="plz"><b> </b></td>
                    <td class="plz"><b> </b></td>

                    <td class="plz"><b> </b></td>
                    <td class="plz"><b> </b></td>

                </tr>
            </table>
        </div>
        <div class="banty">
            <form name="frm" method="post" action="">
                <table>
                    <th id="abc">
                        <center>Sign Up</center>
                    </th>
                    <tr>
                        <td>
                            <span class="flex-span">Name:</span><span class="flex-in"><input type="text" name="name" id="name" required="" placeholder="Aap Ka Nam" oninput="ch();"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="flex-span">Username:</span><span class="flex-in"><input type="text" name="uname" required="" oninput="ch1();" placeholder="Dosron ko Dikhane Wala Nam"></span>
                        </td>
                    </tr>
                    <tr>
                        <td id="trivedi">
                            <p id="shampy">This is the name which will be visible to others.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="flex-span">Email:</span><span class="flex-in"><input type="email" name="email" required="" placeholder="Aap ki E-mail"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="flex-span">Password:</span> <span class="flex-in"><input type="password" name="password" id="pa" required="" placeholder="Suraksha Kawach"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="flex-span">Conf. Pass:</span><span class="flex-in"><input type="password" name="cpass" id="cpa" required="" oninput="check();" placeholder="Double Protection"></span>
                        </td>
                    </tr>
                    <tr>
                        <td id="none">
                            <input type="submit" id="parulkar" value="Sign Up" name="signup">
                        </td>
                    </tr>
                    <tr>
                        <td id="trivedi">
                            <p id="jojo">Already have an account! <a href="/login.php" id="mary">Login In</a></p>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>
<?php
include("dbcon1.php");

if (isset($_POST['signup'])) {
    $name = ucfirst($_POST['name']);
    $em = $_POST['email'];
    $cp = md5($_POST['cpass']);
    $st = 0;
    $log = date("Y-m-d H:i:s");
    $sec = 0;
    $bio = "";
    if ($name == '' && $em == '') {

        die("Connection failed,Try again later");
    }

    $query = "insert into record values(?,?,?,?,?,?,?,?)";



    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, "isssisss", $id, $name, $em, $cp, $st, $log, $sec, $bio);

        if (mysqli_stmt_execute($stmt)) {
            $tbl = "table_" . mysqli_insert_id($con);
            $run = mysqli_query($con, "create table $tbl(id int primary key auto_increment,key_from int,key_to int,msg longtext,time varchar(233), status int(1))");

?>

            <script>
                swal({
                    title: "Successfully SignedUp",
                    text: "Use your email and password for login",
                    button: "OK",
                    icon: "success",

                }).then(function() {
                    v = false;
                    window.location.href = "/login.php";

                });
            </script>
            <?php
        } else {
            $error = mysqli_error($con);
            if (strpos($error, "PRIMARY") == true) {
            ?>
                <script>
                    swal("Email Already Exist", "", "warning");
                </script>
<?php
            } else {
                die("ERROR" . mysqli_error($con));
            }
        }
    }
}

?>