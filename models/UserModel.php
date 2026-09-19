<?php
require_once "Database1.php";

class UserModel {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }
    public function updatePhoto($id, $photoPath) {
        $query = "UPDATE users SET photo = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$photoPath, $id]);
    }
    
    public function updateUser($id, $email, $birthday, $gender, $security_question, $security_answer) {
        try {
            $query = "UPDATE users 
                      SET email = :email, birthday = :birthday, gender = :gender, 
                          security_question = :security_question, security_answer = :security_answer 
                      WHERE id = :id";
    
            $stmt = $this->pdo->prepare($query);
    
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':birthday', $birthday);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':security_question', $security_question);
            $stmt->bindParam(':security_answer', $security_answer);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false; 
        }
    }
    

    public function register($first_name, $last_name, $email, $password, $gender, $birthday, $security_question, $security_answer) {
        try {
            if ($this->checkEmailExistance($email)) {
                return false; 
            }

            // Hash the password before storing it
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users 
                      (first_name, last_name, email, password, gender, birthday, security_question, security_answer) 
                      VALUES (:first_name, :last_name, :email, :password, :gender, :birthday, :security_question, :security_answer)";

            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':gender', $gender);
            $date = DateTime::createFromFormat('d/m/Y', $birthday);
            $birthday = $date->format('Y-m-d');
            $stmt->bindParam(':birthday', $birthday);
            $stmt->bindParam(':security_question', $security_question);
            $stmt->bindParam(':security_answer', $security_answer);
            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    public function checkEmailExistance($email) {
        try {
            $query = "SELECT COUNT(*) FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0; 
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    // Login function to verify email and password
    public function login($email, $password) {
        try {
            $query = "SELECT password FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Check if email exists
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                // Verify if the password matches the stored hash
                if (password_verify($password, $user['password'])) {
                    return true; // Successful login
                } else {
                    return false; // Incorrect password
                }
            } else {
                return false; // Email not found
            }
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
    public function verifyUserResetPassword($email, $security_question, $security_answer) {
        try {
            $query = "SELECT security_question, security_answer FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user['security_question'] === $security_question && $user['security_answer'] === $security_answer) {
                    return true; // Correct security question and answer
                }
            }

            return false; // Incorrect data or user does not exist
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false; // Return false in case of any database error
        }
    }
    public function changePassword($email, $newPassword) {
    try {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        $query = "UPDATE users SET password = :password WHERE email = :email";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $email);

        return $stmt->execute();

    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}
public function currentUser($email) {
    try {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Check if user exists
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC); // Return all user data as an associative array
        } else {
            return false; // User not found
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return false; // Return false in case of any database error
    }
}


}
?>
