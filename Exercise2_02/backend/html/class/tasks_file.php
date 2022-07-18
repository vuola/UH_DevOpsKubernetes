<?php
    class Task{

        // Columns
        public $id;
        public $description;
        public $owner;
        public $status;
        public $created;

    }

    //
    //
    // Implementation of the client-end calls of api
    //
    //

    class ClientTask extends Task {

        // Add new constructor without arguments
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
            $api_name = "create_file.php";

            $message_body = array(
                "description" => $this->description,
                "owner" => $this->owner,
                "status" => $this->status,
                "created" => $this->created
            );
            $this->http_post($api_name, json_encode($message_body));
        }

        // Returns array containing all db tasks
        public function getAll() {
            $this->url_params = "";
            $api_name = "read_file.php";
            $all_json_rows = $this->http_get($api_name);           
            return json_decode($all_json_rows, true);
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

    }
?>

