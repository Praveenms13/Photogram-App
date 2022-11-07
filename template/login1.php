<?php    //Substitute Page of Login This is not secure instead use login.php(incompleted one)
include "../libs/load.php";
if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
}


if (isset($_GET['logout']))
{
    Session::destroy();
    loadAccess("loginform");
} 
else if (!isset($_GET['logout']))
{
    if(Session::get('userdata')){
        loadAc("album");
    }
    else{
        $LoginisValid = user::login($username, $password);    
        if ($LoginisValid) {
            Session::set('userdata', $LoginisValid);
            loadAc("album");
        } else {
            loadAccess("loginform");
        }
        
    }
}
else
{
    throw new Exception("Session is invalid");
}




// if (Session::get('_is_Login')) {
//     $userclass = Session::get('session_username');
//     loadAc("album");
// } else {
//     $isConnect = user::login($username, $password);
//     if ($isConnect) {
//         Session::set('_is_Login', true);
//         Session::set('session_username', $isConnect);
//     } else {
//         loadAccess("loginform");
//     }
// }

// echo <<<EOL
// <br><br><br>
// <a href = "testlogin.php?logout">Logout</a>
// EOL; 
?>