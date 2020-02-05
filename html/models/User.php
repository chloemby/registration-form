<?php


namespace Models;


class User extends Model
{
    private static $tableName = 'users';
    public $name = '';
    public $surname = '';
    public $email = '';
    public $password = '';
    public $image = '';
    private $id = null;

    public function save()
    {
        if ($this->id) {
            $query = "update $this->tableName set 
                 name=$this->name, 
                 surname=$this->surname, 
                 password=$this->password, 
                 image=$this->image,
                 email=$this->email,
                 ";
            $stmt = self::$connection->prepare($query);
            $stmt->bind_param('sssbs', $this->name, $this->surname, $this->password, $this->image, $this->email);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        $tableName = self::$tableName;
        $query = "insert into $tableName (name, surname, password, email, image) values (?, ?, ?, ?, ?)";
        $stmt = self::$connection->prepare($query);
        $stmt->bind_param('sssss', $this->name, $this->surname, $this->password, $this->email, $this->image);
        $stmt->execute();
        $this->id = $stmt->insert_id;
        if ($this->id == 0) {
            return false;
        }
        return $this->id;
    }

    public static function find(int $id)
    {
        $tableName = self::$tableName;
        $query = "select name, surname, email, image from $tableName where id=$id";
        $user = self::$connection->query($query)->fetch_all(MYSQLI_ASSOC);
        return $user;
    }
    public static function confirm(string $email, string $password) {
        $tableName = self::$tableName;
        $query = "select id, name, surname, email, password, image from $tableName where email=?";
        $stmt = self::$connection->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
        if (!$user) {
            return false;
        }
        if (!password_verify($password, $user['password'])) {
            return false;
        }
        return self::getObjectFromArray($user);
    }

    public function getId()
    {
        return $this->id;
    }

    private static function getObjectFromArray(array $arrayUser) {
        $user = new User;
        $user->email = $arrayUser['email'];
        $user->image = $arrayUser['image'];
        $user->id = $arrayUser['id'];
        $user->surname = $arrayUser['surname'];
        $user->name = $arrayUser['name'];
        return $user;
    }

}