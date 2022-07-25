<?php
        class Task{

        // Connection
        private $conn;

        // Table
        private $db_table;

        // Columns
        public $id;
        public $description;
        public $owner;
        public $status;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
            $this->db_table = getenv('MARIADB_TABLE');
        }

        // GET ALL
        public function getTasks(){
            $sqlQuery = "SELECT id, description, owner, status, created FROM " . $this->db_table . " ORDER by id DESC";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createTask(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        description = :description, 
                        owner = :owner, 
                        status = :status, 
                        created = :created";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->owner=htmlspecialchars(strip_tags($this->owner));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":owner", $this->owner);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // GET SINGLE TASK DATA
        public function getSingleTask(){
            $sqlQuery = "SELECT
                        id, 
                        description, 
                        owner, 
                        status, 
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->description = $dataRow['description'];
            $this->owner = $dataRow['owner'];
            $this->status = $dataRow['status'];
            $this->created = $dataRow['created'];
        }        

        // GET X LATEST TASKS
        public function getLatestTasks($len, $owner){
            if ($owner == '') {
                $sqlQuery = 
                    "SELECT
                        id, description, owner, status, created
                    FROM
                        ". $this->db_table ."
                    ORDER BY id DESC
                    LIMIT ?";
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->bindParam(1, $len, PDO::PARAM_INT);
            } else {
                if ($len == '') { 
                    $sqlQuery = 
                        "SELECT
                            id, description, owner, status, created
                        FROM
                            ". $this->db_table ."
                        WHERE
                            owner = ?
                        ORDER BY id DESC";
                        $stmt = $this->conn->prepare($sqlQuery);
                        $stmt->bindParam(1, $owner, PDO::PARAM_STR);
                } else {
                    $sqlQuery = 
                        "SELECT
                            id, description, owner, status, created
                        FROM
                            ". $this->db_table ."
                        WHERE
                            owner = ?
                        ORDER BY id DESC
                        LIMIT ?";
                        $stmt = $this->conn->prepare($sqlQuery);
                        $stmt->bindParam(1, $owner, PDO::PARAM_STR);
                        $stmt->bindParam(2, $len, PDO::PARAM_INT);
                }
            } 
            $stmt->execute();
            return $stmt;
        }        


        // UPDATE
        public function updateTask(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        description = :description, 
                        owner = :owner, 
                        status = :status, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->owner=htmlspecialchars(strip_tags($this->owner));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":owner", $this->owner);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteTask(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }


    //
    //
    // Implementation of the client-end calls of api
    //
    //

    class ClientTask extends Task {

        // Add new constructor without arguments (inheritance)
        public function __construct($api_url) {
            $this->url_prefix = $api_url;
        }

        // HTTP destination prefix
        private $url_prefix;

        // Optional parameter postfix to url. Start string with "?" when using this.
        private $url_params;
 
        // Set all task fields $this->... and call this function to add the task into db.
        // The value of $this->id will not be sent: assuming db has auto-increment
        public function postRow() {
            $this->url_params = "";
            $api_name = "create.php";

            $message_body = array(
                "description" => $this->description,
                "owner" => $this->owner,
                "status" => $this->status,
                "created" => $this->created
            );
            $this->http_post($api_name, json_encode($message_body));
        }

        // Returns array containing all db tasks
        public function getAll($len, $owner) {
            if (($len != '') && ($owner != ''))
                $this->url_params = "?len=" . $len . "&owner=" . $owner;
            else {
                if ($len != '')
                    $this->url_params = "?len=" . $len;
                elseif ($owner != '')
                    $this->url_params = "?owner=" . $owner;
                else
                    $this->url_params = "";
            }

            $api_name = "read.php";
            $all_json_rows = $this->http_get($api_name);           
            return json_decode($all_json_rows, true);
        }

        // Returns array containing $len newest tasks.
        public function getLatest($len) {
            $this->url_params = "?len=" . $len;
            $api_name = "latest_read.php";
            $all_json_rows = $this->http_get($api_name);           
            return json_decode($all_json_rows, true);
        }

        // Updates fields of task indexed by $this->id
        public function updateRow() {
            $this->url_params = "";
            $api_name = "update.php";

            $message_body = array(
                "id" => $this->id,
                "description" => $this->description,
                "owner" => $this->owner,
                "status" => $this->status,
                "created" => $this->created
            );
            $this->http_post($api_name, json_encode($message_body));
        }

        // Retrieves single task indexed by $id 
        public function getRow($id) {
            $this->url_params = "?id=" . $id;
            $api_name = "single_read.php";
            $json_row = $this->http_get($api_name);           
            return json_decode($json_row, true);
        }

        // Deletes a task indexed by $this->id  
        public function deleteRow() {
            $this->url_params = "";
            $api_name = "delete.php";

            $message_body = array(
                "id" => $this->id
            );
            $this->http_delete($api_name, json_encode($message_body));
        }

        // Implements HTTP GET request with pre-set variables  
        private function http_get($api_name) {

            $url_complete = $this->url_prefix . $api_name . $this->url_params;
            $ch = curl_init();
  
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_URL, $url_complete);
            curl_setopt($ch, CURLOPT_TIMEOUT, 80);
            
            $json_response = curl_exec($ch);
                 
            if (curl_error($ch))
                echo 'Request Error:' . curl_error($ch);
            
            curl_close($ch);
            return $json_response;
        }

        // Implements HTTP POST request with pre-set variables  
        private function http_post($api_name, $json_message_body) {

            $url_complete = $this->url_prefix . $api_name;
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_URL, $url_complete);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_message_body);

            $json_response = curl_exec($ch);

            if (curl_error($ch))
                echo 'Request Error:' . curl_error($ch);
            
            curl_close($ch);
        }        

        // Implements HTTP DELETE request with pre-set variables
        private function http_delete($api_name, $json_message_body) {
            $url_complete = $this->url_prefix . $api_name;
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_URL, $url_complete);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_message_body);

            $json_response = curl_exec($ch);

            if (curl_error($ch))
                echo 'Request Error:' . curl_error($ch);
            
            curl_close($ch);
        }        
    }
?>

