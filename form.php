<?php
$db = mysqli_connect("localhost", "root", "", "regform");

class  Registration
{
    public function __construct()
    {
        if (array_key_exists('firstname', $_POST)) {
            $this->post();
        } else if (isset($_GET['info'])) {
            $this->get();
        }
        else if (isset($_GET['index'])) {
            $this->table();
        }
    }
    public function post()

    {
        global $db;
        $output = "";
        extract($_POST);
        extract($_POST);
        $sql = $db->query("INSERT INTO ftable (surname,firstname,othername,gender,school,class,phone,address,state,lga) VALUES ('$surname','$firstname','$othername','$gender','$school','$class','$phone','$address','$state','$lga')") or die($db->error);

        if ($sql) {
            $id = $db->insert_id;
            $output = array('id' => $id, 'surname' => $surname, 'firstname' => $firstname, 'othername' => $othername, 'gender' => $gender, 'school' => $school, 'class' => $class);
            echo json_encode($output);
            return;
        }
        return;
    }
    public function get()
    {
        global $db;
        extract($_GET);
        $sql = $db->query("SELECT * FROM ftable where id='$info'");
        $row = $sql->fetch_assoc();
        echo json_encode($row);
        return;
    }
    function table()
    {
        global $db;
        extract($_GET);
        $output = '';

        $sql = $db->query("SELECT * FROM ftable");


        while ($row = $sql->fetch_object()) {
            $output .= '
                <tr id=' . $row->id . '>
                <td>' . "" . '</td>
                    <td>' . $row->surname . '</td>
                    <td>' . $row->firstname . '</td>
                    <td>' . $row->othername . '</td>
                    <td>' . $row->gender . '</td>
                    <td>' . $row->school . '</td>
                    <td>' . $row->class . '</td>
                    <td>' . '<button class="btn btn-primary detailsbtn">Details</button>'.'</td>
                </tr>';
        }
        echo $output;
        return;
    }
}
$reg = new Registration();
