<?php
//Check if email is unique
function checkUserByEmail($email, $current_id = 0)
{
    global $db;
    // $sql = "SELECT * FROM users ";
    // $sql .= "WHERE email='" . $db->escape_string($email) . "' ";
    // $sql .= "AND id!='" . $db->escape_string($current_id) . "'";
    // $result = $db->query($sql);
    // return $result->num_rows;
    // Alt using prepared statements
    $stmt = $db->prepare("SELECT * FROM users WHERE email =? AND id!=?");
    $stmt->bind_param('si', $email, $current_id);

    //execute returns the number of affected rows
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows;
}

function checkUserByUsername($username, $current_id = 0)
{
    global $db;
    // $sql = "SELECT * FROM users ";
    // $sql .= "WHERE username='" . $db->escape_string($username) . "' ";
    // $sql .= "AND id!='" . $db->escape_string($current_id) . "'";
    // $result = $db->query($sql);
    // return $result->num_rows;
    $stmt = $db->prepare("SELECT * FROM users WHERE username=? AND id!=?");
    $stmt->bind_param('si', $username, $current_id);

    //execute returns the number of affected rows
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows;
}

function checkUserByCode($code)
{
    global $db;
    $stmt = $db->prepare('SELECT * FROM users WHERE reset_code=?');
    $stmt->bind_param('s', $code);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 1) {
        return true;
    } else {
        return false;
    }
}

// find user by username
function findUserByUsername($username)
{
    global $db;
    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username='" . $db->escape_string($username) . "'";
    $result = $db->query($sql);
    $user = $result->fetch_object();
    if (!empty($user)) {
        return $user;
    } else {
        return false;
    }
}

// find user by email
function findUserByEmail($email)
{
    global $db;
    $sql = "SELECT * FROM users ";
    $sql .= "WHERE email='".$db->escape_string($email)."'";
    $result = $db->query($sql);
    $user = $result->fetch_object();
    if (!empty($user)) {
        return $user;
    } else {
        return false;
    }
}

// find user by id
function getUserById($id)
{
    global $db;
    $sql = "SELECT * FROM users ";
    $sql .= "WHERE id='".$db->escape_string($id)."'";
    $result = $db->query($sql);
    $user = $result->fetch_object();
    if (!empty($user)) {
        return $user;
    } else {
        return false;
    }
}

//
function verifyUserAccount($code)
{
    global $db;
    $stmt = $db->prepare("UPDATE users SET is_active='1', reset_code='' WHERE reset_code=? LIMIT 1");
    $stmt->bind_param('s', $code);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->affected_rows == 1) {
        return true;
    } else {
        return false;
    }
}
// check user account is active
function checkUserActivation($username)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE is_active=1 AND username=?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 1) {
        return true;
    } else {
        return false;
    }
}

// @todo add an id for validating wnen making edits
function has_unique_username($username)
{
    $count = checkUserByUsername($username);
    if ($count > 0) {
        return false;
    } else {
        return true;
    }
}

// @todo add an id for validating when making edits
function has_unique_email($email)
{
    $count = checkUserByEmail($email);
    if ($count > 0) {
        return false;
    } else {
        return true;
    }
}

function insert_user($user = [])
{
    //@todo validate inputs
    $name = $user['name'];
    $username = $user['username'];
    $email = $user['email'];
    $password = $user['password'];
    $website = $user['website'];
    $image = $user['image'];
    $code = $user['reset_code'];
    global $db;
    $stmt = $db->prepare("INSERT INTO users(name, username, email, password, website, image, created_at, reset_code) VALUES (?,?,?,?,?,?,?,?)");
    $today = time();
    $stmt->bind_param('ssssssis', $name, $username, $email, $password, $website, $image, $today, $code);
    $stmt->execute();
    if ($stmt->affected_rows === 0) {
        $msg = 'Insert query failed';
        exit($msg);
    } else {
        return true;
    }
}

// set reset code for user
function set_code($email, $code)
{
    global $db;
    $stmt = $db->prepare("UPDATE users SET reset_code=? WHERE email=? LIMIT 1");
    $stmt->bind_param('ss', $code, $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->affected_rows == 1) {
        return true;
    } else {
        $msg = 'Query failed' . $db->error;
        exit($msg);
    }
}

// reset user code for password reset
function reset_user_code($email, $code)
{
    global $db;
    $stmt = $db->prepare("UPDATE users SET is_active=0, reset_code=? WHERE email=? LIMIT 1");
    $stmt->bind_param('ss', $code, $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->affected_rows == 1) {
        return true;
    } else {
        exit('Query failed: '. $db->error);
    }
}

function reset_password($code, $new_password)
{
    global $db;
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    $stmt = $db->prepare("UPDATE users SET password=? WHERE reset_code=? LIMIT 1");
    $stmt->bind_param('ss', $hashed_password, $code);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->affected_rows == 1) {
        return true;
    } else {
        exit('Query failed: '.$db->error);
    }
}

// Update user details
function update_user($user_id, $options = [])
{
    // @todo add website,password
    // determine query to run based on options
    global $db;
    $query = "UPDATE users SET ";
    if (isset($options['name'])  && !is_blank($options['name'])) {
        $name = $options['name'];
        $query .= "name ='" .$db->escape_string($name). "', ";
    }
    if (isset($options['image']) && !is_blank($options['image'])) {
        $image = $options['image'];
        $query .= "image ='".$db->escape_string($image)."', ";
    }
    if (isset($options['website']) && !is_blank($options['website'])) {
        $website = $options['website'];
        $query .= "website='".$db->escape_string($options['website'])."' ";
    }
    if (isset($options['password']) && !is_blank($options['password'])) {
        $hashed_password = password_hash($options['password'], PASSWORD_BCRYPT);
        $query .= "password ='".$db->escape_string($hashed_password)."' ";
    }
    if (isset($options['is_active']) && !is_blank($options['is_active'])) {
        $active = $options['is_active'];
        $query .= "is_active ='".$db->escape_string($active)."' ";
    }
    $query .= "WHERE id='".$db->escape_string($user_id)."' ";
    $query .= "LIMIT 1";

    if ($db->query($query)) {
        return true;
    } else {
        $msg = $db->error;
        exit($msg);
    }
}
