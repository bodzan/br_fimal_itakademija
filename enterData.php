<?php


class enterData
{
    private $conn;

    private $required_data = ['holder_name', 'dob', 'passport', 'email', 'start_date', 'end_date'];
    private $optional_data = ['telephone', 'option'];

    private $sanitized = [];
    private $returned_data = [];

    private $host = 'mysql';
    private $username = 'root';
    private $password = 'root';
    private $dbname = 'paralax';



    public  function  __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
    }

    /**
     * @param $data
     * @return array
     *
     * Sanitize the data in an array provided to the function
     */
    public function sanitizeData($data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $key2 => $value2) {
                    $var = mysqli_real_escape_string($this->conn, $value2);
                    $var = htmlspecialchars($var);

                    $this->sanitized[$key][$key2] = true;

                    $this->returned_data[$key][$key2] = $var;
                }
            } else {
                $var = mysqli_real_escape_string($this->conn, $_POST[$key]);
                $var = htmlspecialchars($var);

                $this->sanitized[$key] = true;

                $this->returned_data[$key] = $var;

            }
        }

        return $this->returned_data;

    }

    /**
     * This method will only be used within this class so it should be kept private
     * And it will check if the number of sanitised data is the same as the provided ones
     *
     * @param $data - provided data
     *
     * @return bool
     */
    private function sanitizedData ($data)
    {

        return (count($this->sanitized) == count($data)) ? true : fakse;

    }

    /**
     *
     * This method will only be used within this class so it should be kept private
     *
     * @param $var - variable to check length
     * @param $length - integer to check the variable length against
     * @return bool - true if the variable is of the same length and false if not
     */
    private function checkLength($var, $length)
    {
        $len = strlen($var);

        return ($len == $length) ? true : false;
    }

    public function writeToDatabase()
    {
        /**
         * Current date and time in timestamp form
         */
        $date = time();

        /**
         * Insert data to policies
         */
        $sql = "INSERT INTO policies 
        (date, holder_name, dob, passport_no, telephone, email, start_date, end_date) 
        VALUES('" . $date . " ','" . $this->returned_data['holder_name'] . "','" . strtotime($this->returned_data['dob']). "','" . $this->returned_data['passport'] . "',' " . $this->returned_data['telephone'] . "',' " . $this->returned_data['email'] . "','" . strtotime($this->returned_data['start_date']) . "','" . strtotime($this->returned_data['end_date']) . "')";


        $this->conn->query($sql);

        $p_id = $this->conn->insert_id;


        $created = time();

        /**
         * insert data to groups table
         */
        $sql_c = "INSERT INTO groups (created)
                VALUES ($created)";

        $this->conn->query($sql_c);

        $g_id = $this->conn->insert_id;


        /**
         * Insert data to policy group table
         */

        $sql_pg = "INSERT INTO policy_group (policy_id, group_id)
            VALUES (" . $p_id . "," . $g_id . ")";

        $this->conn->query($sql_pg);

        if (isset($this->returned_data['option']) && $this->returned_data['option'] == 'grp') {

            /**
             * Insert data to group members table
             */
            if (isset($this->returned_data['member_name']) && is_array($this->returned_data['member_name'])) {

                for ($i =0; $i < count($this->returned_data['member_name']); $i++) {
                    $sql_gm = "INSERT INTO group_members
                (group_id, name, dob, passport_no)
                VALUES ('" . $g_id . "','" . $this->returned_data['member_name'][$i] . "','" . strtotime($this->returned_data['member_dob'][$i]) . "','" . $this->returned_data['member_passport'][$i] . "')";

                    $this->conn->query($sql_gm);

                }
            }

        }

        return true;

    }



}